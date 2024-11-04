@extends('third_party_user.layouts.main')

@section('title')
    {{ $settings->site_name }} || @lang('Shop Profile Section')
@endsection

@section('container')
    <section id="trf__dashboard">
        <div class="container-fluid">
            @include('third_party_user.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> @lang('Shop profile')</h3>
                        <div class="trf__dashboard_profile">
                            <div class="trf__dash_pro_area">
                                <form action="{{ route('third_party_user.shop-profile.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group trf__input">
                                        <label>@lang('Preview')</label>
                                        <br>
                                        <img width="200px" src="{{ asset($profile->banner) }}" alt="">
                                    </div>
                                    <div class="form-group trf__input">
                                        <label>Banner</label>
                                        <input type="file" class="form-control" name="banner">
                                    </div>
                                    <div class="form-group trf__input">
                                        <label>@lang('Shop Name')</label>
                                        <input type="text" class="form-control" name="shop_name"
                                            value="{{ $profile->shop_name }}">
                                    </div>
                                    <div class="form-group trf__input">
                                        <label>@lang('Phone')</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ $profile->phone }}">
                                    </div>
                                    <div class="form-group trf__input">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ $profile->email }}">
                                    </div>
                                    <div class="form-group trf__input">
                                        <label>@lang('Address')</label>
                                        <input type="text" class="form-control" name="address"
                                            value="{{ $profile->address }}">
                                    </div>
                                    <div class="form-group trf__input">
                                        <label>@lang('Description')</label>
                                        <textarea class="summernote" name="description">{{ $profile->description }}</textarea>
                                    </div>
                                    <div class="form-group trf__input">
                                        <label>Facebook</label>
                                        <input type="text" class="form-control" name="fb_link"
                                            value="{{ $profile->fb_link }}">
                                    </div>
                                    <div class="form-group trf__input">
                                        <label>Twitter</label>
                                        <input type="text" class="form-control" name="tw_link"
                                            value="{{ $profile->tw_link }}">
                                    </div>
                                    <div class="form-group trf__input">
                                        <label>Instagram</label>
                                        <input type="text" class="form-control" name="insta_link"
                                            value="{{ $profile->insta_link }}">
                                    </div>
                                    <button type="submmit" class="btn btn-primary">@lang('Update')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
