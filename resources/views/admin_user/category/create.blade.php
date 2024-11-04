@extends('admin_user.layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Category')</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('Create Category')</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin_user.category.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>@lang('Icon')</label>
                                    <div>
                                        <button class="btn btn-primary" data-icon="" data-selected-class="btn-danger" data-unselected-class="btn-info" role="iconpicker" name="icon"></button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input type="text" class="form-control" name="name" value="">
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
