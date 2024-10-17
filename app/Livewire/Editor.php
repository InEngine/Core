<?php

namespace App\Livewire;

use App\Pages\Page;
use Livewire\Component;
use Ramsey\Uuid\Uuid;

class Editor extends Component
{

    public Page $page;

    public $blocks;

    public function mount($pageId)
    {
        if($pageId !== null && $pageId !== '')
        {
            if(Uuid::isValid($pageId) == true) {
                $this->page = Page::where('id', $pageId)->with('blocks')->first();
            } else {
                $this->page = Page::where('name', $pageId)->with('blocks')->first();
            }
            
        } else {
            $this->page = new Page();
        }
        
        $this->blocks = $this->page->blocks;
    }

    public function addBlock()
    {
        // Add modal with type of block or a select dropdown
        // Add sidebar to select styles and other details of the block
        $this->page->blocks()->create(['type' => 'null']);
        $this->blocks = $this->page->blocks;
    }

    public function render()
    {
        return view('livewire.editor')
            ->layout('layouts.app.app')
            ->title('Edit');
    }
}
