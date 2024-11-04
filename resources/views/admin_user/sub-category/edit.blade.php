@extends('admin_user.layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Sub @lang('Category')</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('Update Sub Category')</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin_user.sub-category.update', $subCategory->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="inputState">@lang('Category')</label>
                                    <select id="inputState" class="form-control" name="category">
                                        <option value="">@lang('Select')</option>
                                        @foreach ($categories as $category)
                                            <option {{ $category->id == $subCategory->category_id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $subCategory->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">@lang('Status')</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $subCategory->status == 1 ? 'selected' : '' }} value="1">@lang('Active')
                                        </option>
                                        <option {{ $subCategory->status == 0 ? 'selected' : '' }} value="0">@lang('Inactive')
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
    </section>
@endsection
