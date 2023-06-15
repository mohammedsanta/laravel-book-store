<?php

namespace App\Http\Controllers;

use App\Models\tag;
use App\Models\Book;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Requests\CreateBook;
use App\Http\Requests\UpdateBook;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $books = Book::all();

        if(auth()->user()->privilege == 'admin'){
            $filtered = $books;
        }else {
            $filtered = $books->filter(function ($book) {
                return $book->user_id == auth()->user()->id;
            });
        }
                
        return view('book.index',[
            'books' => $filtered
        ]);
    }

    /**
     * Display a listing of the resource By Tag.
     */

    public function tag(Request $request)
    {
     
        $tag = tag::all()->where('name',$request->search)->first();

        if($tag){
            
            $tag = $tag->first()->books;
        
            return view('book.index',[
                'books' => $tag
            ]);
        }else {
            abort('404');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBook $request)
    {

        $data = $request->validated();
        $data['picture'] = request()->file('picture')->store('books');
        $data['download'] = request()->file('download')->store('books/download');
        $data['user_id'] = auth()->user()->id;

        $book = Book::create($data);

        $tag = new tag;

        // dd($tag->where('name',$request->tag)->first());


        $findTag = $tag->where('name',$request->tag)->first();

    
        if($findTag) {
            $book->tags()->attach($tag->id);
        }else {    
            $tag->name = $request->tag;
            
            $book->tags()->save($tag);
        }




        // return redirect('/books')->with('success','Add New Book Success');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $book = Book::findOrFail($id);
        
        $tag = $book->tags()->get()->all();

        $profile = UserProfile::where('profileable_id',auth()->user()->id);
        $profile = $profile ? $profile->get()[0] : null;
        if($this->authorize('view',$book)){
            return view('book.show',[
                'book' => $book,
                'tags' => $tag,
                'profile' => $profile
            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);

        if(Gate::allows('view',$book)){
            return view('book.edit',[
                'book' => $book
            ]);
        }
        return abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBook $request, string $id)
    {

        $update = Book::findOrFail($id);
        $this->authorize('update',$update);

        $data = $request->validated();
        $update = Book::findOrFail($id);

        if(!empty($request->picture) && $request->hasFile('picture')){

            if(!is_null($update->picture)){
                Storage::delete($update->picture);
            }

            $data['picture'] = $request->file('picture')->store('books');

        }else {
            unset($request->path);
        }

        if(!empty($request->download) && $request->hasFile('download')){
            Storage::delete($request->download);

            $data['download'] = $request->file('download')->store('/books/download');
        }else {
            unset($request->download);
        }

        $update->update($data);

        return redirect('/book/'.$id)->with('success','Updated Done');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $this->authorize('delete',$book);
        $book->delete();

        return redirect('/books')->with('success','Delete Done');
    }

    public function comment(Request $request,$id)
    {
        
        $book = Book::find($id);

        $book->comment()->create([
            'comment' => $request->comment,
            'commentable_type' => 'App\Models\Book',
            'commentable_id' => 1,
            'user_id' => auth()->user()->id
        ]);

        return redirect(url()->previous());

    }
}
