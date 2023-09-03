<nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
    <div class="container">
        <a class="navbar-brand" href="#">Welcome {{ $activeUser->username }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-lg-flex justify-content-end" id="navbarNav">
            <ul class="navbar-nav me-3">
                <li class="nav-item">
                    <a class="nav-link {{ $page == 'dashboard' ? 'border-bottom border-dark' : '' }} "
                        aria-current="page" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $page == 'activity' ? 'border-bottom border-dark' : '' }}"
                        href="{{ route('admin.activity') }}">Activity</a>
                </li>
            </ul>
            <a href="{{ route('logout') }}">
                <button class="btn btn-danger">Logout</button>
            </a>
        </div>
    </div>
</nav>
