@extends('admin.dashboard')

@section('content')
    @include('components.breadcrumb', [
        'title' => 'Create Quotation Info',
        'items' => [['label' => 'Home', 'url' => route('admin.dashboard')], ['label' => 'Create Quotation Info']],
    ])
    <livewire:inquiries::quotation-info />
@endsection
