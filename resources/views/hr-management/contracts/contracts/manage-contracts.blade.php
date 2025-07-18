@extends('admin.dashboard')
@section('content')
    @include('components.breadcrumb', [
        'title' => __('Contracts'),
        'items' => [['label' => __('Home'), 'url' => route('admin.dashboard')], ['label' => __('HR Management')], ['label' => __('Contracts')]],
    ])


<livewire:hr-management.contracts.contracts.manage-contracts />
 
@endsection