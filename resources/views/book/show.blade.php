@extends('index')

@section('content')
    @if(session()->has('success'))
        {{session('success')}}
    @endif

    <a href="{{url()->previous()}}">Back</a>

    <div class="parent-show-book">

        <div class="book">

            <img src="{{Storage::url($book->picture)}}" alt="">

            <div class="data">

                <p class="title">{{$book->title}}</p>
                <p class="description">{{$book->description}}</p>
                <p class="price">{{$book->price}}$</p>

            </div>

            <a href="{{Storage::url($book->download)}}">Download</a>

            <h1>Tags</h1>

            <div class="tags-book">
                @foreach($tags as $tag)

                <div class="tag">{{$tag->name}}</div>

                @endforeach
            </div>

            <a href="{{$book->id}}/edit">Edit</a>
            <form action="{{route('destroy.book',$book->id)}}" method="POST">
                @csrf
                @method('delete')
                <input class="delete" type="submit" value="Delete">
            </form>

        </div>

    </div>

    <!-- Comments -->

    <div class="comments">


        <div class="comment">

            <img src="{{is_null($profile) ? '/storage/santa.png' : Storage::url($profile->picture)}}" alt="">

            <div class="data">

                <div class="username">
                    <p>{{auth()->user()->username}}</p>
                </div>

                <div class="user-comment">
                    <form action="{{route('comment.book',$book->id)}}" method="post">
                        @csrf
                        <input class="type-comment" type="text" name="comment">
                        <input type="submit" value="Comment">

                    </form>
                </div>

            </div>

        </div>

        @foreach($book->comments as $comment)
            <div class="comment">


                <img src="{{is_null($profile) ? '/storage/santa.png' : Storage::url($profile->picture)}}" alt="">

                <div class="data">

                    <div class="username">
                        <p>{{auth()->user()->username}}</p>
                    </div>

                    <div class="user-comment">
                        <p>{{$comment->comment}}</p>
                    </div>

                </div>

                
            </div>
        @endforeach

    </div>
@endsection