@extends('layouts.auth-master')

@section('meta', 'Reset Password')

@section('content')
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form card shadow-lg rounded">
                <section class="login_content p-4">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <h1><img src="{{ asset('assets/images/imgs/' . $setting->header_logo) }}" alt=""
                                width="30%"></h1>
                        <h1>Create New Password</h1>
                        <div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="Password" />

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password" placeholder="Confirm Password" />
                        </div>

                        <div class="mt-2">
                            <button type="submit" class="btn text-secondary submit border">
                                {{ __('Reset Password') }}
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
