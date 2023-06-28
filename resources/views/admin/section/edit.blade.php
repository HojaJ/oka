@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left">&nbsp;&nbsp;</i>Back</a>
    <div class="col-6 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('section.update', $data->id) }}" method="post" >
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="exampleorder">Order</label>
                        <input min="1" type="number" name="order" class="form-control" id="exampleorder" value="{{ $data->order }}">
                    </div>
                    <div class="form-group">
                        <label for="min">Pages id min</label>
                        <input min="1" type="number" name="min" class="form-control" id="min" value="{{ $data->min }}">
                    </div>
                    <div class="form-group">
                        <label for="max">Pages id max</label>
                        <input min="1" type="number" name="max" class="form-control" id="max" value="{{ $data->max }}">
                    </div>

                    <div class="m-3">
                        <button type="submit" class="btn btn-primary d-inline-block">Edit</button>
                    </div>

                </form>
            </div>
        </div>

</div>
@endsection

