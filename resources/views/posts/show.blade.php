<x-app-layout>
    <div class="px-4 py-8 text-gray-100">
        <h1 class="text-xl font-bold">Name: {{ $post->title }}</h1>
        <p class="mt-2">Description: {{ $post->content }}</p>

        @if ($post->image)
            <img src="/images/{{ $post->image }}" alt="Post image">
        @endif

        <p class="mt-5">Links:</p>
        @if (is_array($post->repeatable_fields))
            @foreach ($post->repeatable_fields as $field)
                <div class="mt-4">
                    <h2 class="text-lg">name: {{ $field['name'] }}</h2>
                    <p>description: {{ $field['description'] }}</p>
                </div>
            @endforeach
        @endif
    </div>
</x-app-layout>
