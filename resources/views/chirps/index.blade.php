<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chrips') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('chirps.store') }}" method="post">
                        @csrf
                        <textarea @required(true) class="block w-full bg-white rounded-md text-black border-collapse border-gray-300 shadow-sm bg-transparent" name="message" id="message" rows="5" placeholder="{{__('What`s on your mind?')}}">{{ old('message') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('message')" />
                        <x-primary-button class="mt-4">{{__('Create Chrips')}}</x-primary-button>
                    </form>
                </div>
            </div>
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                @foreach ($chirps as $chirp)
                    @canany(['update', 'view', 'delete'], $chirp)
                    <div class="p-6 flex space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800">{{ $chirp->user->name }}</span>
                                    <small class="ml-2 text-sm text-gray-600">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
                                    @unless($chirp->created_at->eq($chirp->updated_at))
                                        <small class="ml-2 text-sm text-gray-600">&middot; {{ __('Edited') }}</small>
                                    @endunless
                                    
                                </div>
                            </div>
                            <p class="mt-4 text-lg text-gray-900">{{ $chirp->message }}</p>
                        </div>                           
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button class="text-gray-600 hover:text-gray-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link class="text-green-300 uppercase hover:text-green-500" href="{{route('chirps.edit',$chirp)}}"> {{ __('Edit') }} </x-dropdown-link>
                                <form action="{{route('chirps.delete',$chirp)}}" method="post">
                                    @csrf @method('DELETE')
                                    <x-dropdown-link class="text-red-300 uppercase hover:text-red-500" href="{{route('chirps.delete',$chirp)}}" onclick="event.preventDefault(); this.closest('form').submit();">{{__('Delete')}}</x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @endcanany
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>