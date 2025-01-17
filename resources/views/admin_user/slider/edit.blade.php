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
                            <h4>@lang('Edit') Slider</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin_user.slider.update', $slider->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Preview</label>
                                    <br/>
                                    <img width="200" src="{{asset($slider->banner)}}" alt="">
                                </div>
                                <div class="form-group">
                                    <label>Banner</label>
                                    <input type="file" class="form-control" name="banner">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Type')</label>
                                    <input type="text" class="form-control" name="type" value="{{$slider->type}}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Title')</label>
                                    <input type="text" class="form-control" name="title" value="{{$slider->title}}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Starting price')</label>
                                    <input type="text" class="form-control" name="starting_price" value="{{$slider->starting_price}}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Button Url')</label>
                                    <input type="text" class="form-control" name="cta_url" value="{{$slider->cta_url}}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Serial')</label>
                                    <input type="text" class="form-control" name="serial" value="{{$slider->serial}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">@lang('Status')</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{$slider->status == 1 ? 'selected': ''}} value="1">@lang('Active')</option>
                                        <option {{$slider->status == 0 ? 'selected': ''}}value="0">@lang('Inactive')</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">@lang('Update')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
