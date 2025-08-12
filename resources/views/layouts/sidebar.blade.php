<nav class="flex-1 mt-6 px-4">
    <ul class="space-y-2">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors duration-200 
                {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('admin.divisi.index') }}" class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors duration-200 
                {{ request()->routeIs('admin.divisi.*') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5a2 2 0 00-2 2v2a2 2 0 002 2h14a2 2 0 002-2v-2a2 2 0 00-2-2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v7m-4-7h8" />
                </svg>
                Divisi
            </a>
        </li>

        <li>
            <a href="{{ route('admin.tempat.index') }}" class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors duration-200 
                {{ request()->routeIs('admin.tempat.*') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Tempat
            </a>
        </li>

        <li x-data="{ open: {{ request()->routeIs('admin.materi.*') ? 'true' : 'false' }} }" class="relative">
            <button @click="open = !open" class="flex items-center w-full p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors duration-200 focus:outline-none
                {{ request()->routeIs('admin.materi.*') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.485 9.176 4 7 4l-2 4m5-4h2m-2 4h4m-1.253-11.747A11.968 11.968 0 0012 1a11.968 11.968 0 018.747 3.253M12 6.253v13m0-13C13.168 5.485 14.824 4 17 4l2 4m-5-4h2m-2 4h4m1.253-11.747A11.968 11.968 0 0112 1a11.968 11.968 0 018.747 3.253" />
                </svg>
                Materi
                <svg class="h-5 w-5 ml-auto transition-transform duration-200" :class="{ 'rotate-90': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
            
            <ul x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-y-0 transform" x-transition:enter-end="opacity-100 scale-y-100 transform" class="pl-8 mt-2 space-y-2 origin-top">
                <li>
                    <a href="{{ route('admin.materi.index') }}" class="flex items-center p-2 text-gray-600 hover:text-blue-600 transition-colors duration-200 rounded-lg 
                        {{ request()->routeIs('admin.materi.index') ? 'text-blue-600 font-semibold' : '' }}">
                        <span class="mr-2">&bull;</span> Upload Materi
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.materi.history') }}" class="flex items-center p-2 text-gray-600 hover:text-blue-600 transition-colors duration-200 rounded-lg 
                        {{ request()->routeIs('admin.materi.history') ? 'text-blue-600 font-semibold' : '' }}">
                        <span class="mr-2">&bull;</span> History Materi
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{ route('admin.users.index') }}" class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors duration-200 
                {{ request()->routeIs('admin.users.index') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                User
            </a>
        </li>
    </ul>
</nav>
