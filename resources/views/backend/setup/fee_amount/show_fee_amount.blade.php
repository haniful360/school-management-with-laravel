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
                                <h3 class="box-title">Fee Category Amount Details</h3>
                                <a href="{{ route('amount.create') }}" class="btn btn-success btn-rounded">Add Fee
                                    Amount</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">

                                    <table id="example1" class="table table-bordered table-striped">

                                        <h5>
                                            <strong>Fee Category:</strong> {{ $detailsData[0]->fee_category->name }}
                                        </h5>
                                        <thead class="thead-light">
                                            <tr class="">
                                                <th width='5%'>SL</th>
                                                <th>Class Name</th>
                                                <th width='25%'>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detailsData as $key => $amount)
                                                {{-- @php
                                                    echo $amount->fee_category_id;
                                                @endphp --}}
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $amount->student_class->name }}</td>
                                                    <td>{{ $amount->amount }}</td>
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
