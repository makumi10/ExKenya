<div>
    <div class="flex justify-end">
        <x-modal>
            <x-slot name="trigger">
                <button wire:click="storeModal"
                    class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none">
                    <i class="fas fa-plus mt-1 mr-1"></i> Add a new County
                </button>
            </x-slot>
            <x-slot name="title">Create a new County</x-slot>
            <x-slot name="content">
                <x-admins.county-form :updating="0"></x-admins.county-form>
                @if ($newphotos)
                    <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
                        @foreach ($newphotos as $photo)
                            <img src="{{ $photo->temporaryUrl() }}" class=" w-48 h-48 object-contain">
                        @endforeach
                    </div>
                @endif

            </x-slot>
            <x-slot name="Action">
                <button type="button"
                    class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none"
                    wire:click="store">
                    create
                </button>
            </x-slot>
        </x-modal>
    </div>
    {{-- table --}}
    <div class="text-gray-900 bg-white">
        <div class="flex justify-center">
            <table class="w-full text-md bg-white shadow-md rounded mb-4">
                <tbody>
                    <tr class="border-b relative">
                        <th class="text-left p-3 px-5">County</th>
                        <th class="text-left p-3 px-5 hidden sm:table-cell">
                            Region
                        </th>
                        <!-- <th class="text-left p-3 px-5 hidden lg:table-cell">
                            currency
                        </th> -->
                        <th class=""></th>
                    </tr>
                    @foreach ($counties as $county)
                        <tr class="border-b hover:bg-orange-100">
                            <td class="p-3 px-5 w-64">
                                <p class="text-sm sm:text-base tracking-wider font-semibold">
                                    {{ $county->name }}
                                </p>
                            </td>
                            <td class="p-3 px-5 w-64">
                                <p class="text-base tracking-wider font-semibold hidden sm:table-cell">
                                    {{ $county->region }}
                                </p>
                            </td>
                            <!-- <td class="p-3 px-5">
                                <p class="text-base tracking-wider font-semibold hidden lg:table-cell">
                                    {{ $county->currency }}
                                </p>
                            </td> -->
                            <td class="p-3 px-5 flex flex-col sm:flex-row justify-end">
                                {{-- update county modal --}}
                                <x-modal class="mb-2">
                                    <x-slot name="trigger">
                                        <button type="button" wire:click="updateModal({{ $county->id }})"
                                            class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded w-24 focus:outline-none focus:shadow-outline flex">
                                            <i class="fas fa-edit mt-1 mr-1"></i>update
                                        </button>
                                    </x-slot>
                                    <x-slot name="title">update a county</x-slot>
                                    <x-slot name="content">
                                        <x-admins.county-form :updating="1"></x-admins.county-form>
                                    </x-slot>
                                    <x-slot name="Action">
                                        <button
                                            class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none "
                                            wire:click="update">
                                            Update
                                        </button>
                                    </x-slot>
                                </x-modal>
                                {{-- Manage County modal --}}
                                <div class="mb-2">
                                    <a href="{{ route('admin.county.manage.cities', $county->id) }}"
                                        class="mr-3 text-sm bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-2 rounded w-24 focus:outline-none flex focus:shadow-outline">
                                        <i class="fas fa-cogs mt-1 mr-1"></i>Manage

                                    </a>
                                </div>
                                {{-- delete County modal --}}
                                <x-modal class="mb-2 mr-2">
                                    <x-slot name="trigger">
                                        <button type="button"
                                            class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded w-24 focus:outline-none focus:shadow-outline">
                                            <i class="fas fa-trash mt-1 mr-1"></i>Delete
                                        </button>
                                    </x-slot>
                                    <x-slot name="title">Delete county</x-slot>
                                    <x-slot name="content">
                                        <div class="flex p-6">
                                            <i class="fas fa-exclamation-triangle fa-2x text-red-700"></i>
                                            <h2 class=" font-bold text-red-700 text-2xl mt-1 ml-1 uppercase">Deleting a
                                                county
                                            </h2>
                                        </div>
                                        <div class="mt-4 p-6">
                                            <p class="font-semibold text-lg capitalize tracking-wider">
                                                Deleting a county means losing all data related to it , like cities, towns,
                                                hotels , points of interst, resturants and images ...
                                                are you sure you want to continue ?
                                            </p>
                                        </div>
                                    </x-slot>
                                    <x-slot name="Action">
                                        <button wire:click="Delete({{ $county->id }})"
                                            class="bg-red-700 hover:bg-red-900 px-4 py-2 rounded text-white focus:outline-none">
                                            Delete
                                        </button>
                                    </x-slot>
                                </x-modal>
                                {{-- images --}}
                                <x-modal class="mb-2">
                                    <x-slot name="trigger">
                                        <button type="button" wire:click="CountyImages({{ $county->id }})"
                                            class="text-sm bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-2 rounded w-24 focus:outline-none focus:shadow-outline">
                                            <i class="fas fa-eye mt-1 mr-1"></i>IMAGES
                                        </button>
                                    </x-slot>
                                    <x-slot name="title">{{ $county->name }} images</x-slot>
                                    <x-slot name="content">
                                        @if ($CountyImages)
                                            @foreach ($CountyImages as $image)
                                                <div class="mb-2 flex justify-center items-start">
                                                    <img src="{{ asset('storage/counties/' . $image->file_name) }}"
                                                        alt="" class=" w-10/12 h-full mb-2 ">
                                                    <button wire:click="DeleteImage({{ $image->id }})"
                                                        class="bg-red-700 hover:bg-red-900 px-2 py-1 rounded text-white focus:outline-none">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            @endforeach

                                        @endif
                                    </x-slot>
                                </x-modal>
                            </td>
                            {{-- eof actions --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $counties->links() }}
    </div>
</div>
