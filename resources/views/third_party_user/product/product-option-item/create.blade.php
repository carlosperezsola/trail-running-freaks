@extends('third_party_user.layouts.main')

@section('title')
    {{ $settings->site_name }} || @lang('Product Option Item Section')
@endsection

@section('container')
    <section id="trf__dashboard">
        <div class="container-fluid">
            @include('third_party_user.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <a href="{{ route('third_party_user.products-option-item.index', ['productId' => $product->id, 'optionId' => $option->id]) }}"
                        class="btn btn-warning mb-4"><i class="fas fa-long-arrow-left"></i> @lang('Back')</a>
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> @lang('Create Option Item')</h3>
                        <div class="trf__dashboard_profile">
                            <div class="trf__dash_pro_area  overflow-auto">
                                <form action="{{ route('third_party_user.products-option-item.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group trf__input">
                                        <label>@lang('Option Name')</label>
                                        <input type="text" class="form-control" name="option_name"
                                            value="{{ $option->name }}" readonly>
                                    </div>
                                    <div class="form-group trf__input">
                                        <input type="hidden" class="form-control" name="option_id"
                                            value="{{ $option->id }}">
                                    </div>
                                    <div class="form-group trf__input">
                                        <input type="hidden" class="form-control" name="product_id"
                                            value="{{ $product->id }}">
                                    </div>
                                    <div class="form-group trf__input">
                                        <label>@lang('Item Name')</label>
                                        <input type="text" class="form-control" name="name" value="">
                                    </div>
                                    <div class="form-group trf__input">
                                        <label>@lang('Price') <code>(@lang('Set 0 for make it free'))</code></label>
                                        <input type="text" class="form-control" name="price" value="">
                                    </div>
                                    <div class="form-group trf__input">
                                        <label for="inputState">@lang('Is Default')</label>
                                        <select id="inputState" class="form-control" name="is_default">
                                            <option value="">@lang('Select')</option>
                                            <option value="1">@lang('Yes')</option>
                                            <option value="0">@lang('No')</option>
                                        </select>
                                    </div>
                                    <div class="form-group trf__input">
                                        <label for="inputState">@lang('Status')</label>
                                        <select id="inputState" class="form-control" name="status">
                                            <option value="1">@lang('Active')</option>
                                            <option value="0">@lang('Inactive')</option>
                                        </select>
                                    </div>
                                    <button type="submmit" class="btn btn-primary">@lang('Create')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
