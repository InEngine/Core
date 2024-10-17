<?php

namespace App\Pages;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Blocks\Block;
use Database\Factories\PageFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class Page extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected static function newFactory(): Factory
    {
        return PageFactory::new();
    }

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }
    
}
