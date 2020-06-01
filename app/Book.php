<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Book extends Model
{

    //Nama class & Nama tabel
    //protected $table = 'book';

    //Primary key
    //protected primarykey = 'code'; //string
    //public $incrementing = false;
    //protected $keyType = 'string';

    //Timestamps
    //const CREATED_AT = 'creation_date';
    //const UPDATED_AT = 'last_update';
    //public $timestamps = false;

    protected $fillable = [
        'title', 'slug', 'description', 'author', 'publisher',
        'cover', 'price', 'weight', 'stock', 'status'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
