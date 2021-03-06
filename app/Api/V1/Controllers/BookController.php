<?php
namespace App\Api\V1\Controllers;
use JWTAuth;
use App\Book;
use App\Http\Requests;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class BookController extends Controller
{
    use Helpers;
    public function index()
    {
        return $this->currentUser()
            ->books()
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();
    }
    public function show($id)
    {
        $book = $this->currentUser()->books()->find($id);
        if(!$book)
            throw new NotFoundHttpException;
        return $book;
    }
    public function store(Request $request)
    {
        $book = new Book;
        $book->title = $request->get('title');
        $book->author_name = $request->get('author_name');
        $book->pages_count = $request->get('pages_count');
        if($this->currentUser()->books()->save($book))
            return $this->response->created();
        else
            return $this->response->error('could_not_create_book', 500);
    }
    public function update(Request $request, $id)
    {
        $book = $this->currentUser()->books()->find($id);
        if(!$book)
            throw new NotFoundHttpException;
        $book->fill($request->all());
        if($book->save())
            return $this->response->noContent();
        else
            return $this->response->error('could_not_update_book', 500);
    }
    public function destroy($id)
    {
        $book = $this->currentUser()->books()->find($id);
        if(!$book)
            throw new NotFoundHttpException;
        if($book->delete())
            return $this->response->noContent();
        else
            return $this->response->error('could_not_delete_book', 500);
    }
    private function currentUser() {
        return JWTAuth::parseToken()->authenticate();
    }
}