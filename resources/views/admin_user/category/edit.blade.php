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
                            <h4>@lang('Edit Category')</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin_user.category.update', $category->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>@lang('Icon')</label>
                                    <div>
                                        <button class="btn btn-primary" data-icon="{{$category->icon}}" data-selected-class="btn-danger" data-unselected-class="btn-info" role="iconpicker" name="icon"></button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input type="text" class="form-control" name="name" value="{{$category->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">@lang('Status')></label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{$category->status == 1 ? 'selected' : ''}} value="1">@lang('Active')</option>
                                        <option {{$category->status == 0 ? 'selected' : ''}} value="0">@lang('Inactive')</option>
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
