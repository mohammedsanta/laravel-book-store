@extends('index')

@section('content')
    <div class="container">

        <div class="box-form">
            <form action="{{route('info.update',auth()->user()->id)}}" method="POST">
    
                @csrf
                @method('POST')

                <label for="">Username</label>
                <input type="text" name="username" value="{{old('username') ?? $user->username}}">

                @error('username')
                    {{$message}}
                @enderror

                <label for="">Email</label>
                <input type="text" name="email" value="{{old('email') ?? $user->email}}">

                @error('email')
                    {{$message}}
                @enderror
    
                
                <label for="">Privilege</label>
                <input type="text" name="privilege" value="{{old('privileges') ?? $user->privilege}}">
    
                @error('privilege')
                    {{$message}}
                @enderror

                                
                <label for="">Mobile</label>
                <input type="text" name="mobile" value="{{old('mobile') ?? $info->mobile}}">
    
                @error('mobile')
                    {{$message}}
                @enderror

                <input type="submit" value="Update">
    
            </form>
        </div>

    </div>

@endsection