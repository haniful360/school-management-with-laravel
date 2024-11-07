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
                                <h3 class="box-title">Assign Subject List</h3>
                                <a href="{{ route('assign-subject.create') }}" class="btn btn-success btn-rounded">Add Assign
                                    Subject</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width='5%'>SL</th>
                                                <th>Class Name</th>
                                                <th width='25%'>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($studentAssignSub as $key => $assign)
                                                {{-- @php
                                                    echo $amount->fee_category_id;
                                                @endphp --}}
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $assign->student_class->name }}</td>
                                                    {{-- <td>{{ $amount->fee_category->name}}</td> --}}
                                                    <td>
                                                        <a href="{{ route('assign-subject.edit', $assign->class_id) }}"
                                                            class="btn btn-info btn-rounded">Edit</a>
                                                        <a href="{{route('assign-subject.show',$assign->class_id)}}" class="btn btn-primary btn-rounded">Details</a>
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
