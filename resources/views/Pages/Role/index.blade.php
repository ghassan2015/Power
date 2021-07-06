@extends('layouts.front')
@section('Content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                <h3 class="card-label">لوحة عرض الصلاحيات </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <!--end::Dropdown-->
                <!--begin::Button-->

                <a class="btn btn-primary" href="{{route('roles.create')}}" id="createNewProduct">
                    <i class="fa fa-plus" aria-hidden="true"></i> اضافة صلاحية جديدة</a>


                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered data-table" style="text-align: right">
                <thead>


                <tr>
                    <th width="2%">#</th>
                    <th>اسم الصلاحية</th>
                    <th>العمليات</th>
                </tr>

                </thead>
                <tbody>
                </tbody>
            </table>
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


        <@stop
        @section('js')
            <script type="text/javascript">
                Counter_id = '';
                $(document).on('click', '.delete', function () {
                    Counter_id = $(this).attr('id');
                    console.log($(this).attr('id'));
                    $('#confirmModal').modal('show');
                });

                $('#ok_button').click(function () {
                    $.ajax({
                        url: "/Dashboard/Payment/destroy/" + Counter_id,
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

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var table = $('.data-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('roles.index') }}",

                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                            {data: 'Name', name: 'Name'},
                            {data: 'action', name: 'action', orderable: false, searchable: false},
                        ]
                    });


                });
            </script>
@stop
