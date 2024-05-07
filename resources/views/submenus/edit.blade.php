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

        <div class="row">
            <div class="my-3">
                <div class="h2">Edit Submenu</div>
                <form action="{{ route('submenus.update', $submenu->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="menu_id" class="form-label">Menu Induk</label>
                        <select class="form-select @error('menu_id') is-invalid @enderror" id="menu_id" name="menu_id">
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}" @if ($submenu->menu_id == $menu->id) selected @endif>
                                    {{ $menu->name }}</option>
                            @endforeach
                        </select>
                        @error('menu_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Submenu</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ $submenu->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">URL</label>
                        <input type="text" class="form-control @error('link') is-invalid @enderror" id="link"
                            name="link" value="{{ $submenu->link }}">
                        @error('link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">Ikon</label>
                        <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon"
                            name="icon" value="{{ $submenu->icon }}">
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>

    </div>
@endsection
