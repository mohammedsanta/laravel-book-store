<div class="header">

    @auth

    <a href="{{route('index.book')}}">Books</a>

    <a href="{{route('profile.view')}}">Profile</a>
    <!-- <a href="">Settings</a> -->

    @else

    <a href="{{route('signup.view')}}">Signup</a>

    <a href="{{route('login')}}">Login</a>

    @endauth

    <form action="{{route('logout')}}" method="POST">

        @csrf

        <input type="submit" value="Logout">

    </form>


</div>

<div class="search">

    <form action="{{route('index.books.tag')}}" method="get">

        <input type="search" name="search" id="">

        <input type="submit" value="Search">

    </form>

</div>