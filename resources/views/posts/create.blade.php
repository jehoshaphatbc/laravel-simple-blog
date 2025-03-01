<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create New Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <form method="POST" action="{{ route('posts.store') }}" class="space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="title" :value="__('Title')" required/>
                                <x-text-input id="title" name="title" type="text" class="block w-full mt-1" value="{{ old('title') }}" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="content" :value="__('Content')" required/>
                                <textarea id="content" name="content" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="6">{{ old('content') }}</textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="publish_date" :value="__('Publish Date')" />
                                <x-text-input id="publish_date" name="publish_date" type="date" class="block w-full mt-1" value="{{ old('publish_date') }}" />
                                <x-input-error :messages="$errors->get('publish_date')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="status" :value="__('Status')" required/>
                                <select id="status" name="status" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @foreach ($allStatus as $status)
                                        <option value="{{ $status->value }}" {{ old('status') === $status->value ? 'selected' : '' }}>
                                            {{ $status->label() }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Post') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
