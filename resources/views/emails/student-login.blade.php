@extends('emails.layouts.main')

@section('content')
    <div class="conatiner">

        <h1>Welcome</h1>

        <p>Hope your are doing well!</p>

        <p>Please use this credential to login to your fyp portal</p>

        <label for="">Email</label>: <span>{{ $user->email }}</span>
        <label for="">Password</label>: <span>{{ 'password' }}</span>

        <br />

        <br />

        Regards,
        University of south Asia.
    </div>
@endsection
