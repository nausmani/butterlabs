@extends('layouts.app')

<style type="text/css">
    .myDiv a {
        margin: 10px;
    }

    .myDiv {
        margin: 25px
    }
    .pdf-action-btn {
        padding: 15px 50px !important;
        min-width: 325px !important;
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

                    <div class="row myDiv">
                        <div class="col-md-4">
                            <a role="button" href="/pdf-upload/frontier" class="btn btn-success pdf-action-btn"> + Frontier Communications</a>
                        </div>
                        <div class="col-md-4">
                            <a role="button" href="/pdf-upload/comcast" class="btn btn-success pdf-action-btn"> + Comcast Business</a>
                        </div>
                        <div class="col-md-4">
                            <a role="button" href="/pdf-upload/rednight" class="btn btn-success pdf-action-btn"> + Red Night Consulting</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
