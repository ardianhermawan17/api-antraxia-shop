<?php

namespace App\Http\Controllers;

use App\Http\Resources\Book as BookResource;
use App\Book;
use App\Http\Resources\Books as BookResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function search($keywoard){
        $criteria = Book::select('*')
            ->where('title', 'LIKE',"%".$keywoard."%")
            ->orderBy('views', 'DESC')
            ->get();

        return new BookResourceCollection($criteria);
    }

    public function slug($slug){
        $criteria = Book::where('slug' , $slug)->first();
        $criteria->views = $criteria->views + 1;
        $criteria->save();

        return new BookResource($criteria);
    }

    public function top($count){
        $criteria = Book::select('*')
        ->orderBy('views','DESC')
        ->limit($count)
        ->get();

        return new BookResourceCollection($criteria);
    }

    public function cetak($judul){
        return $judul;
    }

    public function index()
    {
        $books = Book::paginate(6);

        return new BookResourceCollection($books);
    }

    public function view($id){
//        $book = DB::select('select * from books where id = :id',
//            ['id' => $id]);
        $book = new BookResource(Book::find($id));

        return $book;
    }

    public function rawquery(){
        // select * from books
        $books = DB::table('books')->get();

        // select * from books where id = 3
        $books2 = DB::table('books')->where('id', 3)->first();

        // select title from books where id = 3
        $title = DB::table('books')->where('id', 3)->value('title');

        // mereturn collection data
        // select id, title from books
        $books = DB::table('books')->pluck('id', 'title');
        foreach ($books as $id => $title) {
            echo $title;
        }

        // select count(*) from books
        $count_books = DB::table('books')->count();

        // select max(price) from books
        $max_book_price = DB::table('books')->max('price');

        // select average(price) from books
        $avg_book_price = DB::table('books')->avg('price');

        // insert into books (title) values ('Learn VueJS')
        DB::table('books')->insert(
            ['title' => 'Learn VueJS', 'slug' => 'learn-vuejs']
        );

        // update books set price = 125000 where id =3
        DB::table('books')
            ->where('id', 3)
            ->update(['price' => 125000]);

        // delete from books where id=5
        DB::table('books')->where('id', '=', 5)->delete();
    }

    public function eloquent(){
        // select * from books
        $books = \App\Book::all();
        foreach ($books as $book) {
            echo $book->title;
        }

        // select * from books where status = 'PUBLISH' limit 10 order by title desc
        $books = \App\Book::where('status', 'PUBLISH')
            ->orderBy('title', 'asc')
            ->limit(10)
            ->get();
        // jangan ambil buku yang statusnya draft
        $published_books = $books->reject(function ($book) {
            return $book->status=='DRAFT';
        });

        // ambil buku yang statusnya publish
        $published_books2 = $books->filter(function ($book) {
            return $book->status=='PUBLISH';
        });

        // ambil 2 items buku secara random
        $books->random(2)->all();

        $books = \App\Book::all();
        // ambil record pertama
        $first_book = $books->first();

        // ambil nilai dari atribut title pada record pertama
        $title = $books->first()->value('title');

        // select * from books where id = 1
        $book = \App\Book::find(1);
        echo $book->title;

        //agregatt
        $count = \App\Book::count();
        $max_price = \App\Book::max('price'); // nilai maksimal
        $avg_price = \App\Book::avg('price'); // rata-rata
    }

    public function massAssign()
    {
        $book = \App\Book::create(
            ['title' => 'Judul 01', 'slug' => 'judul-01']
        );

        $book2 = \App\Book::create(
            ['title' => 'Judul 02', 'slug' => 'judul-02'],
            ['title' => 'Judul 03', 'slug' => 'judul-03']
);

// update judul buku dengan id 26
        $book = \App\Book::find(26);
        $book->fill(
            ['title' => 'Judul 01 - updated']
        );
    }
}
