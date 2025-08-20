<div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 p-6 flex items-center justify-between">
    <div>
        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">{{ $title }}</h3>
        <p class="text-4xl font-bold text-gray-900 mt-2">{{ $value }}</p>
    </div>
    <div class="bg-gradient-to-br {{ $color }} text-white rounded-full p-4 shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            {!! $icon !!}
        </svg>
    </div>
</div>