@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h5>Pages</h5>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4" >
            <form action="{{ route('page.bulkadd') }}" method="post" class="d-flex align-items-center justify-content-start">
                @csrf
                <input type="number" name="number" class="form-control mx-2" style="width: 100px" required/>
                <button class="btn btn-primary" type="submit">Add</button>
            </form>

            <div>
                <form id="search_form" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="get" action="{{ route('page.index') }}">
                    <div class="input-group search">
                        <input type="text" class="form-control bg-white small" value="{{ request()->get('search', '')  }}" placeholder="Section id" name="search" id="search_input" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>


            <form action="{{ route('page.remove') }}" method="POST" class="d-inline-block">
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
                                <th>Image</th>
                                <th>Start unit/paragraph</th>
                                <th>End unit/paragraph</th>
                                <th>Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $data)
                            <tr>
                                <td>{{ $data->order }}</td>
                                <td>
                                    @if(is_null($data->image_url))
                                        None
                                    @else
                                        <a data-lightbox="image-1" href="{{ asset($data->image_url) }}"><img class="lazy" data-src="{{ asset($data->image_url) }}" width="50px"></a>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('page.update_', $data->id) }}" method="post" class="d-flex align-items-center" style="width: 18%">
                                        @csrf
                                        @method('PUT')
                                        <div class="d-flex">
                                            <select name="start_unit" class="form-control" style="width: 120px" required>
                                                @foreach($units as $unit)
                                                    <option value="{{$unit->id}}" @if($unit->id === $data->start_unit) selected @endif >{{$unit->order }} {{$unit->short_name}}</option>
                                                @endforeach
                                            </select>
                                            <input type="number" name="start_paragraph" class="form-control ml-2" min="0" style="width: 80px" required value="{{ $data->start_paragraph }}">
                                            <button  style="white-space: nowrap;" type="submit" class="btn btn-primary btn-sm ml-2 d-inline-block">Set</button>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('page.update_', $data->id) }}" method="post" class="d-flex align-items-center" style="width: 18%">
                                        @csrf
                                        @method('PUT')
                                        <div class="d-flex">
                                            <select name="end_unit" class="form-control" style="width: 120px" required>
                                                @foreach($units as $unit)
                                                    <option value="{{$unit->id}}" @if($unit->id === $data->end_unit) selected @endif >{{$unit->order }} {{$unit->short_name}}</option>
                                                @endforeach
                                            </select>
                                            <input type="number" name="end_paragraph" class="form-control ml-2" min="0" style="width: 80px" required value="{{ $data->end_paragraph }}">
                                            <button  style="white-space: nowrap;" type="submit" class="btn btn-primary btn-sm ml-2 d-inline-block">Set</button>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('page.page_edit', $data->id) }}" method="post" class="d-flex align-items-center" style="width: 350px" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="d-flex justify-content-start">
                                            <input type="file" name="image" class="form-control-file" id="exampleFile" accept=".png, .jpg, .jpeg" required>
                                            <button  style="white-space: nowrap;" type="submit" class="btn btn-primary btn-sm d-inline-block">Change</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $datas->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
    <script type="text/javascript">
        $(function () {
            var lazyLoadInstance = new LazyLoad({});

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
