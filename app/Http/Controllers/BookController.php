<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Book;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class BookController extends Controller
{
     
    public function index()
    { 
        $book=Book::All();
         
         return Response::json([
                    'error' => false,
                    'books' => $book->toArray(),
                    200]);        
    }
    public function show($id)
    {
        if($book = Book::find($id)){
            return Response::json([
                    'error' => false,
                    'book' => $book->toArray(),
                    200]);            
        } else {
            return Response::json([
                    'error' => true,
                    400]);            
        }          
    }   
    
    public function destroy($id)
    {
        $book = Book::find($id);
        
        if($book->delete()){
            return Response::json([
                    'error' => false,
                    'deleted id' => $id,
                    200]); 
        } else {
            return Response::json([
                    'error' => true,
                    404]);             
        }
    }
       
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|alpha|min:3',
            'author' => 'required|alpha|min:3',
            'year' => 'required',
            'genre' => 'required|alpha|min:3',
            ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return Response::json([
                    'error' => true,
                    404])
            ->withErrors($validator);
        } else {
            $book = new Book;
            $book->title= $request->title;
            $book->author = $request->author;
            $book->year = $request->year;
            $book->genre = $request->genre;
            //$book->user_id = $request->user_id;
            $book->save();
            return Response::json([
                    'error' => false,
                    'book' => $book,
                    200]);
        }
    }  
}
