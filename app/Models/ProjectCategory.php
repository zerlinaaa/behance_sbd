<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Model pivot khusus — extends Pivot bukan Model.
 * Diperlukan jika kita ingin tambahkan logic di tabel pivot,
 * atau gunakan withPivot() di belongsToMany().
 *
 * Contoh penggunaan di Project.php:
 *   ->belongsToMany(Category::class, 'project_categories')
 *   ->using(ProjectCategory::class)
 *   ->withTimestamps()
 */
class ProjectCategory extends Pivot
{
    protected $table = 'project_categories';

    public $incrementing = true;  // karena tabel kita punya kolom id

    protected $fillable = ['project_id', 'category_id'];
}


/*
|─────────────────────────────────────────────────────────────────
| CONTOH PENGGUNAAN DI CONTROLLER
|─────────────────────────────────────────────────────────────────
|
| // Ambil semua project published + relasi (eager loading)
| $projects = Project::with(['user', 'categories', 'images'])
|                 ->published()
|                 ->trending()
|                 ->paginate(20);
|
| // Cek apakah user sudah like
| $project->isLikedBy(auth()->user())
|
| // Toggle like (like jika belum, unlike jika sudah)
| $existing = Like::where(['user_id' => $user->id,
|                          'project_id' => $project->id])->first();
| if ($existing) {
|     $existing->delete();   // → booted() decrement otomatis
| } else {
|     Like::create([...]);   // → booted() increment otomatis
| }
|
| // Ambil follower list
| $followers = $user->followers()->paginate(20);
|
| // Assign kategori ke project (N:M)
| $project->categories()->sync([1, 3, 7]);
|
| // Filter project berdasarkan kategori
| Project::inCategory('ui-ux')->published()->paginate(20);
|─────────────────────────────────────────────────────────────────
*/