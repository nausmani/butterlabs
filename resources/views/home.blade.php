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
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Upload Invoices (PDF):</h3>

                    <div class="myDiv">
                        <a role="button" href="/pdf-upload/frontier" class="btn btn-success"> + Frontier Comunication</a> </br>
                        <a role="button" href="/pdf-upload/comcast" class="btn btn-success"> + Comcast Business</a> </br>
                        <a role="button" href="/pdf-upload/redlight" class="btn btn-success"> + Red Light</a> </br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
