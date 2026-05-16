<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Category;
use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;

class ProjectController extends Controller
{
    /**
     * Deteksi warna dominan dari URL gambar
     * dan mapping ke nama warna yang ada di colorOptions
     */
    private function detectDominantColor(string $imageUrl): ?string
    {
        try {
            // Download gambar ke temp
            $tempFile = tempnam(sys_get_temp_dir(), 'img_');
            $imageData = @file_get_contents($imageUrl, false, stream_context_create([
                'http' => ['timeout' => 5]
            ]));

            if (!$imageData) return null;

            file_put_contents($tempFile, $imageData);

            // Buat palette dari gambar
            $palette   = Palette::fromFilename($tempFile);
            $extractor = new ColorExtractor($palette);
            $colors    = $extractor->extract(1); // ambil 1 warna dominan

            unlink($tempFile);

            if (empty($colors)) return null;

            // Convert ke RGB
            $rgb = Color::fromIntToRgb($colors[0]);
            $r = $rgb['r'];
            $g = $rgb['g'];
            $b = $rgb['b'];

            return $this->mapToColorName($r, $g, $b);

        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Mapping nilai RGB ke nama warna
     */
    private function mapToColorName(int $r, int $g, int $b): string
    {
        // Convert RGB ke HSL
        $r /= 255; $g /= 255; $b /= 255;
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $l = ($max + $min) / 2;
        $s = 0;
        $h = 0;

        if ($max !== $min) {
            $d = $max - $min;
            $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);
            switch ($max) {
                case $r: $h = (($g - $b) / $d + ($g < $b ? 6 : 0)) / 6; break;
                case $g: $h = (($b - $r) / $d + 2) / 6; break;
                case $b: $h = (($r - $g) / $d + 4) / 6; break;
            }
        }

        $h = round($h * 360);
        $s = round($s * 100);
        $l = round($l * 100);

        // Warna tidak jenuh (abu/hitam/putih)
        if ($s < 15) {
            if ($l < 20) return 'black';
            if ($l > 80) return 'white';
            return 'gray';
        }

        // Warna gelap kecoklatan
        if ($l < 30 && $s < 40) return 'brown';

        // Mapping berdasarkan Hue
        if ($h < 15)  return 'red';
        if ($h < 30)  return 'orange';
        if ($h < 65)  return 'yellow';
        if ($h < 150) return 'green';
        if ($h < 165) return 'teal';
        if ($h < 250) return 'blue';
        if ($h < 290) return 'purple';
        if ($h < 330) return 'pink';
        return 'red';
    }

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

        // Auto-detect warna dominan dari cover image
        $color = null;
        if ($request->cover_image) {
            $color = $this->detectDominantColor($request->cover_image);
        }

        $project = Project::create([
            'user_id'     => auth()->id(),
            'title'       => $request->title,
            'description' => $request->description,
            'cover_image' => $request->cover_image,
            'slug'        => Str::slug($request->title) . '-' . Str::random(4),
            'status'      => $request->status ?? 'published',
            'color'       => $color,
            'tools'       => $request->tools ? json_encode($request->tools) : null,
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

        // Auto-detect warna jika cover_image berubah
        $color = $project->color;
        if ($request->cover_image && $request->cover_image !== $project->cover_image) {
            $color = $this->detectDominantColor($request->cover_image);
        }

       $project->update([
        'title'       => $request->title,
        'description' => $request->description,
        'cover_image' => $request->cover_image,
        'status'      => $request->status,
        'color'       => $color,
        'tools'       => $request->tools ? json_encode($request->tools) : null,
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