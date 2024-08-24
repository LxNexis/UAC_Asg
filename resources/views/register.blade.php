@extends('layout.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-4">{{ __('messages.register') }}</h1>
            <form action="{{ route('session.register') }}" method="POST">
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

                <!-- LinkedIn Link Username -->
                <div class="mb-3">
                    <label for="linkedin" class="form-label">{{ __('messages.linkedin') }}</label>
                    <input type="text" name="linkedin" class="form-control" id="linkedin" value="{{ old('linkedin') }}">
                    @error('linkedin')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div class="mb-3">
                    <label for="phone" class="form-label">{{ __('messages.phone') }}</label>
                    <input type="tel" name="phone" class="form-control" id="phone" value="{{ old('phone') }}">
                    @error('phone')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Experience Years -->
                <div class="mb-3">
                    <label for="experience" class="form-label">{{ __('messages.experience') }}</label>
                    <input type="number" name="experience" class="form-control" id="experience" value="{{ old('experience') }}">
                    @error('experience')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gender -->
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.gender') }}</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }}>
                        <label class="form-check-label" for="male">
                            {{ __('messages.male') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }}>
                        <label class="form-check-label" for="female">
                            {{ __('messages.female') }}
                        </label>
                    </div>
                    @error('gender')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Interests -->
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.interests') }}</label>
                    <div class="btn-group d-flex flex-wrap" role="group" aria-label="Interests">
                        @foreach ($interests as $i)
                            <input type="checkbox" class="btn-check" name="interests[]" id="interest{{ $i->id }}" value="{{ $i->id }}" {{ in_array($i->id, old('interests', [])) ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary me-2 mb-2" for="interest{{ $i->id }}">{{ $i->name }}</label>
                        @endforeach
                    </div>
                    @error('interests')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit and Login Link -->
                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
                    <a href="{{ route('login') }}" class="btn btn-link">{{ __('messages.login') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
