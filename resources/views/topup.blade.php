@extends('layout.master')

@section('topupA', 'active')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header">
                    <h3>{{ __('messages.topup_coins') }}</h3>
                </div>
                <div class="card-body">
                    <p>{{ __('messages.current_balance') }}: <strong>{{ auth()->user()->money }}</strong> {{ __('messages.coins') }}</p>
                    <form action="{{ route('coins.topup') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg">{{ __('messages.add_100_coins') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection