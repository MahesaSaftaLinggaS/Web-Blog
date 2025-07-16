<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        // Artikel per bulan
        $monthlyPosts = Post::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [];
        $totals = [];

        foreach ($monthlyPosts as $data) {
            $months[] = date('F', mktime(0, 0, 0, $data->month, 1));
            $totals[] = $data->total;
        }

        // Artikel per kategori (termasuk kategori tanpa artikel)
        $categoryData = Category::withCount('posts')->get();
        $categoryLabels = $categoryData->pluck('name');
        $categoryCounts = $categoryData->pluck('posts_count');

        return view('livewire.admin.dashboard', [
            'postCount'      => Post::count(),
            'userCount'      => User::count(),
            'categoryCount'  => Category::count(),
            'recentPosts'    => Post::latest()->take(5)->get(),
            'chartLabels'    => json_encode($months),
            'chartData'      => json_encode($totals),
            'categoryLabels' => $categoryLabels,
            'categoryCounts' => $categoryCounts,
        ])->layout('layouts.app');
    }
}
