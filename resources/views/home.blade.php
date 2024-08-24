@extends('layout.master')

@section('content')
<div class="container mt-5">
    <!-- Flash Messages -->
    @if (session('friend_request'))
        <div class="alert alert-info">
            {{ __('messages.friend_request') }}
        </div>
    @endif

    @if (session('unread_messages'))
        <div class="alert alert-warning">
            {{ __('messages.unread_messages') }}
        </div>
    @endif

    <!-- Search and Filter Form -->
    <form action="{{ route('home.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4 mb-3">
                <input type="text" name="search" class="form-control" placeholder="{{ __('messages.search_placeholder') }}" value="{{ request('search') }}">
            </div>
            <div class="col-md-4 mb-3">
                <input type="text" name="interest" class="form-control" id="interest" placeholder="{{ __('messages.interest_placeholder') }}" value="{{ request('interest') }}">
            </div>
            <div class="col-md-4 mb-3">
                <select name="gender" class="form-control">
                    <option value="">{{ __('messages.select_gender') }}</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>{{ __('messages.male') }}</option>
                    <option value="0" {{ request('gender') == '0' ? 'selected' : '' }}>{{ __('messages.female') }}</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('messages.search_filter_button') }}</button>
    </form>

    <!-- Users List -->
    <div class="row">
        @foreach ($users as $userId => $userGroup)
            <div class="col-md-3 mb-4">
                <div class="card">
                <form action="{{ route('friend.detail', ['id' => $userGroup->first()->id]) }}" method="POST">
                    @csrf
                    <button type="submit" style="border: none; background: none; padding: 0;">
                        <img src="{{ asset('asset/profile_pic/' . $userGroup->first()->profile_pic) }}" class="card-img-top" alt="{{ __('messages.profile_picture') }}" style="cursor: pointer;">
                    </button>
                </form>
                    <div class="card-body">
                        <h5 class="card-title">{{ $userGroup->first()->name }}</h5>
                        @foreach ($userGroup as $user)
                            <p class="card-text"><small class="text-muted">{{ $user->interest_name }}</small></p>
                        @endforeach
                        <form action="{{ route('friend.request', ['id' => $userGroup->first()->id]) }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-thumbs-up"></i> {{ __('messages.add_friend') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection