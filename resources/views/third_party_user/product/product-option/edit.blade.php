@extends('third_party_user.layouts.main')

@section('title')
    {{ $settings->site_name }} || Product Option Section
@endsection

@section('container')
    <section id="trf__dashboard">
        <div class="container-fluid">
            @include('third_party_user.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <a href="{{ route('third_party_user.products-option.index', ['product' => $option->product_id]) }}"
                        class="btn btn-warning mb-4"><i class="fas fa-long-arrow-left"></i> Back</a>
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Update Option</h3>
                        <div class="trf__dashboard_profile">
                            <div class="trf__dash_pro_area  overflow-auto">
                                <form action="{{ route('third_party_user.products-option.update', $option->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group trf__input">
                                        <label>@lang('Name')</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $option->name }}">
                                    </div>
                                    <div class="form-group trf__input">
                                        <label for="inputState">@lang('Status')</label>
                                        <select id="inputState" class="form-control" name="status">
                                            <option {{ $option->status == 1 ? 'selected' : '' }} value="1">Active
                                            </option>
                                            <option {{ $option->status == 0 ? 'selected' : '' }} value="0">@lang('Update')
                                            </option>
                                        </select>
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
