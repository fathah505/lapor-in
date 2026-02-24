<aside class="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 50px; height: 50px; background: white; border-radius: 10px; padding: 5px;">
        <h2>Lapor.in</h2>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('siswa.dashboard') }}" class="{{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('siswa.pengaduan') }}" class="{{ request()->routeIs('siswa.pengaduan*') ? 'active' : '' }}">
                <i data-lucide="file-text"></i> Pengaduan Saya
            </a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" style="cursor: pointer;">
                    <i data-lucide="log-out"></i> Logout
                </a>
            </form>
        </li>
    </ul>
</aside>

<style>
.sidebar {
    position: fixed;
    left: 0;
    top: 0;
    width: 260px;
    height: 100vh;
    background: linear-gradient(180deg, #2d5a7b 0%, #1a3a4f 100%);
    color: white;
    padding: 20px 0;
    box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}
.sidebar-header {
    padding: 0 25px 30px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    gap: 15px;
}
.sidebar-header h2 {
    font-size: 24px;
    font-weight: 700;
}
.sidebar-menu {
    margin-top: 30px;
    list-style: none;
}
.sidebar-menu li {
    margin-bottom: 5px;
}
.sidebar-menu a {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px 25px;
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
}
.sidebar-menu a:hover,
.sidebar-menu a.active {
    background: rgba(79, 179, 191, 0.2);
    color: white;
    border-left-color: #4fb3bf;
}
.sidebar-menu a i[data-lucide] {
    width: 20px;
    height: 20px;
    flex-shrink: 0;
}
</style>