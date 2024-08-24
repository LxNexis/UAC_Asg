@extends('layout.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-warning mb-4">
                <h4 class="alert-heading">{{ __('messages.overpayment_notice') }}</h4>
                <p>{{ __('messages.sorry_you_have_overpaid') }} <strong>{{ $diff }}</strong> {{ __('messages.would_you_like_to_reenter_or_convert') }}</p>
            </div>
            
            <div class="d-flex justify-content-around mt-4">
                <!-- Form to handle overpayment -->
                <form action="{{ route('pay.handleOverpay', ['diff' => $diff]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-success">{{ __('messages.yes') }}</button>
                </form>

                <!-- Link to return to payment page -->
                <a href="{{ route('pay.show') }}" class="btn btn-danger">{{ __('messages.no') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
