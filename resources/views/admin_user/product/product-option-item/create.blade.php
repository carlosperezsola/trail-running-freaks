@extends('admin_user.layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Product Option Items</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Option Item</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin_user.products-option-item.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Option Name</label>
                                    <input type="text" class="form-control" name="option_name"
                                        value="{{ $option->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="option_id"
                                        value="{{ $option->id }}">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="product_id"
                                        value="{{ $product->id }}">
                                </div>
                                <div class="form-group">
                                    <label>Item Name</label>
                                    <input type="text" class="form-control" name="name" value="">
                                </div>
                                <div class="form-group">
                                    <label>Price <code>(Set 0 for make it free)</code></label>
                                    <input type="text" class="form-control" name="price" value="">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Is Default</label>
                                    <select id="inputState" class="form-control" name="is_default">
                                        <option value="">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submmit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
