@extends('admin.dashboard')
@section('content')
    @include('components.breadcrumb', [
        'title' => __('Projects'),
        'items' => [['label' => __('Home'), 'url' => route('admin.dashboard')], ['label' => __('Projects')]],
    ])

    <livewire:projects.index />
@endsection
