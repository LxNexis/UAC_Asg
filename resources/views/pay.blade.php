@extends('layout.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-info mb-4">
                <h4 class="alert-heading">{{ __('messages.payment_required') }}</h4>
                <p>{{ __('messages.you_need_to_pay') }} <strong>{{ auth()->user()->registerFee }}</strong> {{ __('messages.to_register') }}</p>
            </div>
            
            <form action="{{ route('pay.process') }}" method="POST">
                @method('PUT')
                @csrf
                
                <!-- Amount Input -->
                <div class="mb-3">
                    <label for="money" class="form-label">{{ __('messages.enter_amount') }}</label>
                    <input type="tel" name="money" class="form-control" id="money" placeholder="{{ __('messages.enter_amount_in_your_currency') }}" value="{{ old('money') }}">
                    @error('money')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">{{ __('messages.pay') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
