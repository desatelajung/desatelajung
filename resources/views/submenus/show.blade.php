@extends('layouts.new.app')

@section('content')
    <div class="container">
        <h1>Detail Menu</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $submenu->name }}</h5>
                <p class="card-text">Deskripsi: {{ $submenu->description ?? 'Tidak ada deskripsi' }}</p>
                <p class="card-text">Dibuat pada: {{ $submenu->created_at }}</p>
                <p class="card-text">Diperbarui pada: {{ $submenu->updated_at }}</p>
                <a href="{{ route('submenus.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
