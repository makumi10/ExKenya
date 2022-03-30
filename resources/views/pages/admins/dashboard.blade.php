<x-admins.admin-dashboard>
    <x-slot name="mainNav">
        <x-admins.dashboard-nav-links />
    </x-slot>
    @if (request()->is('admin/users'))
        <x-slot name="content">
            @livewire('admins.users')
        </x-slot>
    @endif
    @if (request()->is('admin/counties'))
        <x-slot name="content">
            @livewire('admins.counties')
        </x-slot>
    @endif
    @if (request()->is('admin/manage-channels'))
        <x-slot name="content">
            @livewire('admins.blog')
        </x-slot>
    @endif

</x-admins.admin-dashboard>
