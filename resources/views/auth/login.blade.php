@extends('layouts.auth-master')

@section('meta', 'Login')

@section('content')
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form card shadow-lg rounded">
                <section class="login_content p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <h1><img src="{{ asset('assets/images/imgs/' . $setting->header_logo) }}" alt=""
                                width="30%"></h1>
                        <h1>Login</h1>
                        </h1>
                        <div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" />

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class=" d-flex justify-content-start ml-4">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn text-secondary submit">
                                {{ __('Login') }}
                            </button>
                            @if (Route::has('password.request'))
                                <a class="reset_pass" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <p>{{ $setting->copyrights }}</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>


        </div>
    </div>
@endsection
