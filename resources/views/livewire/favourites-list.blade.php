<div>
    <section class=" mt-8 w-full h-auto bg-white p-8" style="min-height:600px">
        @if ($favourites->count() > 0)
            @foreach ($favourites as $favourite)
                <div class="flex flex-col md:flex-row items-center mb-8">
                    <img src="{{ $favourite->favouritable->homePageImage() }}" alt=""
                        class=" w-full md:w-44 h-44 rounded-xl shadow-md mr-4">
                    <div>
                        <p class=" text-center capitalize text-lg font-bold">
                            {{ $favourite->favouritable->name }}
                        </p>
                        <a href="{{ $favourite->route_name }}">
                            <i class="fas fa-eye"></i>
                            View
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <h1 class=" text-lg font-bold">You have no favourites yet ! </h1>
            <p class=" text-base font-semibold text-gray-600">
                Start adding places to favourites
            </p>
        @endif


        {{ $favourites->links() }}
    </section>
</div>
