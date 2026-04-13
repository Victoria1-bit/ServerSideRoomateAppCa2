<nav class="topbar">
    <div class="topbar-inner">
        <div class="nav-group">
            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('chores.index') }}"
               class="nav-link {{ request()->routeIs('chores.*') ? 'active' : '' }}">
                Chores
            </a>

            <a href="{{ route('expenses.index') }}"
               class="nav-link {{ request()->routeIs('expenses.*') ? 'active' : '' }}">
                Expenses
            </a>
        </div>

        <div class="user-group">
            @auth
                <span class="user-chip">
                    {{ Auth::user()->name }} ({{ Auth::user()->role ?? 'member' }})
                </span>

                <a href="{{ route('profile.edit') }}"
                   class="btn btn-ghost">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        Logout
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            @endguest
        </div>
    </div>
</nav>
