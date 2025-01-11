@extends('frontend.layouts.main')

@section('title')
    {{ $settings->site_name }} || @lang('Count Down Section')
@endsection

@section('container')
    <section id="trf__breadcrumb">
        <div class="trf_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>{{ $countDownDate ? $countDownDate->name : 'Default Text' }}</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="javascript:;">{{ $countDownDate ? $countDownDate->name : 'Default Text' }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="trf__daily_deals">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="trf__section_header rounded-0 d-block d-md-flex aling-items-between">
                        <div class="col-12 col-md-6 text-center text-md-start pb-3 pb-md-0">
                            <h3>Merchandising {{ $countDownDate ? $countDownDate->name : 'Default Text' }}</h3>
                        </div>
                        <div class="trf__offer_countdown pb-1 pb-md-0 d-flex justify-content-center justify-content-md-end">
                            <div>
                                <span class="end_text">ends time :</span>
                            </div>
                            <div class="simply-countdown simply-countdown-one"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @php
                    $products = \App\Models\Product::with(['options', 'category', 'productImageGalleries'])
                        ->whereIn('id', $countDownItems)
                        ->get();
                @endphp
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            simplyCountdown('.simply-countdown-one', {
                year: {{ date('Y', strtotime($countDownDate->end_date)) }},
                month: {{ date('m', strtotime($countDownDate->end_date)) }},
                day: {{ date('d', strtotime($countDownDate->end_date)) }},
            });
        })
    </script>
@endpush
