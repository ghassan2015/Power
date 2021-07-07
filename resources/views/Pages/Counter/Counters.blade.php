@extends('layouts.front')
@section('Content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                <h3 class="card-label">لوحة عرض العدادات </h3>
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
                <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal"><i class="la la-plus"></i>اضافة عداد جديد
                </button>

                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered data-table">
                <thead>
                <tr>

                    <th width="2%">#</th>
                    <th width="10%">رقم العداد</th>
                    <th width="20%">رقم الصندوق</th>
                    <th width="18%">العنوان</th>

                    <th width="20%"> حالة العداد</th>

                    <th width="20%">العمليات</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>
    <div class="modal fade" id="edit_Counter_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" style="text-align: right">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل مجمع </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" novalidate action="{{route('Counters.update','test')}}" method="post">

                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" class="form-control" id="edit_id">
                        <div class="form-group">
                            <label for="exampleInputEmail1">رقم العداد</label>
                            <input type="text" name="Name" class="form-control" id="Name_counter"
                                   aria-describedby="emailHelp" placeholder="ادخل رقم العداد"
                                   value=""

                                   required>
                            <div class="invalid-feedback">
                                الرجاء ادخل الرقم العداد
                            </div>
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group ">
                            <label for="exampleInputPassword1">مكان العداد</label>
                        </div>
                        <select name="Box_id" class="form-group row kt_select2_2" style="width: 50%"
                                id="Box_id" onclick="console.log($(this).val())">
                            @foreach($Boxs as $box)
                                <option value="{{$box->id}}">{{$box->Name}}</option>
                            @endforeach
                        </select>
                        @error('Box_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group row">
                            <label class="col-1 col-form-label">الحالة</label>
                            <div>
                                            <span class="switch switch-outline switch-icon switch-success">
                                                <label>
                                                    <input type="checkbox" value="1"
                                                           name="is_active"
                                                           id="active"/>
                                                    <span></span>
                                                </label>
                                            </span>
                            </div>
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
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                        id="exampleModalLabel">
                        حذف العداد
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Counters.destroy', 'test') }}" method="post">
                        {{ method_field('Delete') }}
                        @csrf
                        <h4>هل انت متاكدمن عملية الحذف</h4>
                        <input type="hidden">
                        <input id="Delete_id" type="hidden" name="id" class="form-control">
                        <input id="Name_Counter" type="text" name="Name_Delete" class="form-control" disabled>


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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" style="text-align: right">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة عداد جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" novalidate action="{{route('Counters.store')}}" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">رقم العداد</label>
                            <input type="text" name="Name" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp" placeholder="ادخل رقم العداد" required>
                            <div class="invalid-feedback">
                                الرجاء ادخل الرقم العداد
                            </div>
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">مكان العداد</label>
                            <input type="text" name="Location" class="form-control"
                                   id="Location"
                                   placeholder="الرجاء ادخل مكان الصندوق هنا" required>
                            <div class="invalid-feedback">
                                الرجاء ادخل العنوان الخاص العداد
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> مكان التجميع </label>
                        </div>
                        <div class="form-group">

                            <select name="Box_id"
                                    class="custom-select kt_select2_2"
                                    onclick="console.log($(this).val())" style="width: 50%;">
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
                        <div class="form-group row">
                            <label class="col-2 col-form-label">الحالة</label>
                            <div>
															<span
                                                                class="switch switch-outline switch-icon switch-success">
																<label>
																	<input type="checkbox" checked="checked"
                                                                           value="1"
                                                                           name="active"/>
																	<span></span>
																</label>
															</span>
                            </div>
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
@endsection
@section('js')
    <script type="text/javascript">
        Counter_id = '';
        $(document).on('click', '.edit_Counter', function (e) {
            $('#edit_Counter_modal').modal('show');
            var id = $(this).attr('id');
            $('#edit_id').val(id);
            var Name_Counter = $(this).attr('Name_Counter');
            $('#Name_counter').val(Name_Counter);
            var Box_id = $(this).attr('Counter_Box_id');
            var Counter_Box_id = $(this).attr('Counter_Box_id');
            var Counter_Box_Name = $(this).attr('Counter_Box_Name');
            $('#Box_id').append(`<option value="${Counter_Box_id}">
                                       ${Counter_Box_Name}
                                  </option>`);
            var Counter_active = $(this).attr('Counter_active');
            if (Counter_active == 1) {
                $("#active").prop("checked", true);

            } else {

                $("#active").prop("checked", false);

            }

        });


        $(document).on('click', '.delete', function () {
            var Counter_id = $(this).attr('id');
            $('#Delete_id').val(Counter_id);
            var Counter_Name = $(this).attr('Name_Counter');
            $('#Name_Counter').val(Counter_Name);
            $('#confirmModal').modal('show');
        });


        $(function () {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('Counters.index') }}",

                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'Name', name: 'Name'},
                    {data: 'Name_Location', name: 'Name_Location'},
                    {data: 'Location', name: 'Location'},

                    {data: 'Status', name: 'Status'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });


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
