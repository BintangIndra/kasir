<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{   
    public $content;
    public $route;
    public $id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content,$route,$id)
    {
        $this->content = $content;
        $this->route = $route;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
