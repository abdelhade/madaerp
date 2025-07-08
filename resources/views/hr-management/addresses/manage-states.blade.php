@extends('admin.dashboard')
@section('content')
    @include('components.breadcrumb', [
        'title' => __('States'),
        'items' => [['label' => __('Home'), 'url' => route('admin.dashboard')], ['label' => __('States')]],
    ])


<livewire:hr-management.addresses.manage-states />
 
@endsection
