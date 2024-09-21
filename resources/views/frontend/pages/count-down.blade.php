@extends('frontend.layouts.main')

@section('title')
    {{ $settings->site_name }} || Count Down Section
@endsection

@section('container')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Count Down</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="javascript:;">Count Down</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="wsus__daily_deals">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header rounded-0">
                        <h3>Count Down</h3>
                        <div class="wsus__offer_countdown">
                            <span class="end_text">ends time :</span>
                            <div class="simply-countdown simply-countdown-one"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @php
                    $products = \App\Models\Product::with(['variants', 'category', 'productImageGalleries'])
                        ->whereIn('id', $countDownItems)
                        ->get();
                @endphp
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
            {{-- <div class="mt-5">
                @if ($countDownItems->hasPages())
                    {{ $countDownItems->links() }}
                @endif
            </div> --}}
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
