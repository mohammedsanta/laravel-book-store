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
            <form action="{{route('login')}}" method="POST">
    
                @csrf
                @method('POST')

                <label for="">Username</label>
                <input type="text" name="username" value="{{old('username')}}">

                @error('username')
                    {{$message}}
                @enderror
    
                
                <label for="">Password</label>
                <input type="text" name="password" value="{{old('description')}}">
    
                @error('password')
                    {{$message}}
                @enderror

                <input type="submit" value="Login">
    
            </form>
        </div>

    </div>

</body>
</html>