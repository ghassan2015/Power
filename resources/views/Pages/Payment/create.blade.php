@extends('layouts.front')
@section('Content')
    @extends('layouts.front')
@section('Content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div style="float: right;">
                    <h4>اضافة دفعة جديدة</h4>
                </div>
                <div style="float: left;">
                    <a href="{{route('Payment.index')}}" type="button" class="btn btn-primary">
                        الرجوع للقائمة السابقة
                    </a>
                </div>

            </div>
            <div class="card-body">
                <form class="form" action="{{route('Payment.store')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>رقم الدفعة :</label>
                                <input type="text" name="Name" class="form-control"
                                       placeholder="ادخل  الاسم الدفعة "/>
                                @error("Name")
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label> المبلغ المدفوع </label>
                                <input type="text" class="form-control"
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
                                           placeholder="الفاتورة الاجمالية " id="Total" name="Total"/>

                                </div>
                            </div>
                            <!-- end: Example Code-->
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row" style="text-align: center">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary mr-2">تاكيد</button>
                                <button type="reset" class="btn btn-secondary">الغاء</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
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


            $('#Inovie_id').select2({
                placeholder: "Select a state"
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
