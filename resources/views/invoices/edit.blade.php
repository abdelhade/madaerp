@extends('admin.dashboard')
@section('content')
    <div class="container">
        <livewire:edit-invoice-form :operationId="$invoice->id" />
    </div>
@endsection
