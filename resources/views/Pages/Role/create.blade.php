@extends('layouts.front')
@section('Content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                <h3 class="card-label">لوحة اضافة الصلاحيات </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline mr-2">
                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="la la-download"></i>Export
                    </button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <ul class="nav flex-column nav-hover">
                            <li class="nav-header font-weight-bolder text-uppercase text-primary pb-2">Choose an
                                option:
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon la la-print"></i>
                                    <span class="nav-text">Print</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon la la-copy"></i>
                                    <span class="nav-text">Copy</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon la la-file-excel-o"></i>
                                    <span class="nav-text">Excel</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon la la-file-text-o"></i>
                                    <span class="nav-text">CSV</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon la la-file-pdf-o"></i>
                                    <span class="nav-text">PDF</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--end::Dropdown Menu-->
                </div>
                <!--end::Dropdown-->
                <!--begin::Button-->
                <a type="button" href="{{route('roles.create')}}" class="btn btn-primary"><i class="la la-plus"></i>اضافة
                    فاتورة جديد
                </a>

                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <form class="form" action="{{route('roles.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم الصلاحية</label>
                    <input type="text" name="Name" class="form-control"
                           id="exampleInputEmail1" aria-describedby="emailHelp"
                           placeholder="ادخل اسم الصلاحية" required>
                    @error('Name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group row">
                    @foreach($permission as $permission)
                        <label class="col-2 col-form-label">{{$permission->name}}</label>
                        <div>
                                            <span class="switch switch-outline switch-icon switch-success">
                                                <label>
                                                    <input type="checkbox"
                                                           name="permission[]" value="{{$permission->id}}"/>
                                                    <span></span>
                                                </label>
                                            </span>
                        </div>
                    @endforeach

                </div>
                <!-- /col -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <button type="submit"
                                    class="btn btn-primary mr-2">Save
                            </button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </div>

            </form>


            <!-- /col -->


            <!-- row closed -->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->


@endsection
