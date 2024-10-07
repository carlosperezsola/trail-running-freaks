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
                    TRADEMARK SLIDER START
                ==============================-->
    @include('frontend.home.sections.trademark-slider')
    <!--============================
                    TRADEMARK SLIDER END
                ==============================-->
    <!--============================
                    TRIPLE GRID SECTION START
                ==============================-->
    @include('frontend.home.sections.triple-grid')
    <!--============================
                    TRIPLE GRID SECTION END
                ==============================-->
@endsection
