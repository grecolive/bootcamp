<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Chrips') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('chirps.update',$chirp) }}" method="post">
                        @csrf
                        @method('PUT')
                        <textarea @required(true) class="block w-full bg-white rounded-md text-black border-collapse border-gray-300 shadow-sm bg-transparent" name="message" id="message" rows="5" placeholder="{{__('What`s on your mind?')}}">{{ old('message',$chirp->message) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('message')" />
                        <x-primary-button class="mt-4">{{__('Update Chrips')}}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>