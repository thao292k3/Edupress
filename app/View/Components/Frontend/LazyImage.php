<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;

class LazyImage extends Component
{
    public function __construct(
        public string $src,
        public string $alt = '',
        public string $class = '',
        public array $attributes = []
    ) {}

    public function render()
    {
        return view('components.frontend.lazy-image');
    }
}
