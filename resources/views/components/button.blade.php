<button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex items-center w-56 px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-center text-xs text-white uppercase hover:bg-indigo-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
