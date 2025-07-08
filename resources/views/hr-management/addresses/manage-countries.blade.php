@extends('admin.dashboard')
@section('content')
    @include('components.breadcrumb', [
        'title' => __('Countries'),
        'items' => [['label' => __('Home'), 'url' => route('admin.dashboard')], ['label' => __('Countries')]],
    ])


<livewire:hr-management.addresses.manage-countries />
 
@endsection
