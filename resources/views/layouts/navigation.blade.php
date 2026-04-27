<nav class="topbar">
    <div class="topbar-inner">
        <div class="nav-group">
            <a href="{{ route('dashboard') }}" class="brand">
                <span class="logo-box">⌂</span>
                <span class="logo-text">RoomMate</span>
            </a>

            <div class="desktop-links">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('chores.index') }}" class="nav-link {{ request()->routeIs('chores.*') ? 'active' : '' }}">Chores</a>
                <a href="{{ route('expenses.index') }}" class="nav-link {{ request()->routeIs('expenses.*') ? 'active' : '' }}">Expenses</a>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('households.create') }}" class="nav-link {{ request()->routeIs('households.*') ? 'active' : '' }}">Household</a>
                    @endif
                @endauth
            </div>
        </div>

        <div class="user-group">
            @auth
                @if(auth()->user()->isSuperAdmin())
                    <span class="badge badge-warning">Super Admin</span>
                @endif

                @if(auth()->user()->household)
                    <span class="user-chip">{{ auth()->user()->household->code }}</span>
                @endif

                <span class="name-chip">{{ auth()->user()->name }}</span>

                <img src="{{ auth()->user()->avatar_url }}" class="avatar" alt="User avatar">

                <a href="{{ route('profile.edit') }}" class="btn btn-ghost">Profile</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-danger">Logout</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            @endguest
        </div>
    </div>
</nav>