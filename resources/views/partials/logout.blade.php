{{-- Zone utilisateur --}}
<div id="user-menu-wrap" class="hidden lg:flex relative">
    <button id="user-btn"
        class="flex items-center gap-2 border border-gray-200 hover:border-red-700 rounded-sm px-3.5 py-2 cursor-pointer transition-colors bg-transparent">
        <x-icons.user />
        <span class="font-semibold text-[13px] text-gray-900">{{ Auth::user()->name }}</span>
        <x-icons.chevron />
    </button>

    {{-- Dropdown --}}
    <div id="user-dropdown"
        class="hidden absolute right-0 top-[calc(100%+8px)] w-[220px] bg-white border border-gray-200 rounded-sm shadow-lg z-50 overflow-hidden">

        {{-- En-tête --}}
        <div class="flex items-center gap-2.5 px-4 py-3.5 border-b border-gray-100">
            <svg class="w-[18px] h-[18px] text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>

            <div class="flex flex-col leading-snug">
                <span class="font-semibold text-[13px] text-gray-900">{{ Auth::user()->name }}</span>
                <span class="text-[11px] text-gray-400">{{ Auth::user()->email }}</span>
            </div>
        </div>

        {{-- Liens --}}
        <div class="py-1.5">
            <a href="{{ route('about') }}" class="dropdown-item w-full text-left px-4 py-2.5 text-[13px] text-gray-700 hover:bg-gray-50 cursor-pointer block">
                {{ __('messages.account') }}
            </a>

            <a href="{{ route('about') }}" class="dropdown-item w-full text-left px-4 py-2.5 text-[13px] text-gray-700 hover:bg-gray-50 cursor-pointer block">
                {{ __('messages.orders') }}
            </a>
        </div>

        {{-- Déconnection --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-2 px-4 py-2.5 text-[13px] font-semibold text-red-700 hover:bg-red-50 cursor-pointer">
                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                {{ __('messages.logout') }}
            </button>
        </form>
    </div>
</div>

{{-- Ouverture / Fermeture de la zone utilisateur --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const menu = document.querySelector('#user-menu-wrap');
    const button = menu.querySelector('#user-btn');
    const dropdown = menu.querySelector('#user-dropdown');
    const chevron = menu.querySelector('#user-chevron');

    button.addEventListener('click', (e) => {
        e.stopPropagation();

        dropdown.classList.toggle('hidden');
        chevron.classList.toggle('rotate-180');
    });

    document.addEventListener('click', (e) => {
        if (!menu.contains(e.target)) {
            dropdown.classList.add('hidden');
            chevron.classList.remove('rotate-180');
        }
    });
});
</script>
@endpush