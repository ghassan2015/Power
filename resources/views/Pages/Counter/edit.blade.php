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
                            <h3 class="card-label">لوحة تعديل العدادات الكهربائية </h3>
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
                            <a type="button" class="btn btn-primary" href="{{route('Counters.index')}}"><i
                                    class="la la-backward"></i>الرجوع للقائمة السابقة
                            </a>

                            <!--end::Button-->
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate
                              action="{{route('Counters.update',$counter->id)}}"
                              method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="exampleInputEmail1">رقم العداد</label>
                                <input type="text" name="Name" class="form-control" value="{{$counter->Name}}"
                                       id="exampleInputEmail1" aria-describedby="emailHelp"
                                       placeholder="ادخل رقم الصندوق" required>
                                @error('Name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">مكان العداد</label>
                                <select name="Box_id"
                                        class="custom-select"
                                        onclick="console.log($(this).val())">
                                    <!--placeholder-->
                                    <option
                                        value="{{ $counter->Box_id }}">
                                        {{ $counter->Box->Location}}
                                    </option>
                                    @foreach ( $Boxs as  $Box)
                                        <option
                                            value="{{ $Box->id }}">
                                            {{ $Box->Location }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('Box_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-1 col-form-label">الحالة</label>
                                <div>
                                            <span class="switch switch-outline switch-icon switch-success">
                                                <label>
                                                    <input type="checkbox" value="1"
                                                           @if($counter -> is_active == 1)checked @endif
                                                           name="active"/>
                                                    <span></span>
                                                </label>
                                            </span>
                                </div>
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

@endsection
