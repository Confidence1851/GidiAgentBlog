<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPostCategory extends Model
{
    protected $fillable = [
        'category_name' ,'author_id' , 'status'
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

    public function posts(){
        return $this->hasMany(BlogPost::class);
    }

}
