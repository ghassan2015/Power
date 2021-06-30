@extends('layouts.front')
@section('Content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">

                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal" style="float: right">
                                s اضافة صندوق جديد
                            </button>
                        </div>
                        <div class="container">
                            <table class="table table-bordered data-table" style="text-align: right">
                                <thead>
                                <tr class="text-dark">
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>الصندوق</th>
                                    <th>المكان</th>

                                    <th>الحالة</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach ($Counters as $Counter)
                                    <tr>
                                        <?php $i++; ?>
                                        <td>{{ $i }}</td>
                                        <td>{{ $Counter->Name }}</td>
                                        <td>{{ $Counter->Box->Name }}
                                        <td>{{ $Counter->Box->Location }}</td>
                                        <td>
                                            @if ($Counter->is_active === 1)
                                                <label
                                                    class="badge badge-success">مفعل</label>
                                            @else
                                                <label
                                                    class="badge badge-danger">غير
                                                    مفعل</label>
                                            @endif

                                        </td>
                                        <td>
                                            <a class="btn btn-outline-info btn-sm"
                                               href="{{route('Counters.edit',$Counter->id)}}">
                                                تعديل
                                            </a>


                                            <a href="{{route('Counters.destroy',$Counter->id)}}"
                                               class="btn btn-outline-danger btn-sm delete"
                                               id="{{$Counter->id}}">حذف</a>
                                        </td>
                                    </tr>


                                    <!--تعديل قسم جديد -->


                                    <!-- delete_modal_Grade -->
                                    <div id="confirmModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                    <h2 class="modal-title">Confirmation</h2>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 align="center" style="margin:0;">Are you sure you want to remove
                                                        this data?</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" name="ok_button" id="ok_button"
                                                            class="btn btn-danger">OK
                                                    </button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--اضافة قسم جديد -->


    <!-- row closed -->
@endsection
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
                url: "/Dashboard/Counters/destroy/" + Counter_id,
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
    </script>

@endsection
