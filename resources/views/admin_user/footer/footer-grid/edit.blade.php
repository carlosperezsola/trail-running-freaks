@extends('admin_user.layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Footer')</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('Edit Footer Info Section')</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin_user.footer-grid.update', $footer->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input type="text" class="form-control" name="name" value="{{ $footer->name }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('url')</label>
                                    <input type="text" class="form-control" name="url" value="{{ $footer->url }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">@lang('Status')</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $footer->status === 1 ? 'selected' : '' }} value="1">@lang('Active')</option>
                                        <option {{ $footer->status === 0 ? 'selected' : '' }} value="0">@lang('Inactive')
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
