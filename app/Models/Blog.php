<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'blog_image',
        'user_id',
        'category_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function blogTag(){
        return $this->hasMany(BlogTag::class,'blog_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

     public $primaryKey = 'blog_id';
}
