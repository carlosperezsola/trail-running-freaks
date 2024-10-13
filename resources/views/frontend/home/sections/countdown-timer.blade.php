<section id="trf__count_down" class="trf__count_down_2">
    <div class=" container">
        <div class="row">
            <div class="col-xl-12">
                <div class="offer_time" style="background: url({{ asset('frontend/images/count_down_bg.jpg') }})">
                    <div class="trf__flash_coundown">
                        <span class="end_text">Flash Sale</span>
                        <div class="simply-countdown simply-countdown-one"></div>
                        <a class="common_btn" href="{{ route('count-down') }}">See more <i
                                class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
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
