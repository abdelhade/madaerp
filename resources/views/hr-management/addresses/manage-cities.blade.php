@extends('admin.dashboard')
@section('content')
    @include('components.breadcrumb', [
        'title' => __('Cities'),
        'items' => [['label' => __('Home'), 'url' => route('admin.dashboard')], ['label' => __('Cities')]],
    ])


<livewire:hr-management.addresses.manage-cities />
 
@endsection
