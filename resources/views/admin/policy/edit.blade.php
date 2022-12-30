@extends('layouts.app')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('vendor/css/summernote-lite.min.css') }}">
    @endpush
@section('content')
<div class="container-fluid">
    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left">&nbsp;&nbsp;</i>Back</a>
    <div class="col-10 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('policy.update', $data->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <h5 class="modal-title" id="exampleModalLabel">Edit Policy</h5>
                    <div class="form-group">
                        <label for="text">Policy text</label>
                        <textarea class="textarea_summer" name="text" id="text" rows="5">
                            {{ $data->text }}
                        </textarea>
                    </div>
                    <div class="m-3">
                        <button type="submit" class="btn btn-primary d-inline-block">Edit</button>
                    </div>
                </form>
            </div>
        </div>

</div>
@endsection
@push('scripts')
        <script src="{{ asset('vendor\js\summernote-lite.min.js') }}"></script>
        <script>
            $(function () {
                $('.textarea_summer').summernote({
                    height: 150
                });
            });
        </script>
@endpush


