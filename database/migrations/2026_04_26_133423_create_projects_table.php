use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

foreach ($data as $item) {

    $title = $item['title'] ?? 'Untitled Project';

    DB::table('projects')->insert([
        'user_id' => 1, // sementara (WAJIB ada user id 1)
        'title' => $title,
        'description' => $item['description'] ?? null,
        'cover_image' => $item['image'] ?? null,

        'slug' => Str::slug($title) . '-' . rand(1000, 9999),

        'status' => 'published',
        'views_count' => 0,
        'likes_count' => $item['likes'] ?? 0,
        'comments_count' => 0,

        'created_at' => now(),
        'updated_at' => now(),
    ]);
}