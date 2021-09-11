@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">


                    <h1>{{ __('This account is blocked!') }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
