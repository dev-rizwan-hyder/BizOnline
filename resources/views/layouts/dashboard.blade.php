<!DOCTYPE html>
<html lang="en" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biz Tech Dashboard</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    
    <!-- Tailwind CSS & Alpine.js -->
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
    <script src="https://unpkg.com/htmx.org@1.9.10/dist/ext/preload.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'],
                    },
                    colors: {
                        indigo: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom scrollbar for a cleaner look */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* HTMX Loading Bar */
        .htmx-indicator {
            opacity: 0;
            transition: opacity 200ms ease-in;
        }
        .htmx-request .htmx-indicator {
            opacity: 1;
        }
        .htmx-request.htmx-indicator {
            opacity: 1;
        }
        #nprogress {
            pointer-events: none;
        }
        #nprogress .bar {
            background: #4f46e5;
            position: fixed;
            z-index: 1031;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
        }
    </style>
    
    <script>
        // Simple loading bar for HTMX
        document.addEventListener("htmx:configRequest", function(e) {
            let bar = document.getElementById('nprogress-bar');
            if(bar) bar.style.display = 'block';
        });
        document.addEventListener("htmx:afterOnLoad", function(e) {
            let bar = document.getElementById('nprogress-bar');
            if(bar) bar.style.display = 'none';
        });
    </script>
</head>
<body class="bg-slate-50 text-slate-800 h-screen overflow-hidden flex" hx-boost="true" hx-ext="preload" preload="mouseover" x-data="{ sidebarOpen: false, sidebarExpanded: true, profileDropdownOpen: false, notificationsOpen: false }">
    <!-- Loading Bar -->
    <div id="nprogress" class="htmx-indicator"><div class="bar" id="nprogress-bar" style="display:none;"></div></div>

    
    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-slate-900/50 lg:hidden" @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen, 'w-64': sidebarExpanded, 'w-20': !sidebarExpanded}" class="fixed inset-y-0 left-0 z-30 flex flex-col bg-slate-900 text-slate-300 transition-all duration-300 ease-in-out lg:relative lg:translate-x-0 border-r border-slate-800 shadow-xl">
        
        <!-- Logo Area -->
        <div class="flex items-center justify-between h-16 px-4 border-b border-slate-800 bg-slate-950/50">
            <div class="flex items-center overflow-hidden whitespace-nowrap">
                <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white shrink-0">
                    <i class="ri-braces-line text-lg"></i>
                </div>
                <span x-show="sidebarExpanded" x-transition.opacity.duration.300ms class="ml-3 text-lg font-bold text-white tracking-wide">Biz Tech</span>
            </div>
            <!-- Mobile Close Button -->
            <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white p-1">
                <i class="ri-close-line text-xl"></i>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-3 py-6 space-y-8 overflow-y-auto overflow-x-hidden no-scrollbar">
            
            @if(Auth::check() && Auth::user()->role === 'admin')
            <!-- Overview Section -->
            <div>
                <div x-show="sidebarExpanded" class="px-3 mb-2 text-xs font-semibold tracking-wider text-slate-500 uppercase">Overview</div>
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="relative flex items-center px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600/10 text-indigo-400' : 'hover:bg-slate-800 hover:text-white' }}">
                        @if(request()->routeIs('admin.dashboard'))
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-indigo-500 rounded-r-full"></div>
                        @endif
                        <i class="ri-dashboard-3-line text-xl shrink-0 group-hover:scale-110 transition-transform"></i>
                        <span x-show="sidebarExpanded" class="ml-3 font-medium truncate">Dashboard</span>
                    </a>
                </div>
            </div>

            <!-- Management Section -->
            <div>
                <div x-show="sidebarExpanded" class="px-3 mb-2 text-xs font-semibold tracking-wider text-slate-500 uppercase">Management</div>
                <div class="space-y-1">
                    <a href="{{ route('admin.employees.index') }}" class="relative flex items-center px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('admin.employees.*') ? 'bg-indigo-600/10 text-indigo-400' : 'hover:bg-slate-800 hover:text-white' }}">
                        @if(request()->routeIs('admin.employees.*'))
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-indigo-500 rounded-r-full"></div>
                        @endif
                        <i class="ri-team-line text-xl shrink-0 group-hover:scale-110 transition-transform"></i>
                        <span x-show="sidebarExpanded" class="ml-3 font-medium truncate">Employees</span>
                    </a>
                    
                    <a href="{{ route('admin.tasks.index') }}" class="relative flex items-center px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('admin.tasks.*') ? 'bg-indigo-600/10 text-indigo-400' : 'hover:bg-slate-800 hover:text-white' }}">
                        @if(request()->routeIs('admin.tasks.*'))
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-indigo-500 rounded-r-full"></div>
                        @endif
                        <i class="ri-task-line text-xl shrink-0 group-hover:scale-110 transition-transform"></i>
                        <span x-show="sidebarExpanded" class="ml-3 font-medium truncate">Tasks</span>
                    </a>
                    
                    <a href="{{ route('admin.attendances.index') }}" class="relative flex items-center px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('admin.attendances.*') ? 'bg-indigo-600/10 text-indigo-400' : 'hover:bg-slate-800 hover:text-white' }}">
                        @if(request()->routeIs('admin.attendances.*'))
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-indigo-500 rounded-r-full"></div>
                        @endif
                        <i class="ri-time-line text-xl shrink-0 group-hover:scale-110 transition-transform"></i>
                        <span x-show="sidebarExpanded" class="ml-3 font-medium truncate">Attendance</span>
                    </a>
                </div>
            </div>
            @endif

            @if(Auth::check() && Auth::user()->role === 'employee')
            <!-- Employee Section -->
            <div>
                <div x-show="sidebarExpanded" class="px-3 mb-2 text-xs font-semibold tracking-wider text-slate-500 uppercase">Workspace</div>
                <div class="space-y-1">
                    <a href="{{ route('employee.dashboard') }}" class="relative flex items-center px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('employee.dashboard') ? 'bg-indigo-600/10 text-indigo-400' : 'hover:bg-slate-800 hover:text-white' }}">
                        @if(request()->routeIs('employee.dashboard'))
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-indigo-500 rounded-r-full"></div>
                        @endif
                        <i class="ri-task-line text-xl shrink-0 group-hover:scale-110 transition-transform"></i>
                        <span x-show="sidebarExpanded" class="ml-3 font-medium truncate">My Tasks</span>
                    </a>
                    <a href="{{ route('employee.attendance') }}" class="relative flex items-center px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('employee.attendance') ? 'bg-indigo-600/10 text-indigo-400' : 'hover:bg-slate-800 hover:text-white' }}">
                        @if(request()->routeIs('employee.attendance'))
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-indigo-500 rounded-r-full"></div>
                        @endif
                        <i class="ri-calendar-check-line text-xl shrink-0 group-hover:scale-110 transition-transform"></i>
                        <span x-show="sidebarExpanded" class="ml-3 font-medium truncate">My Attendance</span>
                    </a>
                </div>
            </div>
            @endif

        </nav>

        <!-- Pinned Bottom User Profile -->
        <div class="relative border-t border-slate-800 p-3 bg-slate-900">
            <button @click="profileDropdownOpen = !profileDropdownOpen" @click.away="profileDropdownOpen = false" class="flex items-center w-full p-2 rounded-lg hover:bg-slate-800 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center shrink-0 border border-slate-600 overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4f46e5&color=fff" alt="Avatar" class="w-full h-full object-cover">
                </div>
                <div x-show="sidebarExpanded" class="ml-3 flex-1 text-left overflow-hidden">
                    <div class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-slate-400 capitalize truncate">{{ Auth::user()->role }}</div>
                </div>
                <i x-show="sidebarExpanded" class="ri-more-2-fill text-slate-500"></i>
            </button>
            
            <!-- Profile Dropdown -->
            <div x-show="profileDropdownOpen" x-transition.opacity class="absolute bottom-full left-0 w-full mb-2 bg-slate-800 border border-slate-700 rounded-lg shadow-xl overflow-hidden z-50">
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-red-400 hover:bg-slate-700 hover:text-red-300 transition-colors flex items-center">
                        <i class="ri-logout-box-r-line mr-2"></i> Sign Out
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col min-w-0 bg-slate-50">
        
        <!-- Top Navbar -->
        <header class="h-16 bg-white border-b border-slate-200 shadow-sm flex items-center justify-between px-4 sm:px-6 z-10 shrink-0">
            <div class="flex items-center">
                <!-- Mobile Menu Toggle -->
                <button @click="sidebarOpen = true" class="lg:hidden text-slate-500 hover:text-slate-700 mr-4 p-1 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <i class="ri-menu-2-line text-2xl"></i>
                </button>

                <!-- Desktop Sidebar Toggle -->
                <button @click="sidebarExpanded = !sidebarExpanded" class="hidden lg:block text-slate-500 hover:text-slate-700 mr-5 p-1 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <i :class="sidebarExpanded ? 'ri-menu-fold-line' : 'ri-menu-unfold-line'" class="text-2xl transition-transform"></i>
                </button>

                <!-- Dynamic Breadcrumb Placeholder -->
                <div class="hidden sm:flex items-center text-sm font-medium text-slate-600">
                    <span class="text-slate-400"><i class="ri-home-4-line"></i></span>
                    <i class="ri-arrow-right-s-line mx-2 text-slate-400"></i>
                    <span class="capitalize">{{ request()->segment(1) ?: 'Dashboard' }}</span>
                    @if(request()->segment(2))
                        <i class="ri-arrow-right-s-line mx-2 text-slate-400"></i>
                        <span class="capitalize text-slate-900">{{ request()->segment(2) }}</span>
                    @endif
                </div>
            </div>

            <div class="flex items-center space-x-3 sm:space-x-5">
                <!-- Notifications -->
                <div class="relative">
                    <button @click="notificationsOpen = !notificationsOpen" @click.away="notificationsOpen = false" class="relative p-2 text-slate-400 hover:text-slate-600 transition-colors rounded-full hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <i class="ri-notification-3-line text-xl"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>
                    <!-- Notifications Dropdown Placeholder -->
                    <div x-show="notificationsOpen" x-transition.opacity class="absolute right-0 mt-2 w-64 bg-white border border-slate-200 rounded-xl shadow-lg z-50 overflow-hidden">
                        <div class="px-4 py-3 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="text-sm font-semibold text-slate-800">Notifications</h3>
                            <a href="#" class="text-xs text-indigo-600 hover:underline">Mark all read</a>
                        </div>
                        <div class="p-4 text-center text-sm text-slate-500">
                            No new notifications
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
            
            <!-- Global Flash Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-start shadow-sm" x-data="{ show: true }" x-show="show">
                    <i class="ri-checkbox-circle-fill text-emerald-500 text-xl mr-3 mt-0.5"></i>
                    <div class="flex-1 text-emerald-800 font-medium text-sm">
                        {{ session('success') }}
                    </div>
                    <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 focus:outline-none">
                        <i class="ri-close-line text-lg"></i>
                    </button>
                </div>
            @endif
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start shadow-sm" x-data="{ show: true }" x-show="show">
                    <i class="ri-error-warning-fill text-red-500 text-xl mr-3 mt-0.5"></i>
                    <div class="flex-1 text-red-800 text-sm">
                        <ul class="list-disc list-inside space-y-1 font-medium">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button @click="show = false" class="text-red-500 hover:text-red-700 focus:outline-none">
                        <i class="ri-close-line text-lg"></i>
                    </button>
                </div>
            @endif

            <div class="max-w-[90rem] mx-auto w-full">
                @yield('content')
            </div>
            
        </main>
    </div>
</body>
</html>
