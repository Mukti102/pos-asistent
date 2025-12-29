

<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-64 border-r border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 transition-transform duration-300
           lg:static lg:translate-x-0"
>

    <!-- Header -->
    <div class="flex h-14 items-center border-b border-gray-200 dark:border-gray-800 px-6 font-semibold tracking-tight">
        <span class="text-lg">Dashboard</span>
    </div>

    <!-- Navigation -->
    <nav class="space-y-1 p-4">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors {{ activeMenu('dashboard') }}">
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
        <a href="#"
           class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors {{ activeMenu('customers.*') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 viewBox="0 0 24 24">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
            Customers
        </a>

        <!-- Users -->
        <a href="{{ route('users.index') }}"
           class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors {{ activeMenu('users.*') }}">
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
           class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors {{ activeMenu('category.*') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
            Kategory
        </a>
        <!-- Product -->
        <a href="{{ route('products.index') }}"
           class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors {{ activeMenu('products.*') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
        Product
        </a>
        <!-- Transaction -->
        <a href="{{ route('transactions.index') }}"
           class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors {{ activeMenu('transactions.*') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
        Transactions
        </a>
        <!-- Transaction -->
        <a href="{{ route('pos.index') }}"
           class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors {{ activeMenu('pos.*') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
            POS
        </a>

    </nav>
</aside>


