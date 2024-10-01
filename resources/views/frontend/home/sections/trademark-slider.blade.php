<section id="trf__brand_slider" class="brand_slider_2">
    <div class="container">
        <div class="brand_border">
            <div class="row brand_slider">
                @foreach ($trademarks as $trademark)
                    <div class="col-xl-2">
                        <div class="trf__brand_logo">
                            <img src="{{ asset($trademark->logo) }}" alt="{{ $trademark->name }}" class="img-fluid w-100">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>