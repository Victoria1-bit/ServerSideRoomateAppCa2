<nav class="main-nav">
    <div class="nav-inner">
        <a href="{{ route('dashboard') }}" class="nav-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>Roommate Hub</span>
        </a>

        <button class="hamburger-btn" type="button" onclick="document.querySelector('.nav-menu').classList.toggle('show')">
            ☰
        </button>

        <div class="nav-menu">
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('chores.index') }}">Chores</a>
                <a href="{{ route('expenses.index') }}">Expenses</a><a href="{{ route('house.show') }}">My House</a>
                <a href="{{ route('profile.edit') }}">Profile</a>

                <span class="user-chip">@if(Auth::user()->profile_photo)<img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" class="nav-avatar" alt="Profile">@endif 
                    {{ Auth::user()->name }} ({{ Auth::user()->role === 'admin' ? 'HouseKeeper' : (Auth::user()->role ?? 'member') }})
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            @endauth
        </div>
    </div>
</nav>


