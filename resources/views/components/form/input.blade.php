<div>
    <label for="{{ $name }}"
        class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $attributes->get('value')) }}"
        {{ $required ? 'required' : '' }}

        {{ $attributes->merge([
            'class' => '
                mt-1 block w-full rounded-md
                bg-white dark:bg-gray-900
                border-gray-300 dark:border-gray-700
                text-gray-900 dark:text-gray-100
                shadow-sm
                focus:border-blue-500 focus:ring-blue-500
                sm:text-sm
                ' . ($errors->has($name)
                    ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
                    : '')
        ]) }}
    >

    @error($name)
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">
            {{ $message }}
        </p>
    @enderror
</div>
