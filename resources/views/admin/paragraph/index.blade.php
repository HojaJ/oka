@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4" >
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addItem">
                Add New
            </a>
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
                                <th>Translation</th>
                                <th>Explanation</th>
                                <th>Audio</th>
                                <th>Unit</th>
                                <th>Page</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $data)
                            <tr>
                                <td>{{ $data->order }}</td>
                                <td>{{ substr($data->name, 0, 50).'...' }}</td>
                                <td>{!!  substr($data->translation, 0, 50).'...' !!}</td>
                                <td>{!! substr($data->explanation, 0, 50).'...' !!}</td>
                                <td>
                                    <figure>
                                        <figcaption>{{ $data->audio }}</figcaption>
                                        <audio controls src="{{ asset($data->audio) }}">
                                            Your browser does not support the <code>audio</code> element.
                                        </audio>
                                    </figure>
                                </td>

                                <td>
                                    @if(is_null($data->unit_id))
                                        None
                                    @else
                                        {{ $data->unit->name }}
                                    @endif
                                </td>
                                <td>
                                    @if(is_null($data->unit_id))
                                        None
                                    @else
                                        @if($data->unit->pages)
                                            <form action="{{ route('paragraph.paragraph_edit', $data->id) }}" method="post" class="d-flex align-items-center" style="width: 350px">
                                                @csrf
                                                @method('PUT')
                                                <div class="d-flex">
                                                    <select name="page_id" class="form-control ml-2">
                                                        <option>None</option>
                                                        @foreach($data->unit->pages as $page)
                                                            <option @if($page->id === $data->page_id) selected @endif value="{{$page->id}}">{{ $page->order }}</option>
                                                        @endforeach
                                                    </select>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <button  style="  white-space: nowrap;" type="submit" class="btn btn-primary btn-sm d-inline-block">Change</button>
                                                </div>
                                            </form>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('paragraph.edit', $data->id)}}" class="btn btn-info btn-sm text-white">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                     <form action="{{ route('paragraph.destroy', $data->id) }}" method="POST" class="d-inline-block">
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
                            <input type="file" name="audio" class="form-control-file" id="exampleFile" accept=".mp3, .3gp, .aa, .aac,.wma,.way" required>
                        </div>

{{--                        <select name="unit_id" id="exampleI">--}}
{{--                            <option value="none">None</option>--}}
{{--                            @foreach($units as $unit)--}}
{{--                                <option value="{{$unit->id}}">{{ $unit->name }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}

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
            });
    </script>
    @endpush
@endsection
