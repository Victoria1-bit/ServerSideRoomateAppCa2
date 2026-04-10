<nav style="background:#fff; padding:15px; border-bottom:1px solid #ccc; display:flex; justify-content:space-between; align-items:center;">

    <div>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('chores.index') }}" style="margin-left:15px;">Chores</a>
    </div>

    <div>
        @auth
            <span style="margin-right:15px;">
                {{ Auth::user()->name }} ({{ Auth::user()->role ?? 'member' }})
            </span>

            <a href="{{ route('profile.edit') }}" style="margin-right:10px;">Profile</a>

            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" style="background:red; color:white; padding:5px 10px; border:none; cursor:pointer;">
                    Logout
                </button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}">Login</a>
        @endguest
    </div>

</nav>