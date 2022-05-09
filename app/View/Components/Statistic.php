<?php
declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Statistic extends Component
{
    public $name;
    public $number;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $number)
    {
        //
        $this->name = $name;
        $this->number = $number;
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
