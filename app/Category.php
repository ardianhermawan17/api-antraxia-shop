<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'name', 'slug', 'image', 'status'
    ];

//     FROM API
//    public function books(){
//        return $this->belongsToMany(Book::class, 'book_category','category_id','book_id');
//    }

    public function books(){
        return $this->belongsToMany(Book::class);
    }
}
