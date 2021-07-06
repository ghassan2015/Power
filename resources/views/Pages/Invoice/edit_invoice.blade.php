@extends('layouts.front')
@section('Content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                <h3 class="card-label">لوحة تسجيل الفواتير المشتركين </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline mr-2">
                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="la la-download"></i>Export
                    </button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <ul class="nav flex-column nav-hover">
                            <li class="nav-header font-weight-bolder text-uppercase text-primary pb-2">Choose an
                                option:
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon la la-print"></i>
                                    <span class="nav-text">Print</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon la la-copy"></i>
                                    <span class="nav-text">Copy</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon la la-file-excel-o"></i>
                                    <span class="nav-text">Excel</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon la la-file-text-o"></i>
                                    <span class="nav-text">CSV</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon la la-file-pdf-o"></i>
                                    <span class="nav-text">PDF</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--end::Dropdown Menu-->
                </div>
                <!--end::Dropdown-->
                <!--begin::Button-->

                <a type="submit" class="btn btn-primary" href="{{route('Invoice.index')}}"
                >الرجوع للقائمة الفواتير
                    <span>
                    <i class="fas fa-backward"></i>
                </span>
                </a>

                <!--end::Button-->
            </div>
        </div>

        <div class="card-body">

            <div class="container">
                <div class="card-body" style="text-align:right ">

                    <!--begin::Form-->
                    <form class="form" action="{{route('Invoice.update',$inovice->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-body" data-repeater-list="List_Invoice">
                            <div class="form-group row">

                                <input value="{{$inovice->Customer->id}}" type="hidden"
                                       name="Customer_id">
                                <div class="col-lg-4">
                                    <label>اسم الشخص :</label>
                                    <input type="text" name="Name" class="form-control"
                                           value="{{$inovice->Customer->Name}}"
                                           placeholder="ادخل رقم الفاتورة"/>
                                    @error("Name")
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>


                                <input type="hidden" name="Price" class="form-control Price"
                                       value="{{$inovice->Customer->Price}}"
                                       id="Price">
                                <input type="hidden" name="previous_reading"
                                       class="form-control previous_reading"

                                       value="{{is_null($inovice->previous_reading)?0:$inovice->previous_reading}}"

                                       id="previous_reading">
                                <div class="col-lg-4 ">
                                    <label>قيمة العدادالحالية :</label>
                                    <input type="text" class="form-control current"
                                           placeholder="ادخل قيمة الفاتورة" id="current_reading"
                                           value="{{$inovice->current_reading}}"
                                           name="current_reading"/>
                                    @error("current_reading")
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>قيمة الفاتورة :</label>
                                    <input type="text" class="form-control Total"
                                           value="{{$inovice->Total}}"
                                           placeholder="ادخل قيمة الفاتورة" id="Total" name="Total"/>
                                    @error("Total")
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
