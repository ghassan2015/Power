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

    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">Confirmation</h2>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- add_modal_Grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" style="text-align: right">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة مستخدم جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate action="{{route('Expense.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم المصروفات</label>
                            <input type="text" name="Name" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp" placeholder="ادخل اسم المصروفات التشغيلية" required>
                            <div class="invalid-feedback">
                            </div>
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">قيمةالمصروفات</label>
                            <input type="text" name="Value" class="form-control" id="exampleInputPassword1"
                                   placeholder="الرجاءادخل قيمة المصروفات" required>
                            <div class="invalid-feedback">
                                ادخل قيمة المصروفات
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">تاكيد</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        box_id = '';
        $(document).on('click', '.delete', function () {
            box_id = $(this).attr('id');
            console.log(box_id);
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function () {
            $.ajax({
                url: "/Dashboard/Expense/destroy/" + box_id,
                beforeSend: function () {
                    $('#ok_button').text('Deleting...');
                }
                ,
                success: function (data) {
                    setTimeout(function () {
                        $('#confirmModal').modal('hide');
                        $('.data-table').DataTable().ajax.reload();
                    }, 2000);
                }
            })
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