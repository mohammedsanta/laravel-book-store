@extends('index')

@section('content')
@if(session()->has('success'))
    {{session('success')}}
@endif

<div class="create">
    <a href="{{route('create.book')}}">Create</a>
</div>

<div class="parent">


    @foreach($books as $book)

        <a href="{{route('book.show',$book->id)}}">
            <div class="card">

                @if(auth()->user()->privilege == 'admin')
                <p class="author">Author {{$book->user->username}}</p>
                @endif

                <img src="{{Storage::url($book->picture)}}" alt="">

                <div class="data">

                    <p class="title">{{$book->title}}</p>
                    <p class="description">{{$book->description}}</p>
                    <p class="price">{{$book->price}}$</p>

                </div>

                <button>Read More</button>

            </div>
        </a>

    @endforeach

</div>

@endsection