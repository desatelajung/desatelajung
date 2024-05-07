@extends('layouts.new.app')

@section('content')
    <div class="container">

        <!-- Alert untuk pemberitahuan -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Daftar Menu</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-danger">Pdf</button>
                    <button type="button" class="btn btn-sm btn-outline-success">Excel</button>
                    <a href="{{ route('menus.create') }}" class="btn btn-sm btn-outline-primary">Add</a>
                </div>
            </div>
        </div>

        <div class="table-responsive small">

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Menu</th>
                        <th scope="col">URL</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allMenus as $menu)
                        <tr>
                            <td><input type="checkbox" name="" id=""></td>
                            <td>{{ $menu->name }}</td>
                            <td>{{ $menu->link }}</td>
                            <td>{{ $menu->icon }}</td>
                            <td>
                                <a href="{{ route('menus.show', $menu->id) }}" class="text-info text-decoration-none me-2"
                                    title="Lihat"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('menus.edit', $menu->id) }}"
                                    class="text-primary text-decoration-none me-2" title="Edit"><i
                                        class="fas fa-edit"></i></a>
                                <form action="{{ route('menus.destroy', $menu->id) }}" method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0" title="Hapus"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
