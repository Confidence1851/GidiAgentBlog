<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{

    protected $fillable = [
        'author_id' , 'title' , 'body' , 'post_category_id' , 'slug' , 'status' , 'image'
    ];

    public function getStatusAttribute($status){
        return [
          '0' => 'Hidden',
          '1' => 'Visible',
        ][$status];
    }


    public function author(){
        return $this->belongsTo(User::class , 'author_id');
    }

    public function category(){
        return $this->belongsTo(BlogPostCategory::class , 'post_category_id');
    }

    public function comments(){
        return $this->hasMany(BlogPostComment::class , 'post_id');
    }
}
