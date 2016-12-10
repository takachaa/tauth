@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <p>Thank you registering our service.</p>
                        <p>Actually Your account not activated yet.</p>
                        <p>We sent you email to {{$pre_user->email}}</p>
                        <p>Please check email and Activate your account.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection