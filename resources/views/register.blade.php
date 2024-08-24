@extends('layout.master')

@section('content')
<div class="container mt-5">
    <div class="row-12">
      <h1>Register</h1>
        <form action="{{ route('session.register') }}" method="POST">
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
          <div class="mb-3">
            <label for="linkedinuser" class="form-label">Linkedin Link Username</label>
            <input type="text" name="linkedin" class="form-control" id="linkedinuser">
            @error('linkedin')
              <p class="error-message">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" name="phone" class="form-control" id="phone">
            @error('phone')
              <p class="error-message">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-3">
            <label for="experience" class="form-label">Experience years</label>
            <input type="number" name="experience" class="form-control" id="experience">
            @error('experience')
              <p class="error-message">{{ $message }}</p>
            @enderror
          </div>
          <div class="form-check form-check-inline">
              <input class="form-check-input" value="Male" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
              <label class="form-check-label" for="flexRadioDefault1">
                  Male
              </label>
          </div>
          <div class="form-check form-check-inline">
              <input class="form-check-input" value="Female" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
              <label class="form-check-label" for="flexRadioDefault2">
                  Female
              </label>
          </div>
          @error('flexRadioDefault')
              <p class="error-message">{{ $message }}</p>
            @enderror
          <div class="d-block mb-3">
              <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
              @foreach ($interests as $i)
                <input type="checkbox" class="btn-check" name="checkboxes[]" id="checkbox{{ $i->id }}" value="{{ $i->id }}" autocomplete="off">
                <label class="btn btn-outline-primary" for="checkbox{{ $i->id }}">{{ $i->name }}</label>
              @endforeach
              </div>
              @error('checkboxes')
              <p class="error-message">{{ $message }}</p>
            @enderror
          </div>
          <div class="row">
            <div class="col-12 d-flex justify-content-between">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="{{ route('login') }}">Have an account? Login!</a>
            </div>
          </div>
        </form>
    </div>
</div>
@endsection