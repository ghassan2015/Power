@extends('layouts.front')
@section('Content')
    <div class="container">
        {{--        <div class="card-title">--}}

        {{--            <button type="button" class="btn btn-primary" data-toggle="modal"--}}
        {{--                    data-target="#exampleModal" style="float: right">--}}
        {{--                اضافة صندوق جديد--}}
        {{--            </button>--}}
        {{--        </div>--}}
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                    <h3 class="card-label">لوحة عرض مجمعات </h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline mr-2">

                        <!--begin::Dropdown Menu-->

                        <!--end::Dropdown Menu-->
                    </div>

                    <!--end::Dropdown-->
                    <!--begin::Button-->
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#exampleModal"><i class="la la-plus"></i>اضافة مجمع جديد
                    </button>

                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered data-table" style="text-align: right">
                    <thead>
                    <tr>
                        <th width="2%">#</th>
                        <th width="30%">رقم مجمع العدادات الكهربائية</th>
                        <th width="30%">المكان</th>

                        <th width="10%"> المحافظة</th>

                        <th width="28%">العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true" style="text-align: right">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافة مجمع جديد</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="needs-validation" novalidate action="{{route('Boxs.store')}}" method="post">

                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">رقم الصندوق</label>
                                <input type="text" name="Name" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="ادخل رقم الصندوق" required>
                                <div class="invalid-feedback">
                                    الرجاء ادخل الرقم الصندوق
                                </div>
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">مكان الصندوق</label>
                                <input type="text" name="Location" class="form-control" id="exampleInputPassword1"
                                       placeholder="الرجاء ادخل مكان الصندوق هنا" required>
                                <div class="invalid-feedback">
                                    الرجاء ادخل العنوان الخاص بالصندوق
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputPassword1">مكان العداد</label>
                            </div>
                            <div class="form-group row">

                                <select name="State_id" class="form-group row kt_select2_2"
                                        style="width: 30%"
                                        onclick="console.log($(this).val())">
                                    <!--placeholder-->
                                    {{--                                    <option style="float: right">--}}
                                    {{--                                        الرجاء ادخل المحافظة--}}
                                    {{--                                    </option>--}}
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

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                                                                   aria-hidden="true"></i></span>تاكيد
                            </button>

                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-window-close" aria-hidden="true"></i>
                                اغلاق
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="modal fade" id="edit_Box_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true" style="text-align: right">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل مجمع </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="needs-validation" novalidate action="{{route('Boxs.update')}}" method="post">

                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" class="form-control" id="id"
                            >
                            <div class="form-group">
                                <label for="exampleInputEmail1">رقم الصندوق</label>
                                <input type="text" name="Name" class="form-control" id="Name_box"
                                       aria-describedby="emailHelp" placeholder="ادخل رقم الصندوق"
                                       value=""

                                       required>
                                <div class="invalid-feedback">
                                    الرجاء ادخل الرقم الصندوق
                                </div>
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">مكان الصندوق</label>
                                <input type="text" name="Location" class="form-control" id="Location_box"
                                       placeholder="الرجاء ادخل مكان الصندوق هنا" required>
                                <div class="invalid-feedback">
                                    الرجاء ادخل العنوان الخاص بالصندوق
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="exampleInputPassword1">مكان العداد</label>
                            </div>
                            <select name="State_id" class="form-group row kt_select2_2" style="width: 50%"
                                    id="State_id" onclick="console.log($(this).val())">

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

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                                                                   aria-hidden="true"></i></span>تاكيد
                            </button>

                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-window-close" aria-hidden="true"></i>
                                اغلاق
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div id="confirmModal" class="modal fade" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                            id="exampleModalLabel">
                            حذف المجمع
                        </h5>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('Box.destroy', 'test') }}" method="post">
                            {{ method_field('Delete') }}
                            @csrf
                            <h4>هل انت متاكدمن عملية الحذف</h4>
                            <input type="hidden">
                            <input id="Delete_id" type="hidden" name="id" class="form-control">
                            <input id="Name_Delete" type="text" name="Name_Delete" class="form-control" disabled>


                            <div class="modal-footer">
                                <button type="submit" name="ok_button" id="ok_button" class="btn btn-danger"><span><i
                                            class="fa fa-paper-plane"
                                            aria-hidden="true"></i></span>تاكيد
                                </button>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                        class="fa fa-window-close" aria-hidden="true">الغاء</i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <@stop
@section('js')
    <script type="text/javascript">
        $(document).on('click', '.edit_Box', function (e) {
            $('#edit_Box_modal').modal('show');
            var Name_Box = $(this).attr('Name_Box');
            $('#Name_box').val(Name_Box);
            var Location_Box = $(this).attr('Location_Box');
            $('#Location_box').val(Location_Box);
            var State_Box = $(this).attr('State_box');
            var State_id = $(this).attr('State_id');

            $('#State_id').append(`<option value="${State_id}">
                                       ${State_Box}
                                  </option>`);
            var Box_id = $(this).attr('id');
            $('#id').val(Box_id);
        });

        $(document).on('click', '.delete', function (e) {
            var $id = $(this).attr('id');
            var Name_Box = $(this).attr('Name_Box');
            $('#Delete_id').val($id);

            $('#Name_Delete').val(Name_Box);

            $('#confirmModal').modal('show');
        });

        $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('Boxs.index') }}",

            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'Name', name: 'Name'},
                {data: 'Location', name: 'Location'},
                {data: 'State', name: 'State'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]
        });
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection
