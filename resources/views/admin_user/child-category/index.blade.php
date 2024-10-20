@extends('admin_user.layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Child Category</h1>
        </div>

        <div class="section-body">            
            <div class="row">
                <div class="col-12 col-12 p-0 p-lg-4">
                    <div class="card">
                        <div class="card-header row d-flex justify-content-around">
                            <div class="col">
                                <div class="col">
                                <h4>All Child Categories</h4>
                            </div>
                            <div class="card-header-action text-end">
                                <a href="{{route('admin_user.child-category.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create New</a>
                            </div>
                        </div>
                        <div class="card-body p-0 p-lg-4">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function(){
            $('body').on('click', '.change-status', function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{route('admin_user.child-category.change-status')}}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data){
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush