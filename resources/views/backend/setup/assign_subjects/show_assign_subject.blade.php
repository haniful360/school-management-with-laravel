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
                                            <strong>Fee Category:</strong> {{ $detailsData[0]->student_class->name }}
                                        </h5>
                                        <thead class="thead-light">
                                            <tr class="">
                                                <th width='5%'>SL</th>
                                                <th width='30%'>Subject Name</th>
                                                <th>Full Mark</th>
                                                <th>Pass Mark</th>
                                                <th>Subjective Mark</th>
                                                {{-- <th width='25%'>Amount</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detailsData as $key => $data)
                                                {{-- @php
                                                    echo $amount->fee_category_id;
                                                @endphp --}}
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{$data->school_subject->name}}</td>
                                                    <td>{{$data->full_mark}} </td>
                                                    <td>{{$data->pass_mark}} </td>
                                                    <td>{{$data->subjective_mark}} </td>
                                                    {{-- <td>{{ $amount->amount }}</td> --}}
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
