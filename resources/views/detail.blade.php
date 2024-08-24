@extends('layout.master')

@section('homeA', 'active')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ __('messages.user_details') }}</h5>
                </div>
                <div class="card-body">
                    <!-- Profile Picture -->
                    <div class="text-center mb-4">
                        <img src="{{ asset('asset/profile_pic/' . $user->profile_pic) }}" class="img-thumbnail rounded-circle" style="width: 150px; height: 150px;" alt="{{ __('messages.profile_picture_of', ['name' => $user->name]) }}">
                    </div>
                    
                    <!-- User Details -->
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('messages.name') }}:</strong></label>
                        <p>{{ $user->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('messages.email') }}:</strong></label>
                        <p>{{ $user->email }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('messages.phone') }}:</strong></label>
                        <p>{{ $user->phone }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('messages.gender') }}:</strong></label>
                        <p>{{ $user->gender == 1 ? __('messages.male') : __('messages.female') }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('messages.linkedin') }}:</strong></label>
                        <p><a href="{{ $user->linkedin }}" target="_blank">{{ $user->linkedin }}</a></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('messages.work_years') }}:</strong></label>
                        <p>{{ $user->work_years }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('messages.money') }}:</strong></label>
                        <p>${{ number_format($user->money, 2) }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('messages.register_fee') }}:</strong></label>
                        <p>${{ number_format($user->registerFee, 2) }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>{{ __('messages.payment_status') }}:</strong></label>
                        <p>{{ $user->hasPaid ? __('messages.paid') : __('messages.not_paid') }}</p>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('home.index') }}" class="btn btn-secondary">{{ __('messages.back_to_list') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection