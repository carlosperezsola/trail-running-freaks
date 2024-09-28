<section id="trf__banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="trf__banner_content">
                    <div class="row banner_slider">
                        @foreach ($sliders as $slider)
                            <div class="col-xl-12">
                                <div class="trf__single_slider" style="background: url({{$slider->banner}});">
                                    <div class="trf__single_slider_text">
                                        <h3>{!! $slider->type !!}</h3>
                                        <h1>{!! $slider->title !!}</h1>
                                        <h6>start at {{$settings->currency_icon}}{{$slider->starting_price}}</h6>
                                        <a class="common_btn" href="{{$slider->cta_url}}">shop now</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach     
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>