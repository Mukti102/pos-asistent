

<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-64 border-r border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-transform duration-300
           lg:static lg:translate-x-0"
>

    <!-- Header -->
    <div class="flex h-14 items-center border-b border-gray-200 dark:border-gray-800 px-6 font-semibold tracking-tight">
        <span class="text-lg ">{{\App\Models\Setting::get('site_name')}}</span>
    </div>

    <!-- Navigation -->
    <nav class="space-y-1 p-4">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3  rounded-md px-3 py-2 text-sm font-medium transition-colors {{ activeMenu('dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 viewBox="0 0 24 24">
                <rect width="7" height="9" x="3" y="3" rx="1" />
                <rect width="7" height="5" x="14" y="3" rx="1" />
                <rect width="7" height="9" x="14" y="12" rx="1" />
                <rect width="7" height="5" x="3" y="16" rx="1" />
            </svg>
            Dashboard
        </a>

        <!-- Customers -->
        {{-- <a href="#"
           class="flex items-center gap-3  rounded-md px-3 py-2 text-sm font-medium transition-colors {{ activeMenu('customers.*') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 viewBox="0 0 24 24">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
            Customers
        </a> --}}

        <!-- Users -->
        <a href="{{ route('users.index') }}"
           class="flex items-center gap-3  rounded-md px-3 py-2 text-sm font-medium transition-colors {{ activeMenu('users.*') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
            Users
        </a>
        <!-- categoru -->
        <a href="{{ route('category.index') }}"
           class="flex items-center gap-3  rounded-md px-3 py-2 text-sm font-medium transition-colors {{ activeMenu('category.*') }}">
           {{-- category svg --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 viewBox="0 0 24 24">
                <path d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z" />
            </svg>
            Kategory
        </a>
        <!-- Product -->
        <a href="{{ route('products.index') }}"
           class="flex items-center gap-3  rounded-md px-3 py-2 text-sm font-medium transition-colors {{ activeMenu('products.*') }}">
            {{-- product svg --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 viewBox="0 0 24 24">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4a2 2 0 0 0 1-1.73z" />
                <path d="M3.27 6.96L12 12.01l8.73-5.05" />
                <path d="M12 22.08V12" />
            </svg>
        Product
        </a>
        <!-- Transaction -->
        <a href="{{ route('transactions.index') }}"
           class="flex items-center gap-3  rounded-md px-3 py-2 text-sm font-medium transition-colors {{ activeMenu('transactions.*') }}">
           {{-- transactions svg --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 viewBox="0 0 24 24">
                <path d="M3 10h18M9 21V10m6 11V10M4 6h16M4 6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6z" />
            </svg>
        Transactions
        </a>
        <!-- Transaction -->
        <a href="{{ route('pos.index') }}"
           class="flex items-center gap-3  rounded-md px-3 py-2 text-sm font-medium transition-colors {{ activeMenu('pos.*') }}">
              {{-- pos svg --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 viewBox="0 0 24 24">
                <path d="M3 4h18M3 9h18M7 14h10M5 19h14M5 19a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-5H5v5z" />
            </svg>
            POS
        </a>
        <!-- Profile-->
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3  rounded-md px-3 py-2 text-sm font-medium transition-colors {{ activeMenu('pos.*') }}">
              {{-- profile svg --}}
             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
            Profile
        </a>

        {{-- settings --}}
            <a href="{{ route('settings.index') }}"
           class="flex items-center gap-3  rounded-md px-3 py-2 text-sm font-medium transition-colors {{ activeMenu('pos.*') }}">
              {{-- cog svg --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="3" />
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33h.09a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65A1.65 0 0 - --- IGNORE ---0 0 0 1 1.51 1.65 1.65 0 0 0 19.4 5h.09a1.65 1.65 0 0 0 1.51 1z" />
            </svg>

            Settings
        </a>

    </nav>
</aside>


