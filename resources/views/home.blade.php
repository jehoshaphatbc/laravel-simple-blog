<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-10 max-w-7xl sm:px-6 lg:px-8">

            @auth

            <x-toaster.success/>

            {{-- for authenticated users --}}
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-6">
                    <h2 class="text-lg font-semibold">Your Posts</h2>

                    @foreach ($posts as $post)
                    <div class="p-5 border rounded-md shadow">
                        <div class="flex items-center gap-2">
                            <span class="flex-none px-2 py-1 {{ classStatus($post->status->value) }} rounded">
                                {{ $post->status->label() }}
                            </span>
                            <h3><a href="{{ route('posts.show', $post->id) }}" class="text-blue-500">{{ $post->title }}</a></h3>
                        </div>
                        <div class="flex items-end justify-between mt-4">
                            <div>
                                <div>Published: {{ dateFormat($post->publish_date) }}</div>
                                <div>Updated: {{ dateFormat($post->updated_at) }}</div>
                            </div>
                            <div>
                                <div>
                                    <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500">Detail</a> /
                                    <a href="{{ route('posts.edit', $post->id) }}" class="text-blue-500">Edit</a> /
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    {{ $posts->withQueryString()->links() }}
                </div>
            </div>

            @else

            {{-- for gueset users --}}
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>Please <a href="{{ route('login') }}" class="text-blue-500">login</a> or
                    <a href="{{ route('register') }}" class="text-blue-500">register</a>.</p>
                </div>
            </div>

            @endauth

        </div>
    </div>
</x-app-layout>
