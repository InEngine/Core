<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EditorController extends Controller
{
    public function show(string $page =''): View
    {
        return view('livewire.editor');
    }
}
