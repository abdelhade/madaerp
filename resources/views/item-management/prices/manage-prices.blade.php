@extends('admin.dashboard')
@section('content')
    @include('components.breadcrumb', [
        'title' => __('Prices'),
        'items' => [['label' => __('Home'), 'url' => route('admin.dashboard')], ['label' => __('Prices')]],
    ])

    <livewire:item-management.prices.manage-prices />
@endsection
