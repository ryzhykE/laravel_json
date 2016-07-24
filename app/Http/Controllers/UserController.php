<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Book;
use App\User;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function show($id)
    {        
        if($user = User::find($id)){
            return Response::json([
                    'error' => false,
                    'book' => $user->toArray(),
                    200]);            
        } else {
            return Response::json([
                    'error' => true,
                    400]);            
        }         
    }
}
