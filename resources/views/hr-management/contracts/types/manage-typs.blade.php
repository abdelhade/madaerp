@extends('admin.dashboard')
@section('content')
    @include('components.breadcrumb', [
        'title' => __('Contract Types'),
        'items' => [['label' => __('Home'), 'url' => route('admin.dashboard')], ['label' => __('HR Management')], ['label' => __('Contract Types')]],
    ])


<livewire:hr-management.contracts.types.manage-typs />
 
@endsection