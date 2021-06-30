@extends('layouts.front')
@section('Content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div style="float: right;">
                    <h4>اضافة دفعة جديدة</h4>
                </div>
                <div style="float: left;">
                    <a href="{{route('users.index')}}" type="button" class="btn btn-primary">
                        الرجوع للقائمة السابقة
                    </a>
                </div>

            </div>
            <div class="card-body" style="text-align:right ">
                <form class="form" action="{{route('users.store')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>الاسم :</label>
                                <input type="text" name="name" class="form-control"
                                       placeholder="ادخل اسم الموظف"/>
                                @error("name")
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>الايميل:</label>
                                <input type="email" class="form-control"
                                       placeholder="ادخل ايميل الموظف" id="email" name="email"/>
                                @error("email")
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>كلمة المرور :</label>
                                <input type="password" name="password" class="form-control"
                                       placeholder="ادخل كلمة المرور الخاصة بالموظف  "/>
                                @error("Name")
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>تاكيد كلمة المرور:</label>
                                <input type="password" class="form-control"
                                       placeholder="تاكيد كلمة المرور الخاص بالموظف"
                                       id="password_confirmation" name="password_confirmation"/>
                                @error("password_confirmation")
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mg-b-20">
                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label> نوع المستخدم <span class="tx-danger">*</span></label>
                                {!! Form::select('roles_name[]', $roles,[], array('class' => 'form-control','multiple')) !!}

                                @error("roles_name")
                                <span class="text-danger">{{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-1">Success</label>
                            <div>
															<span
                                                                class="switch switch-outline switch-icon switch-success">
																<label>
																	<input type="checkbox" checked="checked"
                                                                           name="Status"/>
																	<span></span>
																</label>
															</span>
                            </div>
                        </div>
                        <!-- end: Example Code-->
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary mr-2">Save</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    </div>
    </div>


@endsection

