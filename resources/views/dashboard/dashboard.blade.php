@extends('layouts.app')
@push('styles')
    <style>
        .checkboxes__item {
            padding: 15px;
            width: 100%;
        }

        /* STYLE E */
        .checkbox.style-e {
            display: inline-block;
            position: relative;
            padding-left: 50px;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .checkbox.style-e input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkbox.style-e input:checked ~ .checkbox__checkmark {
            background-color: #f7cb15;
        }

        .checkbox.style-e input:checked ~ .checkbox__checkmark:after {
            left: 21px;
        }

        .checkbox.style-e:hover input ~ .checkbox__checkmark {
            background-color: #eee;
        }

        .checkbox.style-e:hover input:checked ~ .checkbox__checkmark {
            background-color: #f7cb15;
        }

        .checkbox.style-e .checkbox__checkmark {
            position: absolute;
            top: 1px;
            left: 0;
            height: 22px;
            width: 40px;
            background-color: #eee;
            transition: background-color 0.25s ease;
            border-radius: 11px;
        }

        .checkbox.style-e .checkbox__checkmark:after {
            content: "";
            position: absolute;
            left: 3px;
            top: 3px;
            width: 16px;
            height: 16px;
            display: block;
            background-color: #fff;
            border-radius: 50%;
            transition: left 0.25s ease;
        }

        .checkbox.style-e .checkbox__body {
            color: #333;
            line-height: 1.4;
            font-size: 16px;
            transition: color 0.25s ease;
        }

    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <h5>Version</h5>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <form action="{{ route('version_start') }}" method="POST" class="d-inline-block" id="version_start_form">
                @csrf
                @method('PUT')
                <div class="checkboxes__item">
                    <label class="checkbox style-e">
                        <input type="checkbox" name="start_record" id="version_start"
                               @if($version->start_record) checked @endif />
                        <div class="checkbox__checkmark"></div>
                        <div class="checkbox__body">Switch Version record</div>
                    </label>
                </div>
            </form>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Changed data</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                @if($version->data)
                                    @foreach($version->data as $key => $data)
                                        {{$key}}: {{ json_encode($data) }}   <br>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('version_clear') }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('PUT')
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm text-white"
                                       id="poz-buton">
                                        <i class="fas fa-campground"></i> Clear
                                    </a>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
        <script type="text/javascript">
            $(function () {
                $('#version_start').click(function () {
                    $('#version_start_form').submit();
                })

                $('#dataTable tbody').on('click', "[id='poz-buton']", function (event) {
                    event.preventDefault();
                    Swal.fire({
                        title: "Arrasalamak islýäňizmi!",
                        icon: 'warning',
                        showCancelButton: true,
                        reverseButtons: true,
                        confirmButtonColor: '#0CC27E',
                        cancelButtonColor: '#FF586B',
                        confirmButtonText: 'Howwa',
                        cancelButtonText: 'Ýok!',
                        confirmButtonClass: 'btn btn-success ml-1',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#poz-buton').parent().submit();
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
