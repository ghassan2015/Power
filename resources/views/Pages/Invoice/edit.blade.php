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
                        <form class="form" action="{{route('Invoice.update',$Invoices->id)}}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>رقم الفاتورة :</label>
                                        <input type="text" name="Name" class="form-control"
                                               value="{{$Invoices->Name}}"
                                               placeholder="ادخل رقم الفاتورة"/>
                                        @error("Name")
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label>قيمة الفاتورة :</label>
                                        <input type="text" class="form-control"
                                               placeholder="ادخل قيمة الفاتورة" id="Value" name="Value"
                                               value="{{$Invoices->Value}}"/>
                                        @error("Value")
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>طريقة الخصم:</label>
                                        <div class="radio-inline">
                                            <label class="radio radio-solid">
                                                <input type="radio"
                                                       name="yesno" id="noCheck"
                                                       value="1"
                                                ><br>
                                                <span></span>قيمة

                                            </label>
                                            <label class="radio radio-solid">
                                                <input type="radio"
                                                       name="yesno"
                                                       id="yesCheck"
                                                       value="2"
                                                >
                                                <span></span>السنبة المئوية</label>


                                        </div>
                                    </div>

                                    <div class="col-lg-4" id="value_block" style="display:none;">
                                        <label>قيمة تابتة:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   placeholder="Enter your address" onchange="myFunction()"
                                                   id="Discount_value"/>

                                        </div>
                                    </div>
                                    <div class="col-lg-4" id="percent_block" style="display:none;">
                                        <label>نسبة مئوية</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   placeholder="Enter your address" name="Discount" id="Discount"
                                                   onchange="myFunction()"/>

                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-5">
                                        <label>رقم الصندوق <span class="tx-danger">*</span></label>
                                        <select class="form-control" name="Box_id" id="Box_id"
                                                onchange="console.log($(this).val())">
                                            <!--placeholder-->
                                            <option
                                                value="{{ $Invoices->Counter->Box->id  }}"> {{ $Invoices->Counter->Box->Name }}
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
                                    <div class="col-lg-5">
                                        <label>العداد:<span class="tx-danger">*</span></label>
                                        <select class="form-control" name="counter_id" id="counter_id">
                                            <option
                                                value="{{ $Invoices->Counter->id  }}"> {{ $Invoices->Counter->Name }}
                                            </option>
                                        </select>
                                        @error("counter_id")
                                        <span class="text-danger"> </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-lg-5">
                                    <label>قيمة الفاتورة الاجمالية :</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                               placeholder="الفاتورة الاجمالية " id="Total" name="Total"
                                               value="{{$Invoices->Total}}"/>

                                    </div>
                                </div>
                                <!-- end: Example Code-->
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary mr-2">تاكيد</button>
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

@section('js')
    <script>
        $('#Box_id').select2({
            placeholder: "Choose tags...",
        });
        $('#counter_id').select2({
            placeholder: "Choose tags...",
        });
    </script>
    <script>

        $(document).ready(function () {
            $('select[name="Box_id"]').on('change', function () {
                var counter_id = $(this).val();
                if (counter_id) {
                    $.ajax({
                        url: "{{ URL::to('Dashboard/Get_counter') }}/" + counter_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="counter_id"]').empty();
                            $.each(data, function (key, value) {
                                console.log(value);
                                $('select[name="counter_id"]').append('<option value="' +
                                    key + '">' + value + '</option>');
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
            var radioValue = $("input[name='yesno']:checked").val();
            var Value = parseFloat(document.getElementById("Value").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Discount_value = parseFloat(document.getElementById("Discount_value").value);
            if (typeof Value === 'undefined' || !Value) {
                alert('يرجي ادخال مبلغ العمولة ');
            } else if (radioValue == 2) {
                var intResults = Value * (Discount / 100);
                var intResults2 = parseFloat(Value - intResults);
                sumt = parseFloat(intResults2).toFixed(2);
                document.getElementById("Total").value = sumt;
            } else {
                var intResults2 = parseFloat(Value - Discount_value);
                sumt = parseFloat(intResults2).toFixed(2)
                document.getElementById("Total").value = sumt;
            }

        }
    </script>


@endsection
