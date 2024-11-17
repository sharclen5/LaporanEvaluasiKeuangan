<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex justify-between items-start">
                <!-- Profile Information Form -->
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            
                <!-- Image and Upload Form -->
                <div class="flex flex-col items-center mr-48">
                    <!-- Circle Image -->
                    <div class="w-52 h-52 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden mb-8">
                        @if($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-500">No Image</span>
                        @endif
                    </div>
            
                    <!-- Upload Form -->
                    <form action="{{ route('user.updatePhoto') }}" method="POST" enctype="multipart/form-data" class="flex flex-col items-center">
                        @csrf
                        @method('PUT')
                        <input type="file" name="photo" accept="image/*" class="hidden" id="photo-upload">
                        <div class="flex space-x-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Save
                            </button>
                            <label for="photo-upload" class="cursor-pointer inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Upload Photo
                            </label>
                        </div>
                    </form>
                </div>
            </div>
            

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
