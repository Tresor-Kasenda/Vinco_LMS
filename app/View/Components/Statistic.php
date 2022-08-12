<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Statistic extends Component
{
    public function __construct(public $name, public $number, public $route)
    {
    }

    public function render(): View|string|Closure
    {
        return view('backend.components.statistic');
    }
}
