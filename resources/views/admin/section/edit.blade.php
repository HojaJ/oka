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
                        <label for="examplename">Name</label>
                        <input type="text" name="name" class="form-control" id="examplename" value="{{ $data->name }}">
                    </div>

                    <div class="form-group mt-5">
                        <label for="start_unit">Start unit</label>
                        <select name="start_unit" id="start_unit" class="form-control">
                            @foreach($units as $unit)
                                <option @if($unit->order === $data->start_unit) selected @endif value="{{ $unit->order }}">{{ $unit->order }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="start_paragraph">Start paragraph</label>
                        <input min="1" type="number" name="start_paragraph" class="form-control" id="start_paragraph" value="{{ $data->start_paragraph }}">
                    </div>

                    <div class="form-group">
                        <label for="end_unit">End unit</label>
                        <select name="end_unit" id="end_unit" class="form-control">
                            @foreach($units as $unit)
                                <option @if($unit->order === $data->end_unit) selected @endif value="{{ $unit->order }}">{{ $unit->order }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="end_paragraph">End paragraph</label>
                        <input min="1" type="number" name="end_paragraph" class="form-control" id="end_paragraph" value="{{ $data->end_paragraph }}">
                    </div>


                    <div class="form-group mt-5">
                        <label for="min">Pages id min</label>
                        <input min="1" type="number" name="min" class="form-control" id="min" value="{{ $data->min }}">
                    </div>
                    <div class="form-group">
                        <label for="max">Pages id max</label>
                        <input min="1" type="number" name="max" class="form-control" id="max" value="{{ $data->max }}">
                    </div>


                    <div class="mt-5">
                        <button type="submit" class="btn btn-primary d-inline-block">Edit</button>
                    </div>

                </form>
            </div>
        </div>

</div>
@endsection

