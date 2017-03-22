
    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
        <a class="navbar-brand" href="#"><img id="bm-img" src="/favicon.ico" alt="belle moda"></a>
          <a class="blog-nav-item" href="{{ url('/') }}"><span class="glyphicon glyphicon-home"> HOME</span></a>
          <a class="blog-nav-item" href="{{ route('posts.create') }} "><span class="glyphicon glyphicon-pencil"> CREATE</span></a>
          <form class="navbar-form navbar-right" action="/search" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <input type="text" name="search" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
            @if (Auth::check())
                <span class="dropdown navbar-right">
                  <a class="blog-nav-item navbar-right" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }} 
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </span>
            @else
                <a class="blog-nav-item navbar-right" href="{{ url('/register') }}">Register</a>
                <a class="blog-nav-item navbar-right" href="{{ url('/login') }}">Login</a>
            @endif
        </nav>
      </div>
    </div>
