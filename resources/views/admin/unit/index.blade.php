@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h5>Units</h5>
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
                                <th>Paragraph Count</th>
{{--                                <th>Pages</th>--}}
                                <th>Name</th>
                                <th>Short Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $data)
                                @if(isset($data->parags))
                                @php
                                    $array = [];
                                    foreach ($data->parags as $parag){
                                        $obj = (object) [
                                            'order' => $parag->order,
                                            'edit_url' => route('paragraph.edit', $parag->id),
                                            'delete_url' => route('paragraph.destroy', $parag->id),
                                            'name' =>  substr($parag->name, 0, 50).'...',
                                            'explanation' => substr($parag->explanation, 0, 50).'...',
                                            'translation' => substr($parag->translation, 0, 50).'...',
                                            'audio' => $parag->audio,
                                        ];
                                        array_push($array, $obj);
                                    }

                                @endphp
                                @endif
                            <tr data-child-value="{{json_encode($array) }}">
                                <td>{{ $data->order }}</td>
                                <td>
{{--                                    <a href="javascript:void(0)" class="btn btn-sm btn-light parags">--}}
{{--                                        <i class="fas fa-eye"></i>--}}
{{--                                    </a>--}}
                                    <a href="{{ route('paragraph.index', ['unit_id' => $data->id ]) }}" target="_blank" class="btn btn-sm btn-light ">{{ $data->paragraph_count }}</a>
                                </td>
{{--                                <td>--}}

{{--                                    <form action="{{ route('unit.unit_edit', $data->id) }}" method="post" class="d-flex align-items-center" style="width: 350px">--}}
{{--                                        @csrf--}}
{{--                                        @method('PUT')--}}
{{--                                        <div class="d-flex">--}}
{{--                                            <input type="number" min="{{ $page_date['page_min']  }}" max="{{ $page_date['page_max'] }}" name="min_number" class="form-control-file mr-2" value="{{ $data->min_id() }}" />--}}
{{--                                            <input type="number" min="{{ $page_date['page_min']  }}" max="{{ $page_date['page_max'] }}" name="max_number" class="form-control-file mr-2" value="{{ $data->max_id() }}" />--}}
{{--                                            <button  style="  white-space: nowrap;" type="submit" class="btn btn-primary btn-sm d-inline-block">Change</button>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}

{{--                                </td>--}}
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->short_name }}</td>

                                <td>@if(is_null($data->image_id))
                                        None
                                    @else
                                    <a data-lightbox="image-1" href="{{ asset($data->image->url) }}"><img class="lazy" data-src="{{ asset($data->image->url) }}" height="50px"></a></td>
                                    @endif
                                <td>
                                    <a href="{{route('unit.edit', $data->id)}}" class="btn btn-info btn-sm text-white">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                     <form action="{{ route('unit.destroy', $data->id) }}" method="POST" class="d-inline-block">
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
            let example =  $('#dataTable').DataTable({
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

            $('#dataTable tbody').on('click', '.parags', function (e){
                var tr = $(this).closest('tr');
                var row = example.row(tr);
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    // row.child(format(tr.data('child-value'))).show();
                    tr.addClass('shown');
                }
            });

            function format(array) {


                    if (typeof array != "undefined" && array != null && array.length != null && array.length > 0) {
                    var num = 1;
                    var html = '<table class="table"><thead><tr><th>Order</th><th>Name</th><th>Translation</th><th>Explanation</th><th>Audio</th><th>Action</th></tr></thead><tbody>';
                    array.forEach(function (element) {
                        html +=
                            '</td><td>' + element['order'] +
                            '</td><td>' + element['name'] +
                            '</td><td>' + element['explanation'] +
                            '</td><td>' + element['translation'] +
                            '</td><td>' + element['audio'] + '</td>' +
                            '</td><td>' +
                            '<a href="'+ element['edit_url'] +'"class="btn btn-info btn-sm text-white"><i class="fas fa-edit"></i> Edit</a></td></tr>';
                    });
                    html += '</tbody></table>';
                    return html;
                }else  {
                    return '<div>No Paragraph</div>';
                }
            }

            });
    </script>
    @endpush
@endsection
