@extends('layouts.front')
@section('Content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                <h3 class="card-label">لوحة عرض المصروفات التشغيلية </h3>
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
                        data-target="#exampleModal"><i class="la la-plus"></i>اضافة مصروفات تشغيلية جديد
                </button>

                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered data-table" style="text-align: right">
                <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="30%">الاسم</th>
                    <th width="20%">قيمة المصروفات</th>
                    <th width="30%">العمليات</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>



    <!-- add_modal_Grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" style="text-align: right">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة مصاريف تشغيلية جديدة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" novalidate action="{{route('Expense.store')}}" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInputPassword1">اسم المصاريف</label>
                            <input type="text" name="Name" class="form-control"
                                   id="Name"
                                   placeholder="الرجاء ادخل مكان الصندوق هنا" required>
                            <div class="invalid-feedback">
                                الرجاء ادخال الاسم الخاص بالمصاريف
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> نوع المصاريف </label>
                        </div>
                        <div class="form-group">

                            <select name="Option_id" class="custom-select kt_select2_2"
                                    onclick="console.log($(this).val())" style="width: 100%">
                                <!--placeholder-->
                                @foreach ( $Options as  $option)
                                    <option
                                        value="{{ $option->id }}">
                                        {{ $option->Name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('Box_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">قيمة المصاريف</label>
                            <input type="text" name="Value" class="form-control" id="Value"
                                   aria-describedby="emailHelp" placeholder="ادخل رقم العداد" required>
                            <div class="invalid-feedback">
                                الرجاء ادخل قيمة المصاريف
                            </div>
                            <small id="emailHelp" class="form-text text-muted"></small>
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
    <div class="modal fade" id="edit_Expense_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" style="text-align: right">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة مصاريف تشغيلية جديدة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" novalidate action="{{route('Expense.update','test')}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id" class="form-control"
                               id="Expense_id"
                               placeholder="الرجاء ادخل مكان الصندوق هنا" required>
                        <div class="form-group">
                            <label for="exampleInputPassword1">اسم المصاريف</label>
                            <input type="text" name="Name" class="form-control"
                                   id="Name_Expense"
                                   placeholder="الرجاء ادخل مكان الصندوق هنا" required>
                            <div class="invalid-feedback">
                                الرجاء ادخال الاسم الخاص بالمصاريف
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> نوع المصاريف </label>
                        </div>
                        <div class="form-group">

                            <select name="Option_id" class="custom-select kt_select2_2"
                                    onclick="console.log($(this).val())" style="width: 100%">
                                <!--placeholder-->
                                @foreach ( $Options as  $option)
                                    <option
                                        value="{{ $option->id }}">
                                        {{ $option->Name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('Box_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">قيمة المصاريف</label>
                            <input type="text" name="Value" class="form-control" id="Price"
                                   aria-describedby="emailHelp" placeholder="ادخل رقم العداد" required>
                            <div class="invalid-feedback">
                                الرجاء ادخل قيمة المصاريف
                            </div>
                            <small id="emailHelp" class="form-text text-muted"></small>
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
                    <form action="{{ route('Expense.destroy', 'test') }}" method="post">
                        {{ method_field('Delete') }}
                        @csrf
                        <h4>هل انت متاكدمن عملية الحذف</h4>
                        <input type="hidden">
                        <input id="Delete_id" type="hidden" name="id" class="form-control">
                        <input id="Name_Expense_delete" type="text" name="Name_Delete" class="form-control" disabled>


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
@endsection
@section('js')
    <script type="text/javascript">
        box_id = '';

        $(document).on('click', '.delete', function () {
            Expense_id = $(this).attr('id');
            Name_Expense = $(this).attr('Name_Expense');
            $('#Delete_id').val(Expense_id);
            $('#Name_Expense_delete').val(Name_Expense);

            $('#confirmModal').modal('show');
        });
        $(document).on('click', '.edit_Expense', function (e) {
            $('#edit_Expense_modal').modal('show');
            var Expense_id = $(this).attr('id');
            $('#Expense_id').val(Expense_id);

            var Name = $(this).attr('Name_Expense');
            $('#Name_Expense').val(Name);
            var Price = $(this).attr('Price');
            $('#Price').val(Price);
            var Option_Name = $(this).attr('Option_Name');
            var Option_id = $(this).attr('Option_id');
            console.log(Option_id);


            $('#Option_id').append(`<option value="${Option_id}">
                                       ${Option_Name}
                                  </option>`);
            var Box_id = $(this).attr('id');
            $('#id').val(Box_id);
        });


        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('Expense.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'Name', name: 'Name'},
                    {data: 'Price', name: 'Price'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

        });
        // Example starter JavaScript for disabling form submissions if there are invalid fields
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
