@extends('layouts.new.app')

@section('content')
<h1>Role Menu Management</h1>
@foreach ($roles as $role)
<table class="table table-responsive my-3">
    <thead>
        <tr>
            <th><input type="checkbox"></th>
            <th>Nama Role</th>
            <th>Nama menu</th>
            <th>Access</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($menus as $menu)
        <tr>
            <td><input type="checkbox"></td>
            <td>{{ $role->name }}</td>
            <td>{{ $menu->name }}</td>
            <td><input type="checkbox" class="menu-access-switch" data-role="{{ $role->id }}"
                    data-menu="{{ $menu->id }}" {{ $role->roleMenuAccessChecked($role->id, $menu->id) }}></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endforeach

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('.menu-access-switch').change(function () {
            var roleId = $(this).data('role');
            var menuId = $(this).data('menu');
            var isChecked = $(this).prop('checked') ? 1 : 0;
            console.log(roleId, menuId)
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