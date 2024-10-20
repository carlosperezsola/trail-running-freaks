<section id="trf__brand_slider" class="brand_slider_2">
    <div class="container">
        <div class="trf__section_header for_md mt-3 d-block d-md-flex mt-5 text-center text-md-start">
            <h3>@lang('Trademarks')</h3>
        </div> 
        <div class="brand_border">
            <div class="row brand_slider py-5 d-flex aling-items-center">
                @foreach ($trademarks as $trademark)
                    <div class="col-xl-2 d-flex aling-items-center justify-content-center">
                        <div class="trf__brand_logo">
                            <img src="{{ asset($trademark->logo) }}" alt="{{ $trademark->name }}" class="img-fluid w-auto h-auto">
                            <p class="fs-6 text-center text-uppercase fw-bold pt-3">{{ $trademark->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>