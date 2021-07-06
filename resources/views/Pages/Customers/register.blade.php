@extends('layouts.front')
@section('Content')
    <div class="container" style="text-align: right;padding-top:-20%">
        <div class="card">
            <div class="card-header">
                <h5> اضافة فاتورة جديدة</h5>
            </div>
            <div class="card-body">
                <div class="card-title">

                    <a href="{{route('Invoice.index')}}" type="button" class="btn btn-primary"
                       style="float: right">
                        الرجوع للقائمة السابقة
                    </a>
                    <br><br>
                </div>
                <div class="container">
                    <div class="card-body" style="text-align:right ">
                        <!--begin::Form-->
                        <form class="form" action="{{route('Customer.create')}}" method="post">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row mg-b-20">
                                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label>الاسم:<span class="tx-danger">*</span></label>
                                        <input class="form-control form-control-sm mg-b-20"
                                               data-parsley-class-handler="#lnWrapper"
                                               name="Name" required type="text">
                                        @error("Name")
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label>الايميل<span class="tx-danger">*</span></label>
                                        <input class="form-control form-control-sm mg-b-20"
                                               data-parsley-class-handler="#lnWrapper"
                                               name="Email" required type="email">
                                        @error("Email")
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mg-b-20">
                                    <div class="form-control col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label>كلمة المرور: <span class="tx-danger">*</span></label>
                                        <input class="form-control form-control-sm mg-b-20"
                                               data-parsley-class-handler="#lnWrapper"
                                               name="password" required="" type="password">
                                        @error("password")
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label> تاكيد كلمة المرور: <span class="tx-danger">*</span></label>
                                        <input class="form-control form-control-sm mg-b-20"
                                               data-parsley-class-handler="#lnWrapper"
                                               name="password_confirmation" required="" type="password">

                                    </div>
                                </div>

                                <div class="form-control col-md-6 mg-t-20 mg-md-t-0">
                                    <label>العنوان:<span class="tx-danger">*</span></label>
                                    <input class="form-control form-control-sm mg-b-20"
                                           data-parsley-class-handler="#lnWrapper"
                                           name="Address" required type="text">
                                    @error("Address")
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror


                                    <div class="form-control col-md-6 mg-t-20 mg-md-t-0">

                                        <select name="State_id" class="form-group row kt_select2_2"
                                                style="width: 30%"
                                                onclick="console.log($(this).val())">
                                            <!--placeholder-->
                                            {{--                                    <option style="float: right">--}}
                                            {{--                                        الرجاء ادخل المحافظة--}}
                                            {{--                                    </option>--}}
                                            @foreach ( $States as  $State)
                                                <option
                                                    value="{{ $State->id }}">
                                                    {{ $State->Name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('State_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group row mg-b-20">
                                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                            <label>سعر الكليو الواحد:<span class="tx-danger">*</span></label>
                                            <input class="form-control form-control-sm mg-b-20" type="number" required
                                                   name="Price" min="0"
                                                   value="0" step="any">
                                            @error("Price")
                                            <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                            <label> رقم الجوال<span class="tx-danger">*</span></label>
                                            <input class="form-control form-control-sm mg-b-20" type="number" required
                                                   name="Phone">
                                            @error("Phone")
                                            <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mg-b-20">
                                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                            <label>رقم الصندوق <span class="tx-danger">*</span></label>
                                            <select class="form-control form-control-sm mg-b-20" name="Box_id"
                                                    onchange="console.log($(this).val())">
                                                <!--placeholder-->
                                                <option value="" selected
                                                        disabled> رقم الصندوق
                                                </option>
                                                @foreach ($Boxes as $Box)
                                                    <option value="{{ $Box->id }}"> {{ $Box->Name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error("Box_id")
                                            <span class="text-danger">{{ $message }} </span>
                                            @enderror
                                        </div>
                                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                            <label>العداد:<span class="tx-danger">*</span></label>
                                            <select class="form-control form-control-sm mg-b-20" name="Counter_id">

                                            </select>
                                            @error("Counter_id")
                                            <span class="text-danger"> </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-1 col-form-label">الحالة</label>
                                        <div>
															<span
                                                                class="switch switch-outline switch-icon switch-success">
																<label>
																	<input type="checkbox" checked="checked"
                                                                           value="1"
                                                                           name="Status"/>
																	<span></span>
																</label>
															</span>
                                        </div>
                                    </div>


                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Submit</button>

                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card-->
                    <!--begin::Card-->
                </div>
                <!--end::Card-->
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('select[name="Box_id"]').on('change', function () {
                var Box_id = $(this).val();
                console.log(Box_id);
                if (Box_id) {
                    $.ajax({
                        url: "{{ URL::to('Dashboard/Get_counter') }}/" + Box_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {

                            $('select[name="Counter_id"]').empty();
                            $('select[name="Counter_id"]').append('<option selected disabled >اختر العداد .</option>');
                            $.each(data, function (key, value) {
                                $('select[name="Counter_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection
