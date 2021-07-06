@extends('layouts.front')
@section('Content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div style="float: right;">
                    <h4>اضافة مشترك جديد</h4>
                </div>
                <div style="float: left;">
                    <a href="{{route('Customers.index')}}" type="button" class="btn btn-primary">
                        الرجوع للقائمة السابقة
                        <i class="fas fa-backward"></i>
                    </a>
                </div>

            </div>
            <div class="card-body" style="text-align:right ">
                <form class="form" action="{{route('Customer.create')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>الاسم :</label>
                                <input type="text" name="Name" class="form-control"
                                       placeholder="ادخل اسم المشترك"/>
                                @error("Name")
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>الايميل:</label>
                                <input type="email" class="form-control"
                                       placeholder="ادخل ايميل المشترك" id="Email" name="Email"/>
                                @error("Email")
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>رقم الهاتف :</label>
                                <input type="text" name="Phone" class="form-control"
                                       placeholder="ادخل رقم هاتف المشترك"/>
                                @error("Phone")
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <input type="hidden" name="user_id" class="form-control"
                                   value="{{auth()->id()}}">
                            <div class="col-lg-6">
                                <label>سعر الكيلوالواحد:</label>
                                <input type="text" class="form-control"
                                       placeholder="ادخل سعر كيلو الواحدلمشترك" id="Price" name="Price"/>
                                @error("Price")
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>كلمة المرور :</label>
                                <input type="password" name="password" class="form-control"
                                       placeholder="ادخل كلمة المرور الخاصة بالمشترك  "/>
                                @error("password")
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>تاكيد كلمة المرور:</label>
                                <input type="password" class="form-control"
                                       placeholder="تاكيد كلمة المرور الخاص بالمشترك"
                                       id="password_confirmation" name="password_confirmation"/>

                            </div>
                        </div>

                        <div class="form-group row mg-b-20">
                            <div class="col-lg-6">
                                <label>العنوان</label>
                                <input type="text" class="form-control"
                                       placeholder="الرجاء ادخال العنوان"
                                       id="Address" name="Address"/>
                            </div>
                            <div class="col-lg-6">
                                <label>المحافضة:</label>
                                <select class="form-control kt_select2_2" name="State_id" id="State_id"
                                        onchange="myFunction()">
                                    <!--placeholder-->
                                    @foreach ($States as $state)
                                        <option value="{{ $state->id }}"> {{ $state->Name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mg-b-20">
                            <div class="col-lg-6">
                                <label>مكان المجمع</label>
                                <select class="form-control kt_select2_2" name="Box_id" id="Box_id">
                                    <!--placeholder-->
                                    @foreach ( $Boxes as  $Box)
                                        <option value="{{$Box->id }}"> {{  $Box->Name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label>رقم العداد:</label>
                                <select class="form-control kt_select2_2" name="Counter_id" id="Counter_id"
                                        onchange="myFunction()">
                                    <!--placeholder-->

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-1">الحالة</label>
                            <div>
															<span
                                                                class="switch switch-outline switch-icon switch-success">
																<label>
																	<input type="checkbox" checked="checked"
                                                                           name="Status"
                                                                           value="1"
                                                                    />
																	<span></span>
																</label>
															</span>
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



@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('select[name="Box_id"]').append('<option selected disabled >اختر المجمع .</option>');

            $('select[name="Box_id"]').on('change', function () {

                var Box_id = $(this).val();
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
