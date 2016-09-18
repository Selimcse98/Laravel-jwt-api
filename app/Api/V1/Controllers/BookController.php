<?php

namespace app\Api\V1\Controllers;

use Dingo\Api\Http\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use JWTAuth;
use App\Book;
use Dingo\Api\Routing\Helpers as Helpers;

use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index()
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        return $currentUser
            ->books()
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();
    }

    public function store(Request $request)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        $book = new Book;

        $book->title = $request->get('title');
        $book->author_name = $request->get('author_name');
        $book->pages_count = $request->get('pages_count');

        if($currentUser->books()->save($book))
            return $this->response->created();
        else
            return $this->response->error('could_not_create_book', 500);
    }
}
