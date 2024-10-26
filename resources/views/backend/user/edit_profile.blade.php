@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Main content -->
            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Manage Profile</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>User Name <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="name" id="name"
                                                                value="{{ $editData->name }}" class="form-control" required
                                                                data-validation-required-message="This field is required">
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <h5>User Email <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="email" name="email" id="email"
                                                                    value="{{ $editData->email }}" class="form-control"
                                                                    required
                                                                    data-validation-required-message="This field is required">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>User Mobile<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="number" name="mobile" id="mobile"
                                                                value="{{ $editData->mobile }}" class="form-control"
                                                                required
                                                                data-validation-required-message="This field is required">
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <h5>User Address <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="address" id="address"
                                                                    value="{{ $editData->address }}" class="form-control"
                                                                    required
                                                                    data-validation-required-message="This field is required">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <h5>User Role <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select name="gender" id="gender" required
                                                                    class="form-control">
                                                                    <option value="">Select Your Role</option>
                                                                    <option value="Male"
                                                                        {{ $editData->gender == 'Male' ? 'selected' : '' }}>
                                                                        Male</option>
                                                                    <option value="Female"
                                                                        {{ $editData->gender == 'Female' ? 'selected' : '' }}>
                                                                        Female</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <h5>Profile Photo <span class="text-danger">*</span></h5>
                                                            <input type="file" class="form-control"
                                                                id="product_thumbnail" name="image"
                                                                onchange="document.getElementById('profile_image').src = window.URL.createObjectURL(this.files[0])">

                                                        </div>
                                                        <div>
                                                            <img id="profile_image" alt="your image" width="100"
                                                                height="100" src="{{ !empty(Auth::user()->image) ? Storage::url(Auth::user()->image) : url('upload/no_image.jpg') }}"
                                                                style="width: 100px;height: 100px;border: 1px solid #000000"
                                                                alt="User Avatar">
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
