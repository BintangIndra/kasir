<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{   
    public $title;
    public $content;
    public $id;
    public $footer;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content,$id,$title,$footer)
    {
        $this->content = $content;
        $this->id = $id;
        $this->title = $title;
        $this->footer = $footer;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
