<?php

if (!function_exists('activeMenu')) {
    function activeMenu($route)
    {
        return request()->routeIs($route)
            ? 'bg-gray-200 dark:bg-gray-800 text-gray-700 dark:text-gray-50'
            : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-50';
    }
}
