<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Document</title>
</head>
<body>
    
    <div class="container">

        <div class="box-form">
            <form action="{{route('update.book',$book->id)}}" method="POST" enctype="multipart/form-data">
    
                @csrf
                @method('POST')

                <label for="">Title</label>
                <input type="text" name="title" value="{{$book->title}}">

                @error('title')
                    {{$message}}
                @enderror
    
                
                <label for="">Description</label>
                <input type="text" name="description" value="{{$book->description}}">
    
                @error('description')
                    {{$message}}
                @enderror
                
                <label for="">Price</label>
                <input type="text" name="price" value="{{$book->price}}">

                @error('price')
                    {{$message}}
                @enderror

                <label for="">Picture</label>
                <img src="{{Storage::url($book->picture)}}" style="width: 100px; height: 100px">

                <input type="file" name="picture">


                @error('picture')
                    {{$message}}
                @enderror

                <label for="">Book</label>
                <a href="{{Storage::url($book->download)}}">Book</a>


                <input type="file" name="download">


                @error('download')
                    {{$message}}
                @enderror

                <input type="submit" value="Create">
    
            </form>
        </div>

    </div>

</body>
</html>