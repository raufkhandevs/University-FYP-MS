@extends('layouts.master')

@section('meta', 'Import')



@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('faculty.students.index') }}">Students</a></li>
                <li class="breadcrumb-item active" aria-current="page">Import</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Import</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Import Excel sheet</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="min-height: 300px">


                        <form action="{{ route('faculty.students.import.store') }}" method="POST"
                            enctype="multipart/form-data" class="w-100 d-block">
                            @csrf
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="sheet"
                                    aria-describedby="inputGroupFileAddon01" name="sheet">
                                <label class="custom-file-label" for="sheet">Choose
                                    Sheet</label>
                            </div>
                            <p class="mb-5 mt-1">Import your Excel, xlsx, xls, CSV file here ...</p>



                            <div class="w-100 d-flex justify-content-center">
                                <button type="submit" class="m-auto my-5 w-25 btn btn-primary">Upload</button>
                            </div>
                        </form>
                        <br />
                        <br />
                        <br />
                        <br />



                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @error('sheet')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror
@endsection
