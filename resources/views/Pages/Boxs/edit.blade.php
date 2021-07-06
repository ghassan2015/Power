@extends('layouts.front')
@section('Style')
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endsection
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
                            <h3 class="card-label">لوحة تعديل مجمعات </h3>
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
                            <a type="button" class="btn btn-primary" href="{{route('Boxs.index')}}"><i
                                    class="la la-backward"></i>الرجوع للقائمة السابقة
                            </a>

                            <!--end::Button-->
                        </div>
                    </div>
                    <div class="card-body" style="text-align:right ">
                        <form class="needs-validation" novalidate action="{{route('Boxs.update',$box->id)}}"
                              method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="exampleInputEmail1">رقم الصندوق</label>
                                <input type="text" name="Name" class="form-control" value="{{$box->Name}}"
                                       id="exampleInputEmail1" aria-describedby="emailHelp"
                                       placeholder="ادخل رقم الصندوق" required>
                                @error('Name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">مكان الصندوق</label>
                                <input type="text" name="Location" value="{{$box->Location}}"
                                       class="form-control" id="exampleInputPassword1"
                                       placeholder="الرجاء ادخل مكان الصندوق هنا" required>
                                @error('Location')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">مكان العداد</label>
                                <select name="State_id"
                                        id="kt_select2_2"
                                        class="custom-select"
                                        onclick="console.log($(this).val())">
                                    <!--placeholder-->
                                    <option style="text-align: right"
                                            value="{{ $box->State_id }}">
                                        {{ $box->State->Name}}
                                    </option>
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
                            <div class="card-footer" style="text-align: left">
                                <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                                                                       aria-hidden="true"></i></span>تاكيد
                                </button>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {

            $('#kt_select2_2').select2({
                placeholder: "Select a state"
            });
        });
    </script>
@endsection
