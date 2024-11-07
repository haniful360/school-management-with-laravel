@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Main content -->
            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Change Password</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{ route('update.password') }}">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="row mx-5">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <h5>Current Password <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="password" name="old_password" id="old_password"
                                                                class="form-control"">
                                                            @error('old_password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <h5>New Password <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="password" name="password" id="password"
                                                                class="form-control">
                                                            @error('password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <h5>Password Confirmation <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="password" name="password_confirmation"
                                                                id="password_confirmation" class="form-control">
                                                            @error('password_confirmation')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="text-xs-right">
                                                    <input type="submit" class="btn btn-rounded btn-info my-1 ml-3"
                                                        value="update" />
                                                </div>
                                            </div>
                                        </div>

                                </form>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
