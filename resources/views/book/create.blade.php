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
            <form action="{{route('store.book')}}" method="POST" enctype="multipart/form-data">
    
                @csrf
                @method('POST')

                <label for="">Title</label>
                <input type="text" name="title" value="{{old('title')}}">

                @error('title')
                    {{$message}}
                @enderror
    
                
                <label for="">Description</label>
                <input type="text" name="description" value="{{old('description')}}">
    
                @error('description')
                    {{$message}}
                @enderror
                
                <label for="">Price</label>
                <input type="text" name="price" value="{{old('price')}}">

                @error('price')
                    {{$message}}
                @enderror

                <label for="">Tag</label>
                <input type="text" name="tag" value="{{old('tag')}}">

                @error('tag')
                    {{$message}}
                @enderror

                <label for="">Picture</label>
                <input type="file" name="picture">

                @error('picture')
                    {{$message}}
                @enderror

                <label for="">Book</label>
                <input type="file" name="download">

                @error('download')
                    {{$message}}
                @enderror

                <input type="submit" value="Create">
    
            </form>
        </div>

        <a href="{{url()->previous()}}">BACK</a>


    </div>

</body>
</html>