@extends('layouts.main')

@section('title', 'Edit User')

@section('content')
<div class="max-w-x7l mx-auto bg-white rounded-2xl shadow-lg p-8 mb-10">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-3">✏️ Edit User</h1>

    {{-- Error Alert --}}
    @if ($errors->any())
        <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc pl-6 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                class="mt-1 w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                class="mt-1 w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700">Password (opsional)</label>
            <input type="password" name="password" id="password"
                class="mt-1 w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
            <small class="text-gray-500">Kosongkan jika tidak ingin mengganti password.</small>
        </div>

        {{-- Konfirmasi Password --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="mt-1 w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
        </div>

        {{-- Role --}}
        <div>
            <label for="role" class="block text-sm font-semibold text-gray-700">Role</label>
            <select name="role" id="role"
                class="mt-1 w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        {{-- Divisi --}}
        <div>
            <label for="divisi_id" class="block text-sm font-semibold text-gray-700">Divisi</label>
            <select name="divisi_id" id="divisi_id"
                class="mt-1 w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                <option value="">-- Pilih Divisi --</option>
                @foreach ($divisis as $divisi)
                    <option value="{{ $divisi->id }}" {{ $user->divisi_id == $divisi->id ? 'selected' : '' }}>
                        {{ $divisi->nama_divisi }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tempat --}}
        <div>
            <label for="tempat_id" class="block text-sm font-semibold text-gray-700">Tempat</label>
            <select name="tempat_id" id="tempat_id"
                class="mt-1 w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                @foreach ($tempats as $tempat)
                    <option value="{{ $tempat->id }}" {{ $user->tempat_id == $tempat->id ? 'selected' : '' }}>
                        {{ $tempat->nama_tempat }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.users.index') }}"
                class="px-5 py-2 rounded-xl bg-gray-200 text-gray-700 font-medium hover:bg-gray-300 transition">
                Batal
            </a>
            <button type="submit"
                class="px-5 py-2 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 shadow-md transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

{{-- Ajax untuk tempat --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#divisi_id').on('change', function () {
            let divisiId = $(this).val();
            if (divisiId) {
                $.ajax({
                    url: '/admin/users/get-tempat/' + divisiId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#tempat_id').empty().append('<option value="">-- Pilih Tempat --</option>');
                        $.each(data, function (id, nama) {
                            $('#tempat_id').append('<option value="' + id + '">' + nama + '</option>');
                        });
                    }
                });
            } else {
                $('#tempat_id').empty().append('<option value="">-- Pilih Tempat --</option>');
            }
        });
    });
</script>
@endsection
