<?php

use App\Livewire\Editor;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/admin/editor/{pageId?}', Editor::class);