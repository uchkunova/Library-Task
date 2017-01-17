<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\StoreBook;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['only' => ['store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response | View
     */
    public function index(Request $request)
    {
        if ($request->ajax() && $request->has('page')) {
            $books = Book::getItemsToPaginate(8);

            return response([
                'pagination' => [
                    'total' => $books->total(),
                    'per_page' => $books->perPage(),
                    'current_page' => $books->currentPage(),
                    'last_page' => $books->lastPage(),
                    'from' => $books->firstItem(),
                    'to' => $books->lastItem(),
                ],
                'data' => $books
            ]);
        }

        return view('books.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBook  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBook $request): Response
    {
        $file = request()->file('cover');
        $path = $file->storeAs('covers', uniqid($request->input('title')) . '.' . $file->guessClientExtension());

        $book = Book::createNew([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'publish_date' => $request->input('publish_date'),
            'resume' => $request->input('resume'),
            'format' => $request->input('format'),
            'page_count' => $request->input('page_count'),
            'isbn' => $request->input('isbn'),
            'cover_path' => $path,
        ]);

        return response($book);
    }

    /**
     * @return Response
     */
    public function getFormatTypes()
    {
        return response(Book::getFormatTypes());
    }
}
