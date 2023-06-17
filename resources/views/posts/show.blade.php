<x-app-layout>
    <div class="px-4 py-8 text-gray-100">
        <h1 class="text-xl font-bold">Name: {{ $post->title }}</h1>
        <p class="mt-2">Description: {{ $post->content }}</p>

        @if ($post->image)
            <img src="{{ asset('storage/images/' . $post->image) }}" alt="Post image">
        @endif

        <p class="mt-5">Links:</p>
        @if ($post->repeatable_fields)
            @foreach ($post->repeatable_fields as $field)
                <h2>{{ $field['name'] }}</h2>
                <p>{{ $field['description'] }}</p>
                @if (isset($field['image']) && is_string($field['image']))
                    <img src="{{ asset('storage/app/' . $field['image']) }}" alt="Field image">
                @endif
            @endforeach
        @endif
    </div>
</x-app-layout>
