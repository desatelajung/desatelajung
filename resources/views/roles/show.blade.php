@extends('layouts.new.app')

@section('title', 'Detail Role')

@section('content')
<div class="mb-3">
    <h2>Detail Role</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $role->name }}</h5>
            <p class="card-text">Deskripsi: {{ $role->description ?? 'Tidak ada deskripsi' }}</p>
            <p class="card-text">Dibuat pada: {{ $role->created_at }}</p>
            <p class="card-text">Diperbarui pada: {{ $role->updated_at }}</p>
            <a href="{{ route('roles.index') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>
<div class="mb-3">
    <h2>Daftar Menu</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Menu</th>
                <th scope="col">Akses</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
            <tr>
                <td>{{ $menu->name }}</td>
                <td>
                    <input class="form-check-input menu-access-switch" type="checkbox" data-role="{{ $role->id }}"
                        data-menu="{{ $menu->id }}" {{ $role->roleMenuAccessChecked($role->id, $menu->id) }}>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('.menu-access-switch').change(function () {
            var roleId = $(this).data('role');
            var menuId = $(this).data('menu');
            var isChecked = $(this).prop('checked') ? 1 : 0;

            $.ajax({
                url: '{{ route('roles.updateMenuAccess') }}',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'role_id': roleId,
                    'menu_id': menuId,
                    'is_checked': isChecked
                },
                success: function (response) {
                    console.log(response);

                    // Update the checkbox state based on the server response
                    if (response.success) {
                        // Jika tanggapan berhasil, update tampilan checkbox
                        if (isChecked) {
                            // Tandai checkbox jika sebelumnya tidak dicentang
                            $(this).prop('checked', true);
                        } else {
                            // Hapus tanda centang checkbox jika sebelumnya dicentang
                            $(this).prop('checked', false);
                        }
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection