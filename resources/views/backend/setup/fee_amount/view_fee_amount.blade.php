@extends('admin.admin_master')

@section('admin')
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border d-flex justify-content-between">
                                <h3 class="box-title">Fee Category Amount List</h3>
                                <a href="{{ route('amount.create') }}" class="btn btn-success btn-rounded">Add Fee
                                    Amount</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width='5%'>SL</th>
                                                <th>Fee Category</th>
                                                <th width='25%'>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allFeeCategoryAmount as $key => $amount)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $amount->name }}</td>
                                                    <td>
                                                        <a href="{{ route('category.edit', $amount->id) }}"
                                                            class="btn btn-info btn-rounded">Edit</a>
                                                        <a href="javascript:void(0)"
                                                            onclick="deleteAmountFee({{ $amount->id }})"
                                                            class="btn btn-danger btn-rounded">Delete</a>
                                                        <form id="delete-{{ $amount->id }}"
                                                            action="{{ route('amount.destroy', $amount->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->

        </div>
    </div>

    <script type="text/javascript">
        function deleteAmountFee(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-' + id).submit();
                    Swal.fire({
                        title: "Deleted!",
                        text: "User has been deleted.",
                        icon: "success"
                    });
                }
            })
        }
    </script>
@endsection
