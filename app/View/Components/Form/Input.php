<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $name;
    public $type;
    public $required;

    public function __construct($label, $name, $type = 'text', $required = false)
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->required = $required;
    }

    public function render()
    {
        return view('components.form.input');
    }
}
