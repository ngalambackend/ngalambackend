@extends('backoffice.layouts.app')
@section('title', 'Profile')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Profile</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
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
                <li class="nav-item"><a href="#" class="nav-link active">Information</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Reset Password</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <form id="setting-form">
            <div class="card" id="settings-card">
              <div class="card-header">
                <h4>General Settings</h4>
              </div>
              <div class="card-body">
                <p class="text-muted">General settings such as, site title, site description, address and so on.</p>
                <div class="form-group row align-items-center">
                  <label for="site-title" class="form-control-label col-sm-3 text-md-right">Site Title</label>
                  <div class="col-sm-6 col-md-9">
                    <input type="text" name="site_title" class="form-control" id="site-title">
                  </div>
                </div>
                <div class="form-group row align-items-center">
                  <label for="site-description" class="form-control-label col-sm-3 text-md-right">Site Description</label>
                  <div class="col-sm-6 col-md-9">
                    <textarea class="form-control" name="site_description" id="site-description"></textarea>
                  </div>
                </div>
                <div class="form-group row align-items-center">
                  <label class="form-control-label col-sm-3 text-md-right">Site Logo</label>
                  <div class="col-sm-6 col-md-9">
                    <div class="custom-file">
                      <input type="file" name="site_logo" class="custom-file-input" id="site-logo">
                      <label class="custom-file-label">Choose File</label>
                    </div>
                    <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                  </div>
                </div>
                <div class="form-group row align-items-center">
                  <label class="form-control-label col-sm-3 text-md-right">Favicon</label>
                  <div class="col-sm-6 col-md-9">
                    <div class="custom-file">
                      <input type="file" name="site_favicon" class="custom-file-input" id="site-favicon">
                      <label class="custom-file-label">Choose File</label>
                    </div>
                    <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="form-control-label col-sm-3 mt-3 text-md-right">Google Analytics Code</label>
                  <div class="col-sm-6 col-md-9">
                    <textarea class="form-control codeeditor" name="google_analytics_code"></textarea>
                  </div>
                </div>
              </div>
              <div class="card-footer bg-whitesmoke text-md-right">
                <button class="btn btn-primary" id="save-btn">Save Changes</button>
                <button class="btn btn-secondary" type="button">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
