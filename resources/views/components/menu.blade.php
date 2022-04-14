<x-nav-link :href="route('home')" :active="request()->routeIs('home')">
    {{ __('Cinema') }}
</x-nav-link>
<x-nav-link :href="route('room.index')" :active="request()->routeIs('room.index')">
    {{ __('Rooms') }}
</x-nav-link>
<x-nav-link :href="route('session.index')" :active="request()->routeIs('session.index')">
    {{ __('Sessions') }}
</x-nav-link>
<x-nav-link :href="route('movie.index')" :active="request()->routeIs('movie.index')">
    {{ __('Movies') }}
</x-nav-link>
<x-nav-link :href="route('artist.index')" :active="request()->routeIs('artist.index')">
    {{ __('Artists') }}
</x-nav-link>
<x-nav-link :href="route('country.index')" :active="request()->routeIs('country.index')">
    {{ __('Countries') }}
</x-nav-link>
