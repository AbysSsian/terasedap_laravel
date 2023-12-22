<div id="sidebar-top">
    <button class="menu-button" onclick="toggleSidebar()">
        <x-iconsax-lin-menu />
    </button>
    <x-logo />
</div>


<div id="sidebar" class="closed">
    <button class="menu-button" onclick="toggleSidebar()">
        <x-iconsax-lin-arrow-left-1 />
    </button>
        <x-logo />
    <div class=" greet-admin">
        <p class="h3">
            Hello, 
            {{Auth::user()->firstname}}
        </p>
    </div>
    <nav>
        <a href="{{ route('admin.orders')}}" class="nav-menu {{ Route::is('admin.orders') ? 'active' : ''}}">Orders</a>
        <a href="{{route('admin.history')}}" class="nav-menu {{ Route::is('admin.history') ? 'active' : ''}}">Order History</a>
        <a href="{{ route('admin.menu')}}" class="nav-menu {{ Route::is('admin.menu') ? 'active' : ''}}">Menu Management</a>
        <a href="{{ route('admin.category')}}" class="nav-menu {{ Route::is('admin.category') ? 'active' : ''}}">Category Management</a>
        {{-- <a href="{{ route('admin.sales') }}" class="nav-menu {{ Route::is('admin.sales') ? 'active' : ''}}">Sales Report</a> --}}
        {{-- <a href="{{ route('admin.settings') }}" class="nav-menu {{ Route::is('admin.settings') ? 'active' : ''}}">User Settings</a> --}}
    </nav>
    <div style="display:flex; justify-content:center; margin-top: 10rem;">
        <a href="{{ route('logout') }}">
            <div class="logout-button">
                Logout <x-iconsax-out-logout style="margin-left: 8px; width: 22px; height: 22px;" />
            </div>
        </a>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('closed');
    }
</script>