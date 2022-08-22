<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Statistic extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public readonly $name, public $number, public $route)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|string|Closure
    {
        return view('backend.components.statistic');
    }
}
