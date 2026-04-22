<?php

namespace App\View\Components;

use App\Models\FoodList;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class SurpriseWidget extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.surprise-widget', [
            'availableLocations' => FoodList::query()
                ->whereNotNull('location')
                ->where('location', '!=', '')
                ->orderBy('location')
                ->distinct()
                ->pluck('location')
                ->values(),
        ]);
    }
}
