@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container">
        <h2>Profile</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Name: {{ $user->name }}</h5>
                <p class="card-text">Email: {{ $user->email }}</p>
                <p class="card-text">Role: {{ $user->role->name }}</p>
                <p class="card-text">Status: {{ $user->status ? 'Active' : 'Inactive' }}</p>
            </div>
        </div>
    </div>
@endsection
