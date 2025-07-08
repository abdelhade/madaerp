@extends('admin.dashboard')
@section('content')
    <div class="card-body" class="form-control">
        <form action="{{ route('settings.update') }}" method="POST" class="form-control">
            @csrf
            @method('POST')
            <div class="accordion shadow-sm rounded" id="accordionExample-faq">
                @foreach ($cateries as $category)
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="heading-{{ $category->id }}">
                            <button class="accordion-button collapsed fw-bold text-primary bg-light" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse-{{ $category->id }}"
                                aria-expanded="false" aria-controls="collapse-{{ $category->id }}">
                                <i class="bi bi-folder me-2 text-secondary"></i>
                                {{ $category->name }}
                            </button>
                        </h2>
                        <div id="collapse-{{ $category->id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading-{{ $category->id }}" data-bs-parent="#accordionExample-faq">
                            <div class="accordion-body bg-white text-dark">
                                @if ($category->publicSettings->count())
                                    @foreach ($category->publicSettings as $setting)
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold text-dark">{{ $setting->label }}</label>
                                            <input type="{{ $setting->input_type }}" name="settings[{{ $setting->key }}]"
                                                value="{{ $setting->value }}" class="form-control"
                                                placeholder="Enter value for {{ $setting->label }}">
                                            <small class="form-text text-muted">المفتاح: {{ $setting->key }}</small>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-warning mb-0">لا توجد إعدادات عامة ضمن هذه الفئة.</div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($cateries->sum(fn($category) => $category->publicSettings->count()) > 0)
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-4">حفظ الإعدادات</button>
                </div>
            @endif
        </form>
    </div>
@endsection
