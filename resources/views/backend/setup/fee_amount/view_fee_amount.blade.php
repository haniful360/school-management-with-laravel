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
                                                {{-- @php
                                                    echo $amount->fee_category_id;
                                                @endphp --}}
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $amount['fee_category']['name'] }}</td>
                                                    {{-- <td>{{ $amount->fee_category->name}}</td> --}}
                                                    <td>
                                                        <a href="{{ route('amount.edit', $amount->fee_category_id) }}"
                                                            class="btn btn-info btn-rounded">Edit</a>
                                                        <a href="{{ route('amount.show', $amount->fee_category_id) }}"
                                                            class="btn btn-primary btn-rounded">Details</a>
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
@endsection
