@extends('admin_user.layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Trademark</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('Update') Trademark</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin_user.trademark.update', $trademark->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Preview</label>
                                    <br>
                                    <img width="200" src="{{ asset($trademark->logo) }}" alt="">
                                </div>
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" class="form-control" name="logo">
                                </div>

                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input type="text" class="form-control" name="name" value="{{ $trademark->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">@lang('Is Featured')</label>
                                    <select id="inputState" class="form-control" name="is_featured">
                                        <option value="">@lang('Select')</option>
                                        <option {{ $trademark->is_featured == 1 ? 'selected' : '' }} value="1">@lang('Yes')</option>
                                        <option {{ $trademark->is_featured == 0 ? 'selected' : '' }} value="0">@lang('No')</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">@lang('Status')</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $trademark->status == 1 ? 'selected' : '' }} value="1">@lang('Active')</option>
                                        <option {{ $trademark->status == 0 ? 'selected' : '' }} value="0">@lang('Inactive')</option>
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
