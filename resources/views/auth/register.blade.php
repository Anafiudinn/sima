<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Divisi -->
        <div class="mt-4">
            <x-input-label for="divisi_id" :value="__('Pilih Divisi')" />
            <select id="divisi_id" name="divisi_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">-- Pilih Divisi --</option>
                @foreach($divisis as $d)
                    <option value="{{ $d->id }}">{{ $d->nama_divisi }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('divisi_id')" class="mt-2" />
        </div>

        <!-- Tempat -->
        <div class="mt-4">
            <x-input-label for="tempat_id" :value="__('Pilih Tempat')" />
            <select id="tempat_id" name="tempat_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">-- Pilih Tempat --</option>
            </select>
            <x-input-error :messages="$errors->get('tempat_id')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Script untuk load tempat berdasarkan divisi -->
    <script>
        document.getElementById('divisi_id').addEventListener('change', function () {
            let divisiId = this.value;
            let tempatSelect = document.getElementById('tempat_id');

            tempatSelect.innerHTML = '<option>Loading...</option>';

            if (divisiId) {
                fetch(`/get-tempat/${divisiId}`)
                    .then(res => res.json())
                    .then(data => {
                        tempatSelect.innerHTML = '<option value="">-- Pilih Tempat --</option>';
                        data.forEach(t => {
                            tempatSelect.innerHTML += `<option value="${t.id}">${t.nama_tempat}</option>`;
                        });
                    })
                    .catch(() => {
                        tempatSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                    });
            } else {
                tempatSelect.innerHTML = '<option value="">-- Pilih Tempat --</option>';
            }
        });
    </script>
</x-guest-layout>
