@extends('layouts.front')
@section('Content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                <h3 class="card-label">لوحة عرض الصلاحيات </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <!--end::Dropdown-->
                <!--begin::Button-->

                <a class="btn btn-primary" href="{{route('roles.index')}}" id="createNewProduct">
                    الرجوع للقائمة السابقة
                    <i class="fas fa-backward"></i>
                </a>


                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <form class="form" action="{{route('roles.update',$role->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم الصلاحية</label>
                    <input type="text" name="Name" class="form-control" value="{{$role->name}}"
                           id="exampleInputEmail1" aria-describedby="emailHelp"
                           placeholder="ادخل اسم الصلاحية" required>
                    @error('Name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group row">
                    @foreach($permission as $value)
                        <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                            {{ $value->name }}</label>
                        <br/>
                    @endforeach

                </div>
                <!-- /col -->
                <div class="card-footer" style="text-align: left">
                    <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                                                           aria-hidden="true"></i></span>تاكيد
                    </button>

                </div>
            </form>


            <!-- /col -->


            <!-- row closed -->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->



@endsection
