{{-- <x-guest-layout> --}}
    {{-- @livewire('user.reviews') --}}
    {{-- <x-slider></x-slider> --}}
{{-- </x-guest-layout> --}}
 
<x-app-layout>
    @livewire('county-feature' , ['object'=> $cities])
</x-app-layout>