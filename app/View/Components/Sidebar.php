<?php

namespace App\View\Components;

use App\Models\FoodList;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $commonTags = FoodList::query()
            ->whereNotNull('tags')
            ->where('tags', '!=', '')
            ->pluck('tags')
            ->flatMap(function (string $tags): Collection {
                return collect(explode(',', $tags))
                    ->map(fn (string $tag) => trim($tag))
                    ->filter();
            })
            ->map(fn (string $tag) => Str::lower($tag))
            ->countBy()
            ->sortDesc()
            ->keys()
            ->map(fn (string $tag) => Str::title($tag))
            ->take(6)
            ->values();

        return view('components.sidebar', [
            'totalLists' => FoodList::count(),
            'popularLists' => FoodList::query()
                ->withSum('foodListVotes as vote_total', 'value')
                ->orderByDesc('vote_total')
                ->orderByDesc('created_at')
                ->take(3)
                ->get(),
            'trendingCount' => FoodList::query()
                ->withSum('foodListVotes as vote_total', 'value')
                ->having('vote_total', '>', 0)
                ->count(),
            'commonTags' => $commonTags,
        ]);
    }
}
