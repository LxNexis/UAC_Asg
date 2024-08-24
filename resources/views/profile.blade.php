@extends('layout.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">{{ __('messages.profile') }}</div>
                <div class="card-body text-center">
                    <!-- Profile Picture on Top -->
                    <div class="mb-3">
                        @if (auth()->user()->visibility == 1)
                            <img src="{{ asset('asset/bear_pic/' . auth()->user()->bear_pic) }}" alt="{{ __('messages.profile_picture') }}" class="img-thumbnail mb-3" style="width: 150px;">
                        @else
                            <img src="{{ asset('asset/profile_pic/' . auth()->user()->profile_pic) }}" alt="{{ __('messages.profile_picture') }}" class="img-thumbnail mb-3" style="width: 150px;">
                        @endif
                    </div>

                    <!-- User Details -->
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('messages.name') }}</strong></label>
                        <p>{{ auth()->user()->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('messages.email') }}</strong></label>
                        <p>{{ auth()->user()->email }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('messages.phone') }}</strong></label>
                        <p>{{ auth()->user()->phone }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('messages.gender') }}</strong></label>
                        <p>{{ auth()->user()->gender == 1 ? __('messages.male') : __('messages.female') }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('messages.linkedin') }}</strong></label>
                        <p><a href="{{ auth()->user()->linkedin }}">{{ auth()->user()->linkedin }}</a></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('messages.work_years') }}</strong></label>
                        <p>{{ auth()->user()->work_years }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('messages.money') }}</strong></label>
                        <p>${{ number_format(auth()->user()->money, 2) }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('messages.register_fee') }}</strong></label>
                        <p>${{ number_format(auth()->user()->registerFee, 2) }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('messages.payment_status') }}</strong></label>
                        <p>{{ auth()->user()->hasPaid ? __('messages.paid') : __('messages.not_paid') }}</p>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <!-- Settings Section -->
                    <div class="mb-4">
                        <h5>{{ __('messages.settings') }}</h5>
                        <div class="mb-3">
                        @if(auth()->user()->visibility == 0)
                            <form action="{{ route('profile.hide') }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button type="submit" class="btn btn-warning">{{ __('messages.hide_profile') }}</button>
                            </form>
                        @else
                            <form action="{{ route('profile.unhide') }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button type="submit" class="btn btn-success">{{ __('messages.unhide_profile') }}</button>
                            </form>
                        @endif
                        </div>
                        @if(session('error'))
                            <div class="alert alert-danger mt-3">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>

                    <!-- Logout Button -->
                    <form action="{{ route('user.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">{{ __('messages.logout') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection