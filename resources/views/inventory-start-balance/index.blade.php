@extends('admin.dashboard')
@section('content')
    <div class="div">
        <a href="{{ route('inventory-balance.create') }}" class="btn btn-primary">Create</a>
    </div>
@endsection
