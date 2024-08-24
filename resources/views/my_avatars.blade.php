@extends('layout.master')

@section('myavatarA', 'active')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">{{ __('messages.bought_avatars') }}</h1>
            <div class="row">
                @forelse ($boughtAvatars as $avatar)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('asset/avatar/' . $avatar->pic) }}" class="card-img-top" alt="{{ $avatar->name }}">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $avatar->name }}</h5>
                                <p class="card-text">${{ number_format($avatar->price, 2) }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>{{ __('messages.no_bought_avatars') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection