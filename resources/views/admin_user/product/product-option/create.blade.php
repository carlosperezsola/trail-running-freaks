@extends('admin_user.layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Product Option')</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('Create Option')</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin_user.products-option.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input type="text" class="form-control" name="name" value="">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="product"
                                        value="{{ request()->product }}">
                                </div>
                                <div class="form-group">
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
    </section>
@endsection
