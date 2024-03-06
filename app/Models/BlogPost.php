<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogPost extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blogcat_id', 'id')->withDefault(['category_name'=>'No Category!']);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}