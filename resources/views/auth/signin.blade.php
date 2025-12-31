<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | {{ \App\Models\Setting::get('site_name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="h-full bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-50">

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-[400px] space-y-6">

            <div class="flex flex-col space-y-2 text-center">
                <div
                    class="mx-auto h-10 w-10 rounded-lg bg-zinc-900 dark:bg-zinc-50 flex items-center justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white dark:text-black" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-semibold tracking-tight">
                    Selamat datang kembali
                </h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">
                    Masukkan email dan password untuk masuk
                </p>
            </div>

            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 shadow-sm rounded-xl p-6">
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div class="space-y-2">
                        <label for="email"
                            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                            Email
                        </label>
                        <input type="email" id="email" name="email" placeholder="nama@example.com" required
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:border-zinc-800 dark:bg-zinc-950 dark:ring-offset-zinc-950 dark:placeholder:text-zinc-400 dark:focus-visible:ring-zinc-300">
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label for="password" class="text-sm font-medium leading-none">
                                Password
                            </label>
                            <a href="#"
                                class="text-xs text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-300 transition-colors">
                                Lupa password?
                            </a>
                        </div>
                        <input type="password" id="password" name="password" placeholder="••••••••" required
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:border-zinc-800 dark:bg-zinc-950 dark:ring-offset-zinc-950 dark:placeholder:text-zinc-400 dark:focus-visible:ring-zinc-300">
                    </div>

                    <div class="flex items-center space-x-2 py-1">
                        <input type="checkbox" id="remember" name="remember"
                            class="h-4 w-4 rounded border-zinc-300 text-zinc-900 focus:ring-zinc-950 dark:border-zinc-700 dark:bg-zinc-950 dark:focus:ring-zinc-300">
                        <label for="remember"
                            class="text-sm text-zinc-500 dark:text-zinc-400 select-none cursor-pointer font-medium leading-none">
                            Ingat perangkat ini
                        </label>
                    </div>

                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-white transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-zinc-900 text-zinc-50 hover:bg-zinc-900/90 h-10 px-4 py-2 w-full dark:bg-zinc-50 dark:text-zinc-900 dark:hover:bg-zinc-50/90 active:scale-[0.98]">
                        Masuk ke Akun
                    </button>
                </form>

                
            </div>

            <p class="text-center text-sm text-zinc-500 dark:text-zinc-400">
                Belum punya akun?
                <a href="#"
                    class="underline underline-offset-4 hover:text-zinc-900 dark:hover:text-zinc-50 font-medium">
                    Daftar gratis
                </a>
            </p>
        </div>
    </div>

</body>

</html>
