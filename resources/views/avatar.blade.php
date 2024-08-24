@extends('layout.master')

@section('shopA', 'active')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">{{ __('messages.avatar_shop') }}</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                @foreach ($avatars as $avatar)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('asset/avatar/' . $avatar->pic) }}" class="card-img-top" alt="{{ $avatar->name }}">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $avatar->name }}</h5>
                                <p class="card-text">${{ number_format($avatar->price, 2) }}</p>
                                <form action="{{ route('avatar.buy') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $avatar->id }}">
                                    <button type="submit" class="btn btn-primary">{{ __('messages.buy_avatar') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection