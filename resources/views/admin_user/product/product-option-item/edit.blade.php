@extends('admin_user.layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Product Option Items')</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('Update Option Item')</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin_user.products-option-item.update', $optionItem->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>@lang('Option Name')</label>
                                    <input type="text" class="form-control" name="option_name"
                                        value="{{ $optionItem->productOption->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Item Name')</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $optionItem->name }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Price') <code>(@lang('Set 0 for make it free'))</code></label>
                                    <input type="text" class="form-control" name="price"
                                        value="{{ $optionItem->price }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">@lang('Is Default')</label>
                                    <select id="inputState" class="form-control" name="is_default">
                                        <option value="">@lang('Select')</option>
                                        <option {{ $optionItem->is_default == 1 ? 'selected' : '' }} value="1">
                                            @lang('Yes')
                                        </option>
                                        <option {{ $optionItem->is_default == 0 ? 'selected' : '' }} value="0">
                                            @lang('No')
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">@lang('Status')</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $optionItem->status == 1 ? 'selected' : '' }} value="1">
                                            @lang('Active')</option>
                                        <option {{ $optionItem->status == 0 ? 'selected' : '' }} value="0">
                                            @lang('Inactive')</option>
                                    </select>
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
