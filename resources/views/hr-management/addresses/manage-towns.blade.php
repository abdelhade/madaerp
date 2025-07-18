@extends('admin.dashboard')
@section('content')
    @include('components.breadcrumb', [
        'title' => __('Towns'),
        'items' => [['label' => __('Home'), 'url' => route('admin.dashboard')], ['label' => __('Towns')]],
    ])


<livewire:hr-management.addresses.manage-towns />
 
@endsection
