@extends('admin.include.loginmain')
@section('title')
Login-Admin
@endsection

@section('content')
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>



    <section class="ftco-section">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12">
                    <div class="wrap new_center">
                        <div class=" p-4 p-lg-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4 text-center">Login</h3>
                                    <hr>
                                </div>

                            </div>

                            <form method="POST" action="{{ route('login') }}" class="signin-form">
                                @csrf
                                <div class="form-group mb-3">

                                    <label class="label" for="name">Email id</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror




                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class=" btn btn-info w-100 px-3 mb-2 mt-2 text-uppercase">
                                        {{ __('Login') }}
                                    </button>


                                    @if (Route::has('password.request'))
                                    <a class="reset_pass  text-right d-block mt-2 font-14" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif

                                </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
@endsection