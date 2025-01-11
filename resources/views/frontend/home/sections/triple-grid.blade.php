<section id="trf__hot_deals" class="trf__hot_deals_2">
    <div class="container">
        <div class="trf__section_header for_md mb-4 d-block d-md-flex mt-5 text-center text-md-start">
            <h3>@lang('Highlights Section')</h3>
        </div>        
        <section id="trf__single_banner" class="home_2_single_banner pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        @if ($homepage_section_promo->promo_one->status == 1)
                            <div class="trf__single_banner_content banner_1 h-100 mb-3 mb-lg-0">
                                <a href="{{ $homepage_section_promo->promo_one->promo_url }}">
                                    <img class="img-fluid"
                                        src="{{ asset($homepage_section_promo->promo_one->promo_image) }}"
                                        alt="">
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                @if ($homepage_section_promo->promo_two->status == 1)
                                    <div class="trf__single_banner_content single_banner_2 h-100 mb-3 mb-lg-0">
                                        <a href="{{ $homepage_section_promo->promo_two->promo_url }}">
                                            <img class="img-fluid"
                                                src="{{ asset($homepage_section_promo->promo_two->promo_image) }}"
                                                alt="">
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="col-12 mt-lg-4">
                                <div class="trf__single_banner_content single_banner_3 h-100">
                                    @if ($homepage_section_promo->promo_three->status == 1)
                                        <a href="{{ $homepage_section_promo->promo_three->promo_url }}">
                                            <img class="img-fluid"
                                                src="{{ asset($homepage_section_promo->promo_three->promo_image) }}"
                                                alt="">
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
