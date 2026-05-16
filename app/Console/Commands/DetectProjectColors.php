<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;

class DetectProjectColors extends Command
{
    protected $signature   = 'projects:detect-colors';
    protected $description = 'Auto-detect warna dominan dari cover image semua project';

    public function handle()
{
    $projects = DB::table('projects')
        ->whereNotNull('cover_image')
        ->where('cover_image', '!=', '')
        ->whereNull('color')
        ->get(['id', 'cover_image']);

    $this->info("Project belum diproses: {$projects->count()}");
    $bar = $this->output->createProgressBar($projects->count());
    $bar->start();

    $updated = 0;
    $failed  = 0;
    $i       = 0;

    foreach ($projects as $project) {
        $color = $this->detectColor($project->cover_image);
        $i++;

        // Reconnect setiap 50 project
        if ($i % 50 === 0) {
            DB::disconnect();
            sleep(1);
            DB::reconnect();
        }

        try {
            if ($color) {
                DB::table('projects')
                    ->where('id', $project->id)
                    ->update(['color' => $color]);
                $updated++;
            } else {
                // Assign default biar tidak diproses ulang
                DB::table('projects')
                    ->where('id', $project->id)
                    ->update(['color' => 'gray']);
                $failed++;
            }
        } catch (\Exception $e) {
            // Coba reconnect dan retry sekali
            try {
                DB::disconnect();
                sleep(2);
                DB::reconnect();
                DB::table('projects')
                    ->where('id', $project->id)
                    ->update(['color' => $color ?? 'gray']);
            } catch (\Exception $e2) {
                $this->newLine();
                $this->error("Gagal id {$project->id}");
            }
        }

        $bar->advance();
    }

    $bar->finish();
    $this->newLine();
    $this->info("Selesai! Updated: {$updated}, Gagal: {$failed}");
}
   private function detectColor(string $imageUrl): ?string
    {
        try {
            $tempFile  = tempnam(sys_get_temp_dir(), 'img_');
            $imageData = @file_get_contents($imageUrl, false, stream_context_create([
                'http' => ['timeout' => 5]
            ]));

            if (!$imageData) return null;

            file_put_contents($tempFile, $imageData);

            // Cek tipe gambar
            $info = @getimagesize($tempFile);
            if (!$info) { unlink($tempFile); return null; }

            $src = match($info['mime']) {
                'image/jpeg' => @imagecreatefromjpeg($tempFile),
                'image/png'  => @imagecreatefrompng($tempFile),
                'image/gif'  => @imagecreatefromgif($tempFile),
                'image/webp' => @imagecreatefromwebp($tempFile),
                default      => null,
            };

            if (!$src) { unlink($tempFile); return null; }

            // Resize ke 50x50 supaya hemat memory
            $small = imagecreatetruecolor(50, 50);
            imagecopyresampled($small, $src, 0, 0, 0, 0, 50, 50, imagesx($src), imagesy($src));
            imagedestroy($src);

            $smallFile = $tempFile . '_small.jpg';
            imagejpeg($small, $smallFile);
            imagedestroy($small);
            unlink($tempFile);

            $palette   = Palette::fromFilename($smallFile);
            $extractor = new ColorExtractor($palette);
            $colors    = $extractor->extract(1);

            unlink($smallFile);

            if (empty($colors)) return null;

            $rgb = Color::fromIntToRgb($colors[0]);
            return $this->mapToColorName($rgb['r'], $rgb['g'], $rgb['b']);

        } catch (\Exception $e) {
            return null;
        }
    }

    private function mapToColorName(int $r, int $g, int $b): string
    {
        $r /= 255; $g /= 255; $b /= 255;
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $l   = ($max + $min) / 2;
        $s   = 0;
        $h   = 0;

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

        if ($s < 15) {
            if ($l < 20) return 'black';
            if ($l > 80) return 'white';
            return 'gray';
        }

        if ($l < 30 && $s < 40) return 'brown';

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
}