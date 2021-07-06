@extends('layouts.front')
@section('Content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                            <h3 class="card-label">لوحة تعديل المصروفات التشغيلية </h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Dropdown-->
                            <div class="dropdown dropdown-inline mr-2">

                                <!--begin::Dropdown Menu-->
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                </div>
                                <!--end::Dropdown Menu-->
                            </div>
                            <!--end::Dropdown-->
                            <!--begin::Button-->
                            <a type="button" class="btn btn-primary" href="{{route('Expense.index')}}"><i
                                    class="la la-backward"></i>الرجوع للقائمة السابقة
                            </a>

                            <!--end::Button-->
                        </div>
                    </div>
                    <div class="card-body">                            <!--begin::Form-->
                        <form class="form" action="{{route('Expense.update',$Expense->id)}}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>الاسم :</label>
                                        <input type="text" name="Name" class="form-control"
                                               value="{{$Expense->Name}}" placeholder="ادخل اسم المصروفات"/>
                                        @error("Name")
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label>قيمة المصروفات :</label>
                                        <input type="text" class="form-control"
                                               value="{{$Expense->Price}}"
                                               placeholder="ادخل قيمة المصروفات" id="Value" name="Value"/>
                                        @error("Value")
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <!-- end: Example Code-->
                            </div>
                            <div class="card-footer" style="text-align: left">
                                <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                                                                       aria-hidden="true"></i></span>تاكيد
                                </button>


                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

