<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Biography') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('biography.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="biography" :value="__('Biography')" />
            <x-text-input id="biography" name="biography" type="text" class="mt-1 block w-full" :value="old('biography', $user->biography)" required autofocus autocomplete="biography" />
            {{-- <textarea id="biography" name="biography" type="text" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" :value="old('biography', $user->biography)" required autofocus autocomplete="biography" /></textarea> --}}
            <x-input-error class="mt-2" :messages="$errors->get('biography')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'biography-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
