<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Tag;

class News extends Model
{
    use HasFactory;


    /** scope for active items */
    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class, 'news_tags');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function scopeActiveEntries($query)
    {
        return $query->where([
            'status' => 1,
            'is_approved' => 1
        ]);
    }

    /** scope for check language */
    public function scopeWithLocalize($query)
    {
        return $query->where([
            'language' => getLangauge()
        ]);
    }





    public function auther()
    {
        return $this->belongsTo(Admin::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
