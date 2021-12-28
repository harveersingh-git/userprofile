@extends('admin.include.loginmain')
@section('title')
Login-Admin
@endsection

@section('content')
<section class="ftco-section">
<main class="login-form">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="wrap new_center">
              <div class=" p-4 p-lg-5">
            <div class="d-flex">
            <div class="w-100 text-center">
             
                  <h4 class="mb-4 text-center">Reset Password</h4>
                  <hr>
                </div>
</div>



                  <div class="c ard-body">
  
                      <form action="{{ route('reset.password.post') }}" method="POST" class="signin-form">
                          @csrf
                          <input type="hidden" name="token" value="{{ $token }}">
  
                          <div class="form-group mb-3">
                              <label  class="label"   for="email_address" >E-Mail Address</label>
                             
                                  <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              
                          </div>
  
                          <div class="form-group mb-3">
                              <label   class="label" for="password" >Password</label>
                             
                                  <input type="password" id="password" class="form-control" name="password" required autofocus>
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              
                          </div>
  
                          <div class="form-group mb-3">
                              <label  class="label"  for="password-confirm" >Confirm Password</label>
                             
                                  <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                                  @if ($errors->has('password_confirmation'))
                                      <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                  @endif
                              
                          </div>
  
                          <div class="form-group mb-3">
                              <button type="submit" class="btn btn-info  w-100 px-3 mb-2 mt-2 text-uppercase">
                                  Reset Password
                              </button>
                          </div>
                      </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
</section>
@endsection