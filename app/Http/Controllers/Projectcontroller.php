<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Category;

class ProjectController extends Controller
{
    /** Form tambah project — GET /projects/create */
    public function create()
    {
        $categories = Category::where('is_active', 1)->orderBy('name')->get();
        return view('projects.create', compact('categories'));
    }

    /** Simpan project baru — POST /projects */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'cover_image'   => 'nullable|url',
            'status'        => 'in:draft,published',
            'categories'    => 'array',
            'categories.*'  => 'exists:categories,id',
        ]);

        $project = Project::create([
            'user_id'     => auth()->id(),
            'title'       => $request->title,
            'description' => $request->description,
            'cover_image' => $request->cover_image,
            'slug'        => Str::slug($request->title) . '-' . Str::random(4),
            'status'      => $request->status ?? 'published',
        ]);

        if ($request->categories) {
            $project->categories()->sync($request->categories);
        }

        return redirect()->route('projects.show', $project->slug)
                         ->with('success', 'Project berhasil dibuat!');
    }

    /** Form edit project — GET /projects/{slug}/edit */
    public function edit(string $slug)
    {
        $project    = Project::where('slug', $slug)
                             ->where('user_id', auth()->id())
                             ->firstOrFail();
        $categories = Category::where('is_active', 1)->orderBy('name')->get();
        $selected   = $project->categories->pluck('id')->toArray();

        return view('projects.edit', compact('project', 'categories', 'selected'));
    }

    /** Update project — PUT /projects/{slug} */
    public function update(Request $request, string $slug)
    {
        $project = Project::where('slug', $slug)
                          ->where('user_id', auth()->id())
                          ->firstOrFail();

        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'cover_image'  => 'nullable|url',
            'status'       => 'in:draft,published,archived',
            'categories'   => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        $project->update([
            'title'       => $request->title,
            'description' => $request->description,
            'cover_image' => $request->cover_image,
            'status'      => $request->status,
        ]);

        $project->categories()->sync($request->categories ?? []);

        return redirect()->route('projects.show', $project->slug)
                         ->with('success', 'Project berhasil diperbarui!');
    }

    /** Hapus project — DELETE /projects/{slug} */
    public function destroy(string $slug)
    {
        $project = Project::where('slug', $slug)
                          ->where('user_id', auth()->id())
                          ->firstOrFail();
        $project->delete();

        return redirect()->route('explore')
                         ->with('success', 'Project berhasil dihapus.');
    }
}