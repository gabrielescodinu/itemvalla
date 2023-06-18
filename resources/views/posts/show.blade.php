<x-guest-layout>
    <div class="px-4 py-8 text-gray-100 max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6 relative pb-32">
        <div class="relative overflow-hidden shadow-xl z-10 rounded-lg">
            <div class="absolute inset-0">
                @if ($post->image)
                    <img class="object-cover w-full h-full" src="{{ asset('storage/images/' . $post->image) }}" alt="">
                @endif
                <div class="absolute inset-0 bg-gray-500 mix-blend-multiply"></div>
            </div>
            <div class="relative px-4 py-16 sm:px-6 sm:py-24 lg:py-32 lg:px-8">
                <div class="max-w-2xl p-10 mx-auto text-center">
                    <div>
                        <p class="font-bold text-3xl lg:text-4xl text-gray-100"> {{ $post->title }} </p>
                        <p class="max-w-xl mt-4 text-lg tracking-tight text-gray-300"> {{ $post->content }} </p>
                    </div>
                </div>
            </div>
        </div>

        <p class="mt-5 text-center text-xl tracking-widest uppercase font-semibold">All Items</p>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start relative z-10 px-8 lg:px-0">
            @if ($post->repeatable_fields)
                @foreach ($post->repeatable_fields as $field)
                    <div class="flex flex-col items-center justify-center w-full max-w-sm mx-auto">
                        @if (isset($field['image']) && is_string($field['image']))
                            <div class="w-full h-64 bg-gray-300 bg-center bg-cover rounded-lg shadow-md" style="background-image: url('{{ asset('storage/images/' . $field['image']) }}')"> </div>
                        @endif

                        <div class="-mt-10 overflow-hidden rounded-lg shadow-lg w-[90%] dark:bg-gray-800">
                            <h3 class="py-2 font-bold tracking-widest text-center text-gray-800 uppercase dark:text-white">{{ $field['name'] }}</h3>

                            <div class="p-3 bg-gray-700">
                                <p class="font-bold text-gray-300 ">{{ $field['description'] }}</p>
                                <button class="px-3 py-2 mt-3 text-sm font-semibold text-white uppercase transition-colors duration-300 transform bg-primary rounded hover:bg-gray-700 dark:hover:bg-gray-600 focus:bg-gray-700 dark:focus:bg-gray-600 focus:outline-none">Go to!</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="absolute inset-0 blur-[118px] max-w-lg h-[800px] mx-auto sm:max-w-3xl sm:h-[400px] bg-gradient-to-r from-primaryfade to-secondaryfade"> </div>
    </div>
</x-guest-layout>
