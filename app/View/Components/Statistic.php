<?php
declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Statistic extends Component
{
    public readonly string $name;
    public $number;
    public  $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $number, $route)
    {
        //
        $this->name = $name;
        $this->number = $number;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render(): View|string|\Closure
    {
        return view('backend.components.statistic');
    }
}
