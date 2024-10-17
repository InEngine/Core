<?php

namespace App\Livewire;

use Livewire\Component;

class Block extends Component
{

    public $block;

    public $content;

    public $cssClasses;

    public $manualStyles = '';

    public $children;

    public $displayIndex;

    public function mount($block)
    {
        $this->block = $block;
        $this->content = $this->block->content;
    }

    public function render()
    {
        if($this->block->type !== null || $this->block->type !== '')
        {
            $view = 'livewire.' . $this->block->type;
        } else {
            $view = 'livewire.block';
        }
        
        return view($view);
    }
}
