@extends('layouts.front')
@section('Content')
    <div class="container">


        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                    <h3 class="card-label">لوحة عرض انواع المصاريف </h3>
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
                            data-target="#exampleModal"><i class="la la-plus"></i>اضافة نوع المصاريف
                    </button>

                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>

                        <th width="2%">#</th>
                        <th width="10%">الاسم</th>

                        <th width="20%">العمليات</th>
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
                    <form class="needs-validation" novalidate action="{{route('Options.store')}}" method="post">

                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">الاسم</label>
                                <input type="text" name="Name" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp"
                                       placeholder=" ادخل نوع المصاريف "
                                       required>
                                <div class="invalid-feedback">
                                    الرجاء ادخل نوع المصاريف
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


        <div class="modal fade" id="edit_Options_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true" style="text-align: right">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل مجمع </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="needs-validation" novalidate action="{{route('Options.update','test')}}" method="post">

                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" class="form-control" id="Option_id"
                            >
                            <div class="form-group">
                                <label for="exampleInputEmail1">رقم الصندوق</label>
                                <input type="text" name="Name" class="form-control" id="Name_Option"
                                       aria-describedby="emailHelp" placeholder="الرجاء ادخل نوع المصاريف التشغيلية "
                                       value=""

                                       required>
                                <div class="invalid-feedback">
                                    الرجاء ادخل نوع المصاريف التشغيلية
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
                            حذف المجمع
                        </h5>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('Options.destroy', 'test') }}" method="post">
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
        Counter_id = '';
        $(document).on('click', '.delete', function () {
            Option_id = $(this).attr('id');
            $('#Delete_id').val(Option_id);
            $('#confirmModal').modal('show');
            var Name_Delete = $(this).attr('Name_Delete');
            $('#Name_Delete').val(Name_Delete);

        });
        var eval_id = $(this).attr('id');

        $(document).on('click', '.edit_Option', function (e) {
            Option_id = $(this).attr('id');

            $('#edit_Options_modal').modal('show');
            var Name_Option = $(this).attr('Name_Option');
            $('#Name_Option').val(Name_Option);
            $('#Option_id').val(Option_id);

        });


            {{--$('#ok_button').click(function () {--}}
            {{--    $.ajax({--}}
            {{--        url: "/Dashboard/Options/destroy/" + Counter_id,--}}
            {{--        beforeSend: function () {--}}
            {{--            $('#ok_button').text('Deleting...');--}}
            {{--        }--}}
            {{--        ,--}}
            {{--        success: function (data) {--}}
            {{--            setTimeout(function () {--}}
            {{--                $('#confirmModal').modal('hide');--}}
            {{--                $('.data-table').DataTable().ajax.reload();--}}
            {{--            }, 2000);--}}
            {{--        }--}}
            {{--    })--}}
            {{--});--}}
            {{--$(function () {--}}

            {{--    $.ajaxSetup({--}}
            {{--        headers: {--}}
            {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--        }--}}
            {{--    });--}}

        var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('Options.index') }}",

                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'Name', name: 'Name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]
            });


        {{--});--}}
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
