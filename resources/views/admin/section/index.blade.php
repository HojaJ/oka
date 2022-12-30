@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h5>Sections</h5>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4" >
            <form action="{{ route('section.bulkadd') }}" method="post" class="d-flex align-items-center justify-content-start">
                @csrf
                <input type="number" name="number" class="form-control mx-2" style="width: 100px" required/>
                <button class="btn btn-primary" type="submit">Add</button>
            </form>

            <form action="{{ route('section.remove') }}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <span class="badge-light ">2 gezek bas</span>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm text-white"  id="delete-all">
                    <i class="fas fa-trash"></i> Delete All
                </a>
            </form>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Pages</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $data)
                            <tr>
                                <td>{{ $data->order }}</td>
                                <td>

                                    <form action="{{ route('section.page_edit', $data->id) }}" method="post" class="d-flex align-items-center" style="width: 350px">
                                        @csrf
                                        @method('PUT')
                                        <div class="d-flex">
                                            <input type="number" min="{{ $parentless->min('id') }}" max="{{ $parentless->max('id') }}" name="min_number" class="form-control-file mr-2" value="{{ $data->min_id() }}" />
                                            <input type="number" min="{{ $parentless->min('id') }}" max="{{ $parentless->max('id') }}" name="max_number" class="form-control-file mr-2" value="{{ $data->max_id() }}" >
                                            <button  style="  white-space: nowrap;" type="submit" class="btn btn-primary btn-sm d-inline-block">Change</button>
                                        </div>
                                    </form>

                                </td>
                                <td>
                                    <a href="{{route('section.edit', $data->id)}}" class="btn btn-info btn-sm text-white">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                     <form action="{{ route('section.destroy', $data->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm text-white"  id="poz-buton-{{$data->id}}">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="margin-top:100px;">
            <div class="modal-content">
                <form action="{{ route('section.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Section</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="examplename">Name</label>
                            <input type="text" name="name" class="form-control" id="examplename"required>
                        </div>
                        <div class="form-group">
                            <label for="examplorder">Order</label>
                            <input type="number" name="order" class="form-control" id="examplorder">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script type="text/javascript">
        $(function () {
            var lazyLoadInstance = new LazyLoad({});
            $('#dataTable').DataTable({
                stateSave: true,
                "iDisplayLength": 100,
                drawCallback: function(){
                    lazyLoadInstance.update();
                }
            });

            $('#dataTable tbody').on('click', "[id^='poz-buton-']", function (event) {
                var id = $(this).attr('id');
                id = id.replace("poz-buton-",'');
                event.preventDefault();
                    Swal.fire({
                      title: "Pozmak islýäňizmi!",
                      icon: 'warning',
                      showCancelButton: true,
                      reverseButtons: true,
                      confirmButtonColor: '#0CC27E',
                      cancelButtonColor: '#FF586B',
                      confirmButtonText: 'Howwa, poz!',
                      cancelButtonText: 'Ýok!',
                      confirmButtonClass: 'btn btn-success ml-1',
                      cancelButtonClass: 'btn btn-danger',
                      buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                          $('#poz-buton-'+id).parent().submit();
                        } else{
                          Swal.fire(
                            'Cancelled',
                            'Goýbolsun edildi',
                            'error'
                          )
                        }
                      })
                });
            $('#delete-all').on('dblclick', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: "Ähli Pagelary pozmalymy?!",
                    icon: 'warning',
                    showCancelButton: true,
                    reverseButtons: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Howwa, poz!',
                    cancelButtonText: 'Ýok!',
                    confirmButtonClass: 'btn btn-success ml-1',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent().submit();
                    } else{
                        Swal.fire(
                            'Cancelled',
                            'Goýbolsun edildi',
                            'error'
                        )
                    }
                });

            })
            });
    </script>
    @endpush
@endsection
