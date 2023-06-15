@extends('index')

<style>

    .data {
        display: flex;
        justify-content: center;
        gap: 30px;
    }

    .left {
        width: 800px;
        height: 600px;
        background-color: #009cff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 25px;
        border-radius: 10px;
    }

    img {
        width: 500px;
        height: 400px;
    }

    .right {
        width: 800px;
        height: 600px;
        background-color: #009cff0f;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 25px;
        border-radius: 10px;
        position: relative;
    }

    .info {
        padding: 7px;
        border-radius: 6px;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        width: 100%;
        height: 100%;
    }

    .info p {
        font-size: 40px;
        text-align: center;
        margin-bottom: 30px;
    }

    .info .title {
        width: 300px;
        height: 400px;
        display: flex;
        flex-direction: column;
    }

    .info .user {
        width: 300px;
        height: 400px;
        display: flex;
        flex-direction: column;
        margin: auto;
    }

    .right a {
        position: absolute;
        top: 85%;
        right: 50%;
        transform: translate(-50%,-50%);
        background-color: #005aff;
        padding: 10px;
        border-radius: 12px;
        color: white;
        font-weight: bold;
    }

    .right .success {
        position: absolute;
        top: 7%;
        right: 38%;
        /* transform: translate(-50%,-50%); */
        /* background-color: #005aff; */
        padding: 10px;
        border-radius: 12px;
        color: black;
        font-weight: bold;
        font-size: 20px;
    }


</style>



@section('content')

    <div class="data">

        <div class="left">
            <img src="{{ Storage::url($profile->picture) }}" alt="">
    
            <form action="{{ route('profile.update',['id'=>auth()->user()->id]) }}" method="POST" enctype="multipart/form-data">
    
                @csrf
    
                <input type="file" name="picture" id="">
    
                <input type="submit" value="Update">
    
            </form>
    
        </div>
    
        <div class="right">

            <div class="success">

                @if(session()->has('success'))
                    {{session('success')}}
                @endif

            </div>
    
            <div class="info">

                <div class="title">

                    <p class="id">id</p>
                    <p class="email">Email</p>
                    <p class="username">Username</p>
                    <p class="privilege">Privilege</p>
                    <p class="mobile">Mobile</p>

                </div>

                <div class="user">

                    <p class="id">{{ auth()->user()->id }}</p>
                    <p class="email">{{ auth()->user()->email }}</p>
                    <p class="username">{{ auth()->user()->username }}</p>
                    <p class="privilege">{{ auth()->user()->privilege }}</p>
                    <p class="mobile">{{ $profile->mobile }}</p>

                </div>

                
            </div>

            <a href="{{ route('info.view') }}">Edit</a>
    
        </div>

    </div>

@endsection