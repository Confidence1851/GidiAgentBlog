<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPostComment extends Model
{
    protected $fillable = [
        'author_id' , 'comment' , 'status' , 'post_id'
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

    public function post(){
        return $this->belongsTo(BlogPost::class , 'post_id');
    }
}
