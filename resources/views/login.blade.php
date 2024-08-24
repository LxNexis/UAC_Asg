@extends('layout.master')

@section('content')
<div class="container mt-5">
    <div class="row-12">
      <h1>Login</h1>
        <form action="{{ route('session.login') }}" method="POST">
        @csrf
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('email')
              <p class="error-message">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            @error('password')
              <p class="error-message">{{ $message }}</p>
            @enderror
          </div>
          <div class="row">
            <div class="col-12 d-flex justify-content-between">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="{{ route('session.initR') }}">Don't have an account? Register!</a>
            </div>
          </div>
        </form>
    </div>
</div>
@endsection