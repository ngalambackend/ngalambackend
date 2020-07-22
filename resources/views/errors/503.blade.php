@extends('layouts.skeleton')

@section('title')
    503
@endsection

@section('app')
<section class="section">
    <div class="container mt-5">
      <div class="page-error">
        <div class="page-inner">
          <h1>503</h1>
          <div class="page-description">
            Be right back.
          </div>
          <div class="page-search">
            <div class="mt-3">
              <a href="javascript:history.back();">Back to Home</a>
            </div>
          </div>
        </div>
      </div>
      <div class="simple-footer mt-5">
        Copyright &copy; {{ env('APP_NAME') }} {{ date('Y') }}
      </div>
    </div>
  </section>
@endsection
