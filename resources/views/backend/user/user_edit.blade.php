@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Main content -->
            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Update User</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{ route('users.update', $editData->id) }}">
                                    @csrf
                                    @method('post')
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <h5>User Role <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select name="role" id="usertype" class="form-control">
                                                                    <option value="">Select Your Role</option>
                                                                    <option value="Admin"
                                                                        {{ $editData->role == 'Admin' ? 'selected' : '' }}>
                                                                        Admin</option>
                                                                    <option value="Operator"
                                                                        {{ $editData->role == 'Operator' ? 'selected' : '' }}>
                                                                        Operator</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>User Name <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="name" id="name"
                                                                value="{{ $editData->name }}" class="form-control">
                                                        </div>
                                                        @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <h5>User Email <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="email" name="email" id="email"
                                                                    value="{{ $editData->email }}" class="form-control">
                                                                @error('email')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

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
