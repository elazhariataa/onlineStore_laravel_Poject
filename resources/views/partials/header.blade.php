<head>
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    <script>
        function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
    </script>
</head>
<header>
    <div class="logo">
        <img src="{{asset('images/webSiteLogo.png')}}" alt="">
        <h1>Online Shop</h1>
    </div>
    <div class="menu">
        <a href="{{route('home')}}">Home</a>
        <a href="">About us</a>
        <a href="{{route('contactForm')}}">Contact us</a>
        <a href="{{route('displayCart')}}">Cart</a>
    </div>
    <div class="headreAuthPart">
        @auth
        {{-- <a href="{{route('logout.perform')}}"><button>Logout</button></a> --}}
        <div class="dropdown">
            <img src="{{asset('images/user1.png')}}" alt="profilePic" onclick="myFunction()" class="dropbtn">
            <div id="myDropdown" class="dropdown-content">
                @if (auth()->user()->is_admin)
                    <a href="{{route('adminDashboard')}}">Dashboard</a>
                @else
                    <a href="{{route('clientDashboard')}}">Dashboard</a>
                @endif
              <a href="{{route('logout.perform')}}">Log out</a>
            </div>
        </div>
        @endauth

        @guest
            <p><a href="{{ route('register.perform') }}">Register</a> / <a href="{{ route('login.perform') }}">Login</a></p>
        @endguest
    </div>
</header>