@extends('admin.include.loginmain')
@section('title')
Login-Admin
@endsection

@section('content')

@section('content')
<section class="ftco-section">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="wrap new_center">
            <div class=" p-3 p-lg-4">

            <div class="d-flex">
            <div class="w-100 text-center">
                <h4 class="mb-4 text-center">{{ __('Reset Password') }}</h4></div>
</div>
<hr>
                <div class="card-body">
                @if (Session::has('message'))
                         <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('forget.password.post') }}">
                        @csrf

                        

                        <div class="form-group mb-3">
                            <label class="label" for="email">{{ __('E-Mail Address') }}</label>

                           
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                       

                       
                            <div class="form-group">
                                <button type="submit" class="btn btn-info w-100 px-3 mb-2 mt-2 text-uppercase">
                                    {{ __('Send Password Reset Link') }}
                                </button>

                                <a class="login_back_btn d-block mt-2 font-14" type="" href="{{ url('home') }}"> Back</a>

                            </div>
        
                          
                       
                        
                    </form>
                </div>
            </div>
</div>
        </div>
    </div>
</div>
<section>
@endsection
