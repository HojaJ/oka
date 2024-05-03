@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ url()->previous() }}" class="btn btn-primary" data-toggle="modal" data-target="#addItem">
                Add New
            </a>

            <div>
                <form id="search_form"
                      class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                      method="get" action="{{ route('paragraph.index') }}">

                    <input type="hidden" name="unit_id" value="{{ request()->query('unit_id') }}">
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
                            <th>Name</th>
                            <th>Explanation</th>
                            <th>Translation</th>
                            <th>Audio</th>
                            <th>Unit</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td>{{ $data->order }}</td>
                                <td style="text-align: right; direction: rtl;">{{ $data->name ?  $data->name : 'Empty' }}</td>
                                <td style="">{!!   substr($data->translation, 0, 50).'...' !!}</td>
                                <td style="">{!! substr($data->explanation, 0, 50).'...' !!}</td>
                                <td>
                                    <figure>
                                        <figcaption>{{ $data->audio }}</figcaption>
                                        <audio controls src="{{ asset($data->audio) }}">
                                            Your browser does not support the <code>audio</code> element.
                                        </audio>
                                    </figure>
                                </td>

                                <td style="white-space: nowrap">
                                    @if(is_null($data->unit_id))
                                        None
                                    @else
                                        {{ $data->unit->name }}
                                    @endif
                                </td>
                                <td style="white-space: nowrap">
                                    <a href="{{route('paragraph.edit', $data->id)}}"
                                       class="btn btn-info btn-sm text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('paragraph.destroy', $data->id) }}" method="POST"
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
                    <div class="d-flex justify-content-center mt-5">
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
                <form action="{{ route('paragraph.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Paragraph</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="examplename">Name</label>
                            <input type="text" name="name" class="form-control" id="examplename">
                        </div>

                        <div class="form-group">
                            <label for="exampleE">Explanation</label>
                            <textarea name="explanation" class="form-control" id="exampleE"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleT">Translation</label>
                            <textarea name="translation" class="form-control" id="exampleT"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFile">Audio</label>
                            <input type="file" name="audio" class="form-control-file" id="exampleFile"
                                   accept=".mp3, .3gp, .aa, .aac,.wma,.way" required>
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
                $('#dataTable tbody').on('click', "[id^='poz-buton-']", function (event) {
                    var id = $(this).attr('id');
                    id = id.replace("poz-buton-", '');
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
