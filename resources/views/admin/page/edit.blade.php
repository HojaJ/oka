@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left">&nbsp;&nbsp;</i>Back</a>
    <div class="col-6 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('page.update', $data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="examplorder">Order</label>
                        <input type="number" name="order" class="form-control" id="examplorder" value="{{ $data->order }}">
                    </div>
                    <div class="row form-group">
                        <div class="col">
                            <label for="exampleFile">Edit Image</label>
                            <input type="file" name="image" class="form-control-file" id="exampleFile" accept=".png, .jpg, .jpeg">
                        </div>
                        <div class="col pt-3">
                            <img src="{{ asset($data->image_url) }}" height="50px">
                        </div>
                    </div>

                    <div class="m-3">
                        <button type="submit" class="btn btn-primary d-inline-block">Edit</button>
                    </div>

                </form>
            </div>
        </div>

</div>
@endsection

