<section id="trf__hot_deals" class="trf__hot_deals_2">
    <div class="container">        
        <section id="trf__single_banner" class="home_2_single_banner pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        @if ($homepage_section_banner->banner_one->status == 1)
                            <div class="trf__single_banner_content banner_1">
                                <a href="{{ $homepage_section_banner->banner_one->banner_url }}">
                                    <img class="img-gluid"
                                        src="{{ asset($homepage_section_banner->banner_one->banner_image) }}"
                                        alt="">
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                @if ($homepage_section_banner->banner_two->status == 1)
                                    <div class="trf__single_banner_content single_banner_2">
                                        <a href="{{ $homepage_section_banner->banner_two->banner_url }}">
                                            <img class="img-gluid"
                                                src="{{ asset($homepage_section_banner->banner_two->banner_image) }}"
                                                alt="">
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="col-12 mt-lg-4">
                                <div class="trf__single_banner_content">
                                    @if ($homepage_section_banner->banner_three->status == 1)
                                        <a href="{{ $homepage_section_banner->banner_three->banner_url }}">
                                            <img class="img-gluid"
                                                src="{{ asset($homepage_section_banner->banner_three->banner_image) }}"
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
