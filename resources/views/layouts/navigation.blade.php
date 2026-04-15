<nav class="topbar">
    <!-- Main navigation bar container -->

    <div class="topbar-inner">
        <!-- Inner wrapper to control layout and spacing -->

        <div class="nav-group">
            <!-- Left side navigation links -->

            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <!-- Link to Dashboard page
                     Adds 'active' class if the current page is dashboard -->
                Dashboard
            </a>

            <a href="{{ route('chores.index') }}"
               class="nav-link {{ request()->routeIs('chores.*') ? 'active' : '' }}">
                <!-- Link to Chores page
                     The * means any chores-related route will count as active -->
                Chores
            </a>

            <a href="{{ route('expenses.index') }}"
               class="nav-link {{ request()->routeIs('expenses.*') ? 'active' : '' }}">
                <!-- Link to Expenses page
                     Marks active if user is on any expenses route -->
                Expenses
            </a>
        </div>

        <div class="user-group">
            <!-- Right side: user info and actions -->

            @auth
                <!-- This section only shows if the user is logged in -->

                <span class="user-chip">
                    <!-- Displays the logged-in user's name and role -->
                    {{ Auth::user()->name }} ({{ Auth::user()->role ?? 'member' }})
                    <!-- If role is missing, defaults to 'member' -->
                </span>

                <a href="{{ route('profile.edit') }}"
                   class="btn btn-ghost">
                    <!-- Link to edit the user's profile -->
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    <!-- Logout form (POST request required for security) -->

                    @csrf
                    <!-- CSRF protection token -->

                    <button type="submit" class="btn btn-danger">
                        <!-- Button to submit the logout form -->
                        Logout
                    </button>
                </form>
            @endauth

            @guest
                <!-- This section only shows if the user is NOT logged in -->

                <a href="{{ route('login') }}" class="btn btn-primary">
                    <!-- Link to login page -->
                    Login
                </a>
            @endguest
        </div>
    </div>
</nav>