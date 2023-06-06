<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 box-navbar">
    <div class="container">
        <a class="navbar-brand" href="#">Sistem Parkir</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if(Auth::user()->role == 'user')
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('state') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('myqr') }}">MyQR</a>
                    </li>
                @elseif(Auth::user()->role == 'gate')
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('scanqr') }}">Home</a>
                    </li>
                @elseif(Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.user') }}">Users</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Master
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.gates') }}">Gates</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.gatespace') }}">Gate Spaces</a></li>
                        </ul>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.history') }}">Report Parkir</a>
                    </li>
                    </li>
                @endif
            </ul>
            <div class="dropdown end-dropdown">
                <button class="btn dropdown-toggle text-uppercase" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->user->nama }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
