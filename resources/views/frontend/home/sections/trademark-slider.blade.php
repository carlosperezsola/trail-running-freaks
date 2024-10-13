<section id="trf__brand_slider" class="brand_slider_2">
    <div class="container">
        <div class="brand_border">
            <div class="row brand_slider py-5 d-flex aling-items-center">
                @foreach ($trademarks as $trademark)
                    <div class="col-xl-2 d-flex aling-items-center">
                        <a href="{{ asset($trademark->slug) }}" alt="{{ $trademark->name }}">
                            <div class="trf__brand_logo">
                                <img src="{{ asset($trademark->logo) }}" alt="{{ $trademark->name }}" class="img-fluid w-auto h-auto">
                                <p class="fs-6 text-center text-uppercase fw-bold pt-3">{{ $trademark->name }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>