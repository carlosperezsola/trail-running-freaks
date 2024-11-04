@extends('admin_user.layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>
        </div>

        <div class="section-body">            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('Create') Slider</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin_user.slider.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Banner</label>
                                    <input type="file" class="form-control" name="banner">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Type')</label>
                                    <input type="text" class="form-control" name="type" value="{{old('type')}}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Title')</label>
                                    <input type="text" class="form-control" name="title" value="{{old('title')}}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Starting price')</label>
                                    <input type="text" class="form-control" name="starting_price" value="{{old('starting_price')}}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Button Url')</label>
                                    <input type="text" class="form-control" name="cta_url" value="{{old('cta_url')}}">
                                </div>
                                <div class="form-group">
                                    <label>Serial</label>
                                    <input type="text" class="form-control" name="serial" value="{{old('serial')}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">@lang('Status')</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option value="1">@lang('Active')</option>
                                        <option value="0">@lang('Inactive')</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">@lang('Create')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
