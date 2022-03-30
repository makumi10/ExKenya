{{-- <x-models-component :name="$county->name" :object="$county">
    <x-slot name="slider">
        <x-slider :images="$countyImages" :folder="'counties'" />
    </x-slot>   
    
</x-models-component> --}}


@livewire('model-template' , ['type' => 'county' , 'object'=> $county])