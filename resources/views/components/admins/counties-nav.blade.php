<div x-data="{ active : '{{ Request::route()->getName() }}' }">
    <nav class="flex flex-col sm:flex-row">
        <a href="{{ route('admin.county.manage.cities', $CountyId) }}"
            class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none uppercase"
            :class="{ 'border-b-2 font-medium border-blue-500' : active === 'admin.county.manage.cities'}">
            Cities & Towns
        </a>
        <a href="{{ route('admin.county.manage.hotels', $CountyId) }}"
            class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none uppercase"
            :class="{ 'border-b-2 font-medium border-blue-500' : active === 'admin.county.manage.hotels'}"> Hotels
        </a>
        <a href="{{ route('admin.county.manage.pointsOfInterest', $CountyId) }}"
            class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none uppercase"
            :class="{ 'border-b-2 font-medium border-blue-500' : active === 'admin.county.manage.pointsOfInterest'}">
            Points of Interest
        </a>
        <a href="{{ route('admin.county.manage.restaurants', $CountyId) }}"
            class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none uppercase"
            :class="{ 'border-b-2 font-medium border-blue-500' : active === 'admin.county.manage.restaurants'}">
            Restaurants
        </a>
    </nav>
</div>
