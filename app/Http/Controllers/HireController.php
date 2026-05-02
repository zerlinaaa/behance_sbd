<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Hire;

class HireController extends Controller
{
    public function hiring()
    {
        $catSlugs = [
            'graphic-design',
            'logo-design',
            'branding-services',
            'website-design',
            'social-media-design',
            'illustrations',
            'architecture-interior-design',
            'ui-ux-design',
        ];

        $catCards = Category::whereIn('slug', $catSlugs)
            ->get()
            ->map(function ($cat) {
                $cover = Project::published()
                    ->inCategory($cat->id)
                    ->whereNotNull('cover_image')
                    ->inRandomOrder()
                    ->value('cover_image');

                return [
                    'label' => $cat->name,
                    'img'   => $cover ?? null,
                    'slug'  => $cat->slug,
                ];
            });

        return view('hire.hiring', compact('catCards'));
    }

    public function myJobs()
{
    return view('hire.my-jobs');
}

public function freelance()
{
    $freelancers = Hire::latest()->get();
    return view('hire.freelance', compact('freelancers'));
}
}