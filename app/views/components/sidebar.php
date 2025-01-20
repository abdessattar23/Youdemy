<nav class="navbar-vertical navbar">
    <div id="myScrollableElement" class="h-screen" data-simplebar>
        <!-- brand logo -->
        <a class="navbar-brand" href="/">
            <img src="/assets/images/brand/logo/logo.svg" alt="" />
        </a>

        <!-- navbar nav -->
        <ul class="navbar-nav flex-col" id="sideNavbar">
            <?php if (isset($_SESSION['role'])): ?>
            <?php if ($_SESSION['role'] === 'student'): ?>
            <!-- Student Navigation -->
            <li class="nav-item">
                <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] === '/student') ? 'active' : ''; ?>"
                    href="/student">
                    <i data-feather="home" class="w-4 h-4 mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <div class="navbar-heading">Learning</div>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] === '/enrolled') ? 'active' : ''; ?>"
                    href="/enrolled">
                    <i data-feather="book-open" class="w-4 h-4 mr-2"></i>
                    My Courses
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] === '/student#browse') ? 'active' : ''; ?>"
                    href="/student#browse">
                    <i data-feather="compass" class="w-4 h-4 mr-2"></i>
                    Browse Courses
                </a>
            </li>
            <?php elseif ($_SESSION['role'] === 'admin'): ?>
            <!-- Admin Navigation -->
            <li class="nav-item">
                <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] === '/admin') ? 'active' : ''; ?>" href="/admin">
                    <i data-feather="home" class="w-4 h-4 mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <div class="navbar-heading">Manage Teachers</div>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] === '/admin/pending-teachers') ? 'active' : ''; ?>"
                    href="/admin/pending-teachers">
                    <i data-feather="users" class="w-4 h-4 mr-2"></i>
                    Pending Teachers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] === '/admin/courses') ? 'active' : ''; ?>"
                    href="/admin/courses">
                    <i data-feather="book" class="w-4 h-4 mr-2"></i>
                    Courses
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] === '/admin/manage-categories') ? 'active' : ''; ?>"
                    href="/admin/manage-categories">
                    <i data-feather="grid" class="w-4 h-4 mr-2"></i>
                    Categories/Tags
                </a>
            </li>
            <?php elseif ($_SESSION['role'] === 'teacher'): ?>
            <!-- Teacher Navigation -->
            <li class="nav-item">
                <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] === '/teacher') ? 'active' : ''; ?>"
                    href="/teacher">
                    <i data-feather="home" class="w-4 h-4 mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <div class="navbar-heading">Courses</div>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] === '/teacher/courses') ? 'active' : ''; ?>"
                    href="/teacher/courses">
                    <i data-feather="book" class="w-4 h-4 mr-2"></i>
                    Manage Courses
                </a>
            </li>
            <li class="nav-item">
                <div class="navbar-heading">Statistics</div>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] === '/teacher/statistics') ? 'active' : ''; ?>"
                    href="/teacher/statistics">
                    <i data-feather="pie-chart" class="w-4 h-4 mr-2"></i>
                    Statistics
                </a>
            </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link" href="/logout">
                    <i data-feather="log-out" class="w-4 h-4 mr-2"></i>
                    Logout
                </a>
            </li>
            <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="/login">
                    <i data-feather="log-in" class="w-4 h-4 mr-2"></i>
                    Login
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/register">
                    <i data-feather="users" class="w-4 h-4 mr-2"></i>
                    Register
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<!-- app layout content -->
<div id="app-layout-content"
    class="min-h-screen w-full min-w-[100vw] md:min-w-0 ml-[15.625rem] [transition:margin_0.25s_ease-out]">
    <div class="header">
        <!-- navbar -->
        <nav class="bg-white px-6 py-[10px] flex items-center justify-between shadow-sm">
            <a id="nav-toggle" href="#" class="text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </a>
            <div class="ml-3 hidden md:hidden lg:block">
                <!-- form -->
                <form class="flex items-center">
                    <input type="search"
                        class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3 disabled:opacity-50 disabled:pointer-events-none"
                        placeholder="Search" id="search" />
                </form>
            </div>
            <!-- navbar nav -->
            <?php if (isset($_SESSION['role'])): ?>
            <ul class="flex ml-auto items-center">
                <!-- list -->
                <li class="dropdown ml-2">
                    <a class="rounded-full" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <div class="w-10 h-10 relative">
                            <img alt="avatar" src="/assets/images/avatar/avatar-1.jpg" class="rounded-full" />
                            <div
                                class="absolute border-gray-200 border-2 rounded-full right-0 bottom-0 bg-green-600 h-3 w-3">
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
            <?php endif; ?>
        </nav>
    </div>