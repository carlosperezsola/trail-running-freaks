<section id="trf__count_down" class="trf__count_down_2">
    <div class=" container">
        <div class="row">
            <div class="col-xl-12">
                <div class="offer_time" style="background: url({{ asset('frontend/images/count_down_bg.jpg') }})">
                    <div class="trf__countdown_section row">
                        <div class="col-12 col-md-3 text-center text-md-start mb-3 mb-md-0">
                            <span class="end_text">{{ $countDownDate ? $countDownDate->name : 'Default Text' }}</span>
                        </div>
                        <div class="simply-countdown simply-countdown-one col-12 col-md-6 mb-3 mb-md-0 d-flex justify-content-center justify-content-md-end"></div>
                        <div class="col-12 col-md-3 d-flex justify-content-center justify-content-md-end">
                            <a class="common_btn" href="{{ route('count-down') }}">@lang('See more') <i class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        <div class="trf__section_header for_md d-block d-md-flex mt-5 text-center text-md-start">
            <h3>Merchandising {{ $countDownDate ? $countDownDate->name : 'Default Text' }}</h3>
        </div> 
        <div class="row count_down_slider">       
            @php
                $products = \App\Models\Product::with(['options', 'category', 'productImageGalleries'])->whereIn('id', $countDownItems)->get();
            @endphp
            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </div>
</section>

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
