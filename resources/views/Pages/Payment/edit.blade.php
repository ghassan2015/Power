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
                    <div class="card-body">
                        <!--begin::Form-->
                        <form class="form" action="{{route('Payment.update',$payment->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>رقم الدفعة :</label>
                                        <input type="text" name="Name" class="form-control"
                                               value="{{$payment->Name}}"
                                               placeholder="ادخل  الاسم الدفعة "/>
                                        @error("Name")
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label> المبلغ المدفوع </label>
                                        <input type="text" class="form-control"
                                               value="{{$payment->Paid}}"
                                               placeholder="ادخل قيمة الفاتورة" id="Paid" name="Paid"/>

                                        @error("Paid")
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mg-b-20">
                                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label>اسم الفاتورة <span class="tx-danger">*</span></label>
                                        <select class="form-control" name="Inovie_id" id="Inovie_id"
                                                onchange="myFunction()">
                                            <!--placeholder-->
                                            <option
                                                value="{{$payment->Invoice_id}}">{{$payment->Invoice->Name}}</option>
                                            @foreach ($Invoices as $Invoice)
                                                <option value="{{ $Invoice->id }}"> {{ $Invoice->Name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error("Inovie_id")
                                        <span class="text-danger">{{ $message }} </span>
                                        @enderror
                                    </div>
                                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label>قيمة الفاتورة المستحقة:<span class="tx-danger">*</span></label>
                                        <select class="form-control" name="Invoice_Value" id="Invoice_Value">
                                            <option
                                                value="{{$payment->Invoice_id}}">{{$payment->Invoice->Remainder}}</option>

                                        </select>

                                        @error("Invoice_Value")
                                        <span class="text-danger"> </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mg-b-20" hidden>
                                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label>قيمة الفاتورة الاجمالية :</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   placeholder="الفاتورة الاجمالية " id="Total"
                                                   value="{{$payment->Invoice->Total}}" name="Total"/>

                                        </div>
                                    </div>
                                    <!-- end: Example Code-->
                                </div>
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

@section('js')

    <script>
        $('#Box_id').select2({
            placeholder: "Choose tags...",
        });

        $(document).ready(function () {
            $('select[name="Inovie_id"]').on('change', function () {
                var Invoice_Value = $(this).val();
                console.log("end" + Invoice_Value);
                if (Invoice_Value) {
                    $.ajax({
                        url: "{{ URL::to('Dashboard/Payment/Get_Invoice') }}/" + Invoice_Value,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="Invoice_Value"]').empty();
                            $.each(data, function (key, value) {

                                $('select[name="Invoice_Value"]').append('<option value="' +
                                    value + '">' + value + '</option>').change();

                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });


            $("input[name='yesno']").change(function () {
                var radioValue = $("input[name='yesno']:checked").val();
                if (radioValue == 1) {
                    $('#value_block').show();
                    $("#percent_block").hide();

                } else {
                    $('#percent_block').show();
                    $("#value_block").hide();
                }
            });
            // });
        });

        function myFunction() {

            var Paid = parseFloat(document.getElementById("Paid").value);

            setTimeout(function () {
                var Invoice_Value = parseFloat(document.getElementById("Invoice_Value").value);

                console.log('Invoice_Value' + Invoice_Value);
                if (typeof Paid === 'undefined' || !Paid) {
                    alert('يرجي ادخال مبلغ العمولة ');
                } else {
                    var intResults2 = parseFloat(Invoice_Value - Paid);

                    sumt = parseFloat(intResults2).toFixed(2);
                    document.getElementById("Total").value = sumt;
                }
            }, 500)

        }
    </script>


@endsection
