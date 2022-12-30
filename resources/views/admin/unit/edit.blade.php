@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left">&nbsp;&nbsp;</i>Back</a>
    <div class="col-6 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('unit.update', $data->id) }}" method="post" >
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="examplorder">Order</label>
                        <input type="number" name="order" class="form-control" id="examplorder" value="{{ $data->order }}">
                    </div>
                    <div class="form-group">
                        <label for="examplename">Name</label>
                        <input type="text" name="name" class="form-control" id="examplename" value="{{ $data->name }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleshort">Short Name</label>
                        <input type="text" name="short_name" class="form-control" id="exampleshort" value="{{ $data->short_name }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleP">Paragraph Count</label>
                        <input type="number" name="paragraph_count" class="form-control" id="exampleP" value="{{ $data->paragraph_count }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleI">Choose Image</label>
                        <select name="image_id" id="exampleI">
                            <option value="none">None</option>
                            @foreach($images as $image)
                                <option @if($image->id == $data->image_id) selected @endif value="{{$image->id}}">{{ $image->id }}</option>
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
@endsection

