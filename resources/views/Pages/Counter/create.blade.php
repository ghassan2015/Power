@extends('layouts.front')
@section('Content')
    <div class="container" style="text-align: right;padding-top:-20%">
        <div class="card">
            <div class="card-header">
                <h5> اضافة عداد جديد</h5>
            </div>
            <div class="card-body">
                <div class="card-title">

                    <a href="{{route('Counters.index')}}" type="button" class="btn btn-primary"
                       style="float: right">
                        الرجوع للقائمة السابقة
                    </a>
                    <br><br>
                </div>
                <div class="container">
                    <div class="card-body" style="text-align:right ">
                        <form class="needs-validation" novalidate
                              action="{{route('Counters.store')}}"
                              method="post">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail1">رقم العداد</label>
                                <input type="text" name="Name" class="form-control"
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
                                    @foreach ( $Boxs as  $Box)
                                        <option
                                            value="{{ $Box->id }}">
                                            {{ $Box->Name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('Box_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-1">
                                        <input type="checkbox" value="1"
                                               name="active"
                                               id="switcheryColor4"
                                               class="switchery" data-color="success">
                                        <label for="switcheryColor4"
                                               class="card-title ml-1">الحالة </label>

                                        @error("active")
                                        <span class="text-danger"> </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer" style="text-align: center">

                                <button type="submit" class="btn btn-primary">تاكيد</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
