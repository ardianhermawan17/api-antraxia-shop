<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'image', 'status'
    ];

    public function books(){
        return $this->belongsToMany(Book::class, 'book_category','category_id','book_id');
    }
}
