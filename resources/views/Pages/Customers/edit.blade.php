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
                            <h3 class="card-label">لوحة تعديل المشتركين </h3>
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
                            <a type="button" class="btn btn-primary" href="{{route('Customers.index')}}"><i
                                    class="la la-backward"></i>الرجوع للقائمة السابقة
                            </a>

                            <!--end::Button-->
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{route('Customer.update',$Customer->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="form-group row mg-b-20">
                                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label>الاسم:<span class="tx-danger">*</span></label>
                                        <input class="form-control form-control-sm mg-b-20"
                                               data-parsley-class-handler="#lnWrapper"
                                               name="Name" required type="text"
                                               value="{{$Customer->Name}}"
                                        >
                                        @error("Name")
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label>الايميل<span class="tx-danger">*</span></label>
                                        <input class="form-control form-control-sm mg-b-20"
                                               data-parsley-class-handler="#lnWrapper"
                                               name="Email" required type="email" value="{{$Customer->Email}}">
                                        @error("Email")
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mg-b-20">
                                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label>العنوان:<span class="tx-danger">*</span></label>
                                        <input class="form-control form-control-sm mg-b-20"
                                               data-parsley-class-handler="#lnWrapper"
                                               name="Address" required type="text" value="{{$Customer->Address}}">
                                        @error("Address")
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label>المحافظة <span class="tx-danger">*</span></label>
                                        <select class="form-control form-control-sm mg-b-20" name="State_id">
                                            <option
                                                value="{{ $Customer->State_id }}">{{ $Customer->State->Name }}</option>

                                            @foreach ($States as $states)
                                                <option value="{{ $states->id }}">{{ $states->Name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error("State_id")
                                    <span class="text-danger">{{ $message }} </span>
                                    @enderror
                                </div>

                                <div class="form-group row mg-b-20">
                                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label>سعر الكليو الواحد:<span class="tx-danger">*</span></label>
                                        <input class="form-control form-control-sm mg-b-20" type="number" required
                                               name="Price" min="0"
                                               value="{{$Customer->Price}}" step="any"
                                        >
                                        @error("Price")
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label> رقم الجوال<span class="tx-danger">*</span></label>
                                        <input class="form-control form-control-sm mg-b-20" type="text" required
                                               name="Phone"
                                               value="{{$Customer->Phone}}"

                                        >
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
                                            <option
                                                value="{{ $Customer->Counter_id }}">{{ $Customer->Counter->Box->Name }}</option>

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
                                            <option
                                                value="{{ $Customer->Counter_id }}">{{ $Customer->Counter->Name }}</option>

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
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card-->
                    <!--begin::Card-->
                </div>
                <!--end::Card-->
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
