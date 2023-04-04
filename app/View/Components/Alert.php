<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{   
    public $content;
    public $route;
    public $id;
    public $size;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content,$route,$id,$size)
    {
        $this->content = $content;
        $this->route = $route;
        $this->id = $id;
        $this->size = $size;

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
