@extends('backoffice.layouts.app')
@section('title', 'Profile')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Profile</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('backoffice.home') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Profile</div>
      </div>
    </div>
    <div class="section-body">
      <h2 class="section-title">Hi, {{ Auth::user()->name }}!</h2>
      <p class="section-lead">
        Change information about yourself on this page.
      </p>

      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h4>Jump To</h4>
            </div>
            <div class="card-body">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item"><a href="{{ route('backoffice.profile.index') }}" class="nav-link {{ setActive('backoffice.profile.index') }}">Information</a></li>
                <li class="nav-item"><a href="{{ route('backoffice.profile.password') }}" class="nav-link {{ setActive('backoffice.profile.password') }}">Reset Password</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <form method="POST" action="{{ route('backoffice.profile.reset') }}">
            @csrf @method('PUT')
            <div class="card">
            <div class="card-header">
                <h4>Information</h4>
            </div>
            <div class="card-body">
                <div class="form-group row align-items-center">
                <label for="password" class="form-control-label col-sm-3 text-md-right">New Password*</label>
                <div class="col-sm-6 col-md-9">
                    <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                </div>
                <div class="form-group row align-items-center">
                <label for="password_confirmation" class="form-control-label col-sm-3 text-md-right">Confirm Password*</label>
                <div class="col-sm-6 col-md-9">
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                </div>
            </div>
            <div class="card-footer bg-whitesmoke text-md-right">
                <button class="btn btn-primary" type="submit">Save Changes</button>
            </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
