<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="card-title">{{ $title ?? '' }}</h4>
                    <ol class="breadcrumb">
                        @foreach ($items ?? [] as $item)
                            <li class="breadcrumb-item">
                                @if (isset($item['url']))
                                    <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                                @else
                                    {{ $item['label'] }}
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
