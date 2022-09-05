<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class CustomInput extends Component
{

    public String $name;
    public String $type;
    public String $label;
    public String $placeholder;
    public String $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(String $type="text",String $name,String $label,String $placeholder,String $value="")
    {
        $this->type=$type;
        $this->name=$name;
        $this->label=$label ?? $name;
        $this->placeholder=$placeholder ??"";
        $this->value=$value;
       // $this->label=$label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.custom-input');
    }
}
