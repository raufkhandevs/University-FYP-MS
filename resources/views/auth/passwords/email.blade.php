@extends('layouts.auth-master')

@section('meta', 'Forgot Password')

@section('content')
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form card shadow-lg rounded">
                <section class="login_content p-4">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <h1><img src="{{ asset('assets/images/imgs/' . $setting->header_logo) }}" alt=""
                                width="30%"></h1>
                        <h1>Reset Password</h1>
                        <div>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                        </div>
                        <div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror



                            <div class="mt-2">
                                <button type="submit" class="btn text-secondary submit border">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    {{-- <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1> --}}
                                    <h1></h1>
                                    <p>{{ $setting->copyrights }}</p>
                                </div>
                            </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection
