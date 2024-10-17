<?php

namespace App\Blocks;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Pages\Page;
use Database\Factories\BlockFactory;
use Illuminate\Database\Eloquent\Factories\Factory;


class Block extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'type',
        'content'
    ];

    protected static function newFactory(): Factory
    {
        return BlockFactory::new();
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
}
