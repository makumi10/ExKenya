<x-admins.admin-dashboard>
    <x-slot name="countyNav">
        <x-admins.counties-nav :id="$id" />
    </x-slot>
    @if (Route::currentRouteName() == 'admin.county.manage.cities')
        <x-slot name="content">
            @livewire('admins.county-cities' , ['county' => $county])
        </x-slot>
    @elseif(Route::currentRouteName() == 'admin.county.manage.hotels')
        <x-slot name="content">
            @livewire('admins.county-hotels' , ['county' => $county])
        </x-slot>
    @elseif (Route::currentRouteName() == 'admin.county.manage.pointsOfInterest')
        <x-slot name="content">
            @livewire('admins.county-poi' , ['county' => $county])
        </x-slot>
    @elseif (Route::currentRouteName() == 'admin.county.manage.restaurants')
        <x-slot name="content">
            @livewire('admins.county-restaurants' , ['county' => $county])
        </x-slot>
    @endif
</x-admins.admin-dashboard>
