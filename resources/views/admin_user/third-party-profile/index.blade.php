@extends('admin_user.layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Third Party Profile')</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('Update Third Party Profile')</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin_user.third-party-profile.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>@lang('Preview')</label>
                                    <br>
                                    <img width="200px" src="{{ asset($profile->banner) }}" alt="">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Banner')</label>
                                    <input type="file" class="form-control" name="banner">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Shop Name')</label>
                                    <input type="text" class="form-control" name="shop_name"
                                        value="{{ $profile->shop_name }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Phone')</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $profile->phone }}">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" value="{{ $profile->email }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Address')</label>
                                    <input type="text" class="form-control" name="address"
                                        value="{{ $profile->address }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Description')</label>
                                    <textarea class="summernote" name="description">{{ $profile->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" class="form-control" name="fb_link"
                                        value="{{ $profile->fb_link }}">
                                </div>
                                <div class="form-group">
                                    <label>Twitter</label>
                                    <input type="text" class="form-control" name="tw_link"
                                        value="{{ $profile->tw_link }}">
                                </div>
                                <div class="form-group">
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
    </section>
@endsection
