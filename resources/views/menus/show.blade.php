@extends('layouts.new.app')

@section('content')
    <div class="container">
        <h1>Detail Menu</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $menu->name }}</h5>
                <p class="card-text">Deskripsi: {{ $menu->description ?? 'Tidak ada deskripsi' }}</p>
                <p class="card-text">Dibuat pada: {{ $menu->created_at }}</p>
                <p class="card-text">Diperbarui pada: {{ $menu->updated_at }}</p>
                <a href="{{ route('menus.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Daftar Submenu</h1>
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
                        <th scope="col">Link</th>
                        <th scope="col">Icon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($submenus as $submenu)
                        <tr>
                            <td><input type="checkbox" name="" id=""></td>
                            <td>{{ $submenu->name }}</td>
                            <td>{{ $submenu->link }}</td>
                            <td>{{ $submenu->icon }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
