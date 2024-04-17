@php

    use App\Models\User;

    $currentUrl = url()->current();

    $parts = explode('/', $currentUrl);
    $id = end($parts);

    $user = User::find($id); // Retrieve the user by ID

    if ($user) {
        $name = $user->name; // Extract the "name" column value
        $biography = $user->biography;
    } else {
        $name = 'Not found'; // Handle case when no record is found
        $biography = "😭";
    }

@endphp

<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            <div class="p-6 flex space-x-2">
                <div class="flex gap-3 w-full justify-between">
                    <div class="flex flex-col gap-2 mr-10">
                        <p class="text-5xl font-bold">{{ $name }}</p>
                        <p class="text-xl font-semibold">{{ $biography }}</p>
                    </div>
                        <!--Test affichage nb followers-->   
                    <div class="flex flex-col gap-1 items-end">
                        @if (!$user->is(auth()->user()))
                            <div class="mb-3 space-x-2">
                                <!--Condition pour afficher follow ou unfollow--> 
                                @if(auth()->user()->follows($user))
                                <form method="POST" action="{{ route('users.unfollow',$user ->id)}}">
                                    @csrf
                                <x-primary-button>{{ __('Unfollow') }}</x-primary-button>
                                </form>
                                @else
                                <form method="POST" action="{{ route('users.follow',$user ->id)}}">
                                    @csrf
                                <x-primary-button>{{ __('Follow') }}</x-primary-button>
                                </form>
                                @endif
                            </div>         
                        @endif
                        <p class="text-lg text-gray-600">{{ $user->followers()->count() }} followers</p>
                        <p class="text-lg text-gray-600">{{ $user->followings()->count() }} following</p>
                        {{-- @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif --}}
                        <!--On ne peut follow/unfollow que les autres utilisateurs-->     
                        
                    </div>
        </div>
    </div>
    </div>
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($userPosts as $post)
                <!-- Afficher le post -->
                    <div class="p-6 flex space-x-2">
                        
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div class="flex gap-2 items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <span class="text-gray-800">{{ $post->user->name }}</span>
                                    <small class="text-sm text-gray-600">{{ $post->created_at->format('j M Y, g:i a') }}</small>
                                    @unless ($post->created_at->eq($post->updated_at))
                                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                    @endunless
                                </div>
                                @if ($post->user->is(auth()->user()))
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link :href="route('posts.edit', $post)">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                            <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                                @csrf
                                                @method('delete')
                                                <x-dropdown-link :href="route('posts.destroy', $post)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                    {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                @endif
                            </div>
                            <p class="mt-4 text-lg text-gray-900">{{ $post->message }}</p>
                            <img class="w-100% h-auto" src="{{ $post->image_path }}"  />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>