<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class CustomTextarea extends Component
{

    public String $label;
    public String $name;
    public String $placeholder;
    public String $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(String $label,String $name,String $placeholder,String $value="")
    {
        $this->name=$name;
        $this->label=$label;
        $this->placeholder=$placeholder;
        $this->value=$value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.custom-textarea');
    }
}
