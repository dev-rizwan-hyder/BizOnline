<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BizTechSolutions</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            blue: '#1a56db',
                            dark: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .grid-pattern {
            background-size: 40px 40px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex text-slate-800 antialiased selection:bg-brand-blue selection:text-white">
    
    <div class="flex w-full min-h-screen">
        
        <!-- Left Side: Branding & Info (Hidden on Mobile) -->
        <div class="hidden lg:flex lg:w-[55%] xl:w-1/2 relative bg-gradient-to-br from-[#1e40af] via-[#1d4ed8] to-[#0f172a] overflow-hidden text-white flex-col justify-between p-12 xl:p-16">
            
            <!-- Grid Background Overlay -->
            <div class="absolute inset-0 grid-pattern opacity-60"></div>
            
            <!-- Content Container -->
            <div class="relative z-10 max-w-xl">
                <!-- Logo Button -->
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 border border-white/20 rounded-xl backdrop-blur-sm mb-12">
                    <div class="w-6 h-6 bg-white text-blue-700 rounded-full flex items-center justify-center">
                        <i class="ri-braces-line text-sm font-bold"></i>
                    </div>
                    <span class="font-semibold text-sm tracking-wide">BizTechSolutions</span>
                </div>
                
                <!-- Main Copy -->
                <h1 class="text-4xl xl:text-5xl font-bold leading-[1.15] tracking-tight mb-6">
                    Your tasks, employees, and attendance in one clean workspace.
                </h1>
                
                <p class="text-blue-100 text-lg leading-relaxed mb-12 opacity-90 max-w-md">
                    Sign in to continue managing your business with focused tools, real-time tracking, and secure access.
                </p>
                
                <!-- Feature Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- Card 1 -->
                    <div class="bg-white/10 border border-white/20 backdrop-blur-md rounded-2xl p-5 hover:bg-white/15 transition-colors">
                        <i class="ri-task-line text-2xl text-blue-200 mb-3 block"></i>
                        <h3 class="font-bold text-sm mb-1">Task Management</h3>
                        <p class="text-xs text-blue-200 opacity-80">Track assignments</p>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-white/10 border border-white/20 backdrop-blur-md rounded-2xl p-5 hover:bg-white/15 transition-colors">
                        <i class="ri-team-line text-2xl text-blue-200 mb-3 block"></i>
                        <h3 class="font-bold text-sm mb-1">Team Overview</h3>
                        <p class="text-xs text-blue-200 opacity-80">Manage employees</p>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-white/10 border border-white/20 backdrop-blur-md rounded-2xl p-5 hover:bg-white/15 transition-colors">
                        <i class="ri-shield-check-line text-2xl text-blue-200 mb-3 block"></i>
                        <h3 class="font-bold text-sm mb-1">Saved securely</h3>
                        <p class="text-xs text-blue-200 opacity-80">Role-based access</p>
                    </div>
                </div>
            </div>
            
            <!-- Abstract decorative elements at bottom -->
            <div class="relative z-10 mt-12 flex gap-4 opacity-80 mix-blend-overlay">
                <div class="h-32 w-64 bg-white/20 rounded-2xl rotate-[-6deg] backdrop-blur-lg border border-white/30"></div>
                <div class="h-24 w-48 bg-white/10 rounded-2xl rotate-[4deg] backdrop-blur-lg border border-white/20 -ml-12 mt-8"></div>
            </div>
            
            <!-- Gradient Glows -->
            <div class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] bg-blue-400/30 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-[400px] h-[400px] bg-indigo-500/30 rounded-full blur-[100px] pointer-events-none"></div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-[45%] xl:w-1/2 flex items-center justify-center p-6 sm:p-12 relative overflow-hidden bg-slate-50/50">
            <!-- Subtle background circle for right side -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-blue-50 rounded-full blur-[100px] -z-10"></div>
            
            <div class="w-full max-w-[420px] bg-white rounded-[2rem] p-8 sm:p-10 shadow-[0_8px_40px_rgb(0,0,0,0.04)] border border-slate-100/60 relative z-10">
                
                <!-- Form Header -->
                <div class="text-center mb-8">
                    <div class="mx-auto w-12 h-12 bg-blue-600 text-white rounded-2xl flex items-center justify-center mb-5 shadow-lg shadow-blue-600/30">
                        <i class="ri-shield-keyhole-fill text-2xl"></i>
                    </div>
                    
                    <div class="inline-flex items-center justify-center px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-bold tracking-widest uppercase rounded-full mb-4">
                        Secure Access
                    </div>
                    
                    <h2 class="text-2xl font-bold text-slate-900 mb-2 tracking-tight">Welcome back</h2>
                    <p class="text-sm text-slate-500 leading-relaxed px-4">
                        Continue your business management from where you left off.
                    </p>
                </div>

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 text-red-700 text-sm font-medium rounded-xl border border-red-100 flex items-start">
                        <i class="ri-error-warning-fill mr-2 text-red-500 text-lg mt-0.5"></i>
                        <ul class="list-none space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                    @csrf
                    
                    <!-- Email Input -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Email address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="ri-mail-line text-slate-400 text-lg"></i>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}" required 
                                class="w-full pl-11 pr-4 py-3 bg-slate-100/70 border-2 border-transparent focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl outline-none transition-all text-slate-700 font-medium placeholder:text-slate-400 placeholder:font-normal" 
                                placeholder="admin@biztech.com">
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5 ml-1 mr-1">
                            <label class="block text-sm font-semibold text-slate-700">Password</label>
                            <a href="#" class="text-xs font-semibold text-blue-600 hover:text-blue-700 hover:underline transition-all">Forgot password?</a>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="ri-lock-line text-slate-400 text-lg"></i>
                            </div>
                            <input type="password" name="password" required 
                                class="w-full pl-11 pr-12 py-3 bg-slate-100/70 border-2 border-transparent focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 rounded-xl outline-none transition-all text-slate-700 font-medium placeholder:text-slate-400 placeholder:font-normal" 
                                placeholder="••••••••••••">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity text-slate-400 hover:text-slate-600">
                                <i class="ri-eye-off-line"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center ml-1">
                        <label class="flex items-center cursor-pointer group">
                            <div class="relative flex items-center justify-center w-5 h-5 mr-2 bg-slate-100 border-2 border-slate-300 rounded-md group-hover:border-blue-500 transition-colors">
                                <input type="checkbox" name="remember" class="peer absolute opacity-0 w-full h-full cursor-pointer">
                                <i class="ri-check-line text-white text-sm opacity-0 peer-checked:opacity-100 pointer-events-none z-10 transition-opacity"></i>
                                <div class="absolute inset-0 bg-blue-600 rounded-[4px] opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none"></div>
                            </div>
                            <span class="text-sm font-medium text-slate-600 group-hover:text-slate-800 transition-colors">Remember me</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full mt-2 bg-[#2563eb] hover:bg-[#1d4ed8] text-white font-semibold py-3.5 px-4 rounded-xl transition-all shadow-[0_4px_14px_0_rgba(37,99,235,0.39)] hover:shadow-[0_6px_20px_rgba(29,78,216,0.23)] hover:-translate-y-[1px] flex items-center justify-center gap-2 group">
                        <i class="ri-arrow-right-line group-hover:translate-x-1 transition-transform"></i>
                        Log in securely
                    </button>
                    
                    <!-- Footer Link -->
                    <div class="text-center mt-8 pt-6 border-t border-slate-100">
                        <p class="text-sm font-medium text-slate-500">
                            New to BizTechSolutions? 
                            <a href="{{ route('contact.show') }}" class="text-blue-600 hover:text-blue-700 hover:underline transition-all">Create an account</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</body>
</html>
