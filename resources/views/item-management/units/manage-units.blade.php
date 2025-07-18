@extends('admin.dashboard')
@section('content')
    @include('components.breadcrumb', [
        'title' => __('Units'),
        'items' => [['label' => __('Home'), 'url' => route('admin.dashboard')], ['label' => __('Units')]],
    ])

    <livewire:item-management.units.manage-units />
@endsection
