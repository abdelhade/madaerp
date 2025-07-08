@extends('admin.dashboard')
@section('content')
    @include('components.breadcrumb', [
        'title' => __('Jobs'),
        'items' => [['label' => __('Home'), 'url' => route('admin.dashboard')], ['label' => __('Jobs')]],
    ])


<livewire:hr-management.jobs.manage-jobs />
 
@endsection
