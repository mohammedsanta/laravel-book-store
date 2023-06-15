@extends('index')

@section('content')
    <div class="container">

        <div class="box-form">
            <form action="{{route('signup')}}" method="POST">
    
                @csrf
                @method('POST')

                <label for="">Username</label>
                <input type="text" name="username" value="{{old('username')}}">

                @error('username')
                    {{$message}}
                @enderror

                <label for="">Email</label>
                <input type="text" name="email" value="{{old('email')}}">

                @error('email')
                    {{$message}}
                @enderror
    
                
                <label for="">Password</label>
                <input type="text" name="password" value="{{old('description')}}">
    
                @error('password')
                    {{$message}}
                @enderror

                                
                <label for="">Confirmation Password</label>
                <input type="text" name="confirmation_password" value="{{old('confirmation_password')}}">
    
                @error('confirmation_password')
                    {{$message}}
                @enderror

                <input type="submit" value="Create">
    
            </form>
        </div>

    </div>

@endsection