@extends('layout.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1 class="mb-4">{{ __('messages.login') }}</h1>
            <form action="{{ route('session.login') }}" method="POST">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('messages.email_address') }}</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('messages.password') }}</label>
                    <input type="password" name="password" class="form-control" id="password">
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit and Register Link -->
                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
                    <a href="{{ route('session.initR') }}" class="btn btn-link">{{ __("messages.dont_have_account") }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
