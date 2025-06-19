<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchDropdown extends Component
{
    public $name;
    public $options;

    public function __construct($name, $options = [])
    {
        $this->name = $name;
        $this->options = $options;
    }

    public function render()
    {
        return view('components.search-dropdown');
    }
}
