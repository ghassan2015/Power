@extends('layouts.front')
@section('Content')
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark"> معلومات الخاصة بالحساب الشخصي</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">تغير معلومات الحساب</span>
                </div>
                <form class="form" action="{{route('Customer.Profile.update','test')}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-toolbar">

                        <button type="submit" class="btn btn-success mr-2">تاكيد<span><i
                                    class="fas fa-check-circle"></i></span></button>
                    </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->

            <div class="card-body">
                <!--begin::Heading-->
                <div class="row" style="text-align: right">
                    <div>
                        <h5 class="font-weight-bold mb-6">الحساب الشخصي:</h5>
                    </div>
                </div>
                <!--begin::Form Group-->
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Username</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                            <input class="form-control form-control-lg form-control-solid" name="Name" type="text"
                                   value="{{$user->Name}}"/>
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!--begin::Form Group-->
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">

                            <input type="text" class="form-control form-control-lg form-control-solid"
                                   value="{{$user->email}}" name="email" placeholder="Email"/>
                        </div>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                </div>

            </div>

            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>

@stop
