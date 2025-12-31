 
            <header class="sticky top-0 z-30 flex h-14 items-center gap-4 border-b border-gray-200 dark:border-gray-800 bg-white/95 dark:bg-gray-950/95 px-6 backdrop-blur supports-[backdrop-filter]:bg-white/60">
                
                <button @click="sidebarOpen = true" class="lg:hidden p-2 -ml-2 text-gray-500 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                </button>

                <div class="flex w-full items-center justify-between">
                    <h1 class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                       @yield('title',\App\Models\Setting::get('site_name'))
                    </h1>

                    <div class="flex items-center gap-4">
                        
                        <div class="hidden md:block relative">
                             <svg class="absolute left-2.5 top-2.5 h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                             <input type="search" placeholder="Search..." class="h-9 w-64 rounded-md border border-gray-200 bg-transparent py-1 pl-9 pr-4 text-sm outline-none placeholder:text-gray-500 focus:ring-1 focus:ring-gray-950 dark:border-gray-800 dark:focus:ring-gray-300">
                        </div>

                        <button @click="toggleTheme()" class="inline-flex h-9 w-9 items-center justify-center rounded-md border border-gray-200 bg-transparent hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-gray-800 transition-colors">
                            <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-500 dark:text-gray-400"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                            <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-500"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
                        </button>

                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <span class="text-xs font-medium text-gray-600 dark:text-gray-300">CN</span>
                            </button>
                            <div x-show="open" @click.outside="open = false" 
                                 class="absolute right-0 top-full mt-2 w-56 rounded-md border border-gray-200 bg-white shadow-lg dark:border-gray-800 dark:bg-gray-950 p-1"
                                 style="display: none;">
                                <div class="px-2 py-1.5 text-sm font-semibold">My Account</div>
                                <div class="h-px bg-gray-200 dark:bg-gray-800 my-1"></div>
                                <a href="{{route('profile.edit')}}" class="block rounded-sm px-2 py-1.5 text-sm hover:bg-gray-100 dark:hover:bg-gray-800">Profile</a>
                                <a href="{{route('settings.index')}}" class="block rounded-sm px-2 py-1.5 text-sm hover:bg-gray-100 dark:hover:bg-gray-800">Settings</a>
                                <div class="h-px bg-gray-200 dark:bg-gray-800 my-1"></div>
                                <form action="{{route('logout')}}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="block rounded-sm px-2 py-1.5 text-sm text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/10">Log out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>