@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/css/summernote-lite.min.css') }}">
@endpush
@section('content')
<div class="container-fluid">
    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left">&nbsp;&nbsp;</i>Back</a>
    <div class="col-8 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('paragraph.update', $paragraph->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Paragraph</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="examplename">Name</label>
                            <input type="text" name="name" class="form-control" id="examplename" value="{{ $paragraph->name }}">
                        </div>

                        <div class="form-group">
                            <label for="examplorder">Order</label>
                            <input type="number" name="order" class="form-control" id="examplorder" value="{{ $paragraph->order }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleE">Explanation</label>
                            <textarea name="explanation" rows="8" class="textarea_summer form-control" id="exampleE">{{ $paragraph->explanation }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleT">Translation</label>
                            <textarea name="translation" rows="8" class="textarea_summer form-control" id="exampleT">{{ $paragraph->translation }}</textarea>
                        </div>

                        <div class="form-group row align-items-center">
                            <div class="col">
                                <input type="file" name="audio" class="form-control-file" id="exampleFile" accept=".mp3, .3gp, .aa, .aac,.wma,.way" />
                            </div>

                            <div class="col">
                                <figure class="m-0">
                                    <figcaption>{{ $paragraph->audio }}</figcaption>
                                    <audio controls src="{{ asset($paragraph->audio) }}">
                                        Your browser does not support the <code>audio</code> element.
                                    </audio>
                                </figure>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleU">Unit</label>
                            <select name="unit_id" id="exampleU" class="form-control">
                                <option value="none">None</option>
                                @foreach($units as $unit)
                                    <option @if($paragraph->unit_id === $unit->id) selected @endif value="{{$unit->id}}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    <div class="m-3">
                        <button type="submit" class="btn btn-primary d-inline-block">Edit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>
@endsection
    @push('scripts')
        <script src="{{ asset('vendor\js\summernote-lite.min.js') }}"></script>
        <script>
            $(function () {
                $('.textarea_summer').summernote({
                    height: 120
                });
            });
        </script>
@endpush
