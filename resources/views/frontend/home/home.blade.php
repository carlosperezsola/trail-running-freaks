@extends('frontend.layouts.main')

@section('title')
    {{ $settings->site_name }}
@endsection

@section('container')
    <!--============================
            BANNER PART 2 START
        ==============================-->
    @include('frontend.home.sections.hb-slider')
    <!--============================
            BANNER PART 2 END
        ==============================-->


    <!--============================
            COUNT DOWN START
        ==============================-->
    @include('frontend.home.sections.countdown-timer')
    <!--============================
            COUNT DOWN END
        ==============================-->


    <!--============================
            MONTHLY TOP PRODUCT START
        ==============================-->
    @include('frontend.home.sections.top-categories')
    <!--============================
            MONTHLY TOP PRODUCT END
        ==============================-->


    <!--============================
            BRAND SLIDER START
        ==============================-->
    @include('frontend.home.sections.brand-slider')
    <!--============================
            BRAND SLIDER END
        ==============================-->


    <!--============================
            ELECTRONIC PART START
        ==============================-->
    {{-- @include('frontend.home.sections.category-product-slider-one') --}}
    <!--============================
            ELECTRONIC PART END
        ==============================-->


    <!--============================
            ELECTRONIC PART START
        ==============================-->
    {{-- @include('frontend.home.sections.category-product-slider-two') --}}
    <!--============================
            ELECTRONIC PART END
        ==============================-->


    <!--============================
            LARGE BANNER  START
        ==============================-->
    {{-- @include('frontend.home.sections.large-banner') --}}
    <!--============================
            LARGE BANNER  END
        ==============================-->


    <!--============================
            WEEKLY BEST ITEM START
        ==============================-->
    {{-- @include('frontend.home.sections.weekly-best-item') --}}
    <!--============================
            WEEKLY BEST ITEM END
        ==============================-->


    <!--============================
            HOME SERVICES START
        ==============================-->
    {{-- @include('frontend.home.sections.services') --}}
    <!--============================
            HOME SERVICES END
        ==============================-->


    <!--============================
            HOME BLOGS START
        ==============================-->
    {{-- @include('frontend.home.sections.blogs') --}}
    <!--============================
            HOME BLOGS END
        ==============================-->
@endsection
