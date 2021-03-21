@extends('layouts.app')

<style type="text/css">
    .myDiv a {
        margin: 10px;
    }

    .myDiv {
        margin: 25px
    }
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $formHeading }}</div>

                <div class="card-body">

                    <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-6">
                            <input type="file" name="file" required="" class="form-control">
                            @error('file')                            
                                <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <br>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success">+ Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
