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
                        <form class="form" action="{{route('Invoice.store')}}" method="post">
                            @csrf
                            <div class="card-body" data-repeater-list="List_Invoice">
                                @foreach($Inovices as $inovice)
                                    <div class="form-group row">

                                        <input value="{{$inovice->Counter->Customer->id}}" type="hidden"
                                               name="Customer_id[]">
                                        <div class="col-lg-4">
                                            <label>اسم الشخص :</label>
                                            <input type="text" name="Name[]" class="form-control"
                                                   value="{{$inovice->Counter->Customer->Name}}"
                                                   placeholder="ادخل رقم الفاتورة"/>
                                            @error("Name")
                                            <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>


                                        <input type="hidden" name="Price[]" class="form-control Price"
                                               value="{{$inovice->Counter->Customer->Price}}"
                                               id="Price">
                                        <input type="hidden" name="previous_reading[]"
                                               class="form-control previous_reading"

                                               value="{{is_null($inovice->previous_reading)?0:$inovice->previous_reading}}"

                                               id="previous_reading">
                                        <div class="col-lg-4 ">
                                            <label>قيمة العدادالحالية :</label>
                                            <input type="text" class="form-control current"
                                                   placeholder="ادخل قيمة الفاتورة" id="current_reading"

                                                   name="current_reading[]"/>
                                            @error("current_reading")
                                            <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4">
                                            <label>قيمة الفاتورة :</label>
                                            <input type="text" class="form-control Total"
                                                   placeholder="ادخل قيمة الفاتورة" id="Total" name="Total[]"/>
                                            @error("Total")
                                            <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                            @endforeach
                            <!-- end: Example Code-->
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-6">
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
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {

            $('.current').on('change', function () {

                var current_reading = $(this).val();

                var previous_reading = $(this).parent().parent().find('.previous_reading').val();
                var Price = $(this).parent().parent().find('.Price').val();

                var result = Number(current_reading - previous_reading);
                var Total = Number(Price * result);
                console.log(Total);
                var Value = $(this).parent().parent().find('.Total').val(Total);


// Does some stuff and logs the event to the console
                // var current_reading = this.value;
                // $(this).find("span").css({"color": "red", "border": "2px solid red"});

                // var previous_reading = $(".previous_reading").val();
                // var Price = $(".Price").val();
                // var intResults = parseFloat(current_reading - previous_reading);
                // // console.log(intResults);
                // var Total = parseFloat(intResults * Price);
                // var value = $(current_reading).next('.Total');
                // $('.Total').val(Total);
                // console.log(value);

            });

        });

        function myFunction() {
            var current_reading = $(".current").val();

            var previous_reading = $(".previous_reading").val();

            // var previous_reading = parseFloat(document.getElementById("previous_reading").value);

            // var Price = parseFloat(document.getElementById("Price").value);
            var Price = $(".Price").val();


            var intResults = parseFloat(current_reading - previous_reading);
            var Total = parseFloat(intResults * Price);

            document.getElementById("Total").value = Total;
            $(".current").next();
            $(".current").each(function () {
                // for each "from-date" input
                console.log($(this));
                document.getElementById("Total").value = Total;

                // find the according "to-date" input
                console.log('tesst' + $(this).parent().next().find(".current"));
            });

        }
    </script>


@endsection
