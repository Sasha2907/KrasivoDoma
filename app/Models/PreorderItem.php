<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreorderItem extends Model
{
    protected $fillable = ['preorder_id', 'item_type', 'item_id'];

    public function preorder()
    {
        return $this->belongsTo(Preorder::class);
    }

    public function item()
    {
        return $this->morphTo();
    }
}
