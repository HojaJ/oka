@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h5>Units</h5>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addItem">
                Add New
            </a>

            <div>
                <form id="search_form"
                      class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                      method="get" action="{{ route('unit.index') }}">
                    <div class="input-group search">
                        <input type="text" class="form-control bg-white small"
                               value="{{ request()->get('search', '')  }}" placeholder="Search" name="search"
                               id="search_input"/>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Order</th>
                            <th>Paragraph Count</th>
                            <th>Name</th>
                            <th>Short Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td>{{ $data->order }}</td>
                                <td><a href="{{ route('paragraph.index', ['unit_id' => $data->id ]) }}" target="_blank"
                                       class="btn btn-sm btn-light ">{{ $data->paragraph_count }}</a></td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->short_name }}</td>
                                <td>@if(is_null($data->image_id))
                                        None
                                    @else
                                        <a data-lightbox="image-1" href="{{ asset($data->image->url) }}"><img
                                                    class="lazy" data-src="{{ asset($data->image->url) }}"
                                                    height="50px"></a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('unit.edit', $data->id)}}" class="btn btn-info btn-sm text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('unit.destroy', $data->id) }}" method="POST"
                                          class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm text-white"
                                           id="poz-buton-{{$data->id}}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-5">
                        {!! $datas->links() !!}
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="margin-top:100px;">
            <div class="modal-content">
                <form action="{{ route('unit.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Unit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="examplorder">Order</label>
                            <input type="number" name="order" class="form-control" id="examplorder">
                        </div>
                        <div class="form-group">
                            <label for="examplename">Name</label>
                            <input type="text" name="name" class="form-control" id="examplename" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleshort">Short Name</label>
                            <input type="text" name="short_name" class="form-control" id="exampleshort" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleP">Paragraph Count</label>
                            <input type="number" name="paragraph_count" class="form-control" id="exampleP" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleI">Choose Image</label>
                            <select name="image_id" id="exampleI">
                                <option value="none">None</option>
                                @foreach($images as $image)
                                    <option value="{{$image->id}}">{{ $image->id }}</option>
                                @endforeach
                            </select>
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


                $('#dataTable tbody').on('click', "[id^='poz-buton-']", function (event) {
                    var id = $(this).attr('id');
                    id = id.replace("poz-buton-", '');
                    event.preventDefault();
                    Swal.fire({
                        title: "Pozmak isleýäňizmi!",
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
                            $('#poz-buton-' + id).parent().submit();
                        } else {
                            Swal.fire(
                                'Cancelled',
                                'Goýbolsun edildi',
                                'error'
                            )
                        }
                    })
                });
            });
        </script>
    @endpush
@endsection
