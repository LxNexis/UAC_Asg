@extends('layout.master')

@section('requestA', 'active')

@section('content')
<div class="container">
    <div class="row">
        <!-- Pending Friend Requests -->
        <div class="col-md-6 p-3">
            <div class="border p-3 rounded shadow-sm">
                <h3 class="mb-3">{{ __('messages.pending_friend_requests') }}</h3>
                @forelse ($usersGo as $user)
                    <div class="d-flex justify-content-between align-items-center mb-2 p-2 border-bottom">
                        <p class="mb-0">{{ $user->name }}</p>
                        <span class="badge bg-secondary">{{ __('messages.pending') }}</span>
                    </div>
                @empty
                    <p>{{ __('messages.no_pending_requests') }}</p>
                @endforelse
            </div>
        </div>

        <!-- Incoming Friend Requests -->
        <div class="col-md-6 p-3">
            <div class="border p-3 rounded shadow-sm">
                <h3 class="mb-3">{{ __('messages.incoming_friend_requests') }}</h3>
                @forelse ($usersCome as $user)
                    <div class="d-flex justify-content-between align-items-center mb-2 p-2 border-bottom">
                        <p class="mb-0">{{ $user->name }}</p>
                        <form action="{{ route('friend.request', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">{{ __('messages.accept') }}</button>
                        </form>
                    </div>
                @empty
                    <p>{{ __('messages.no_incoming_requests') }}</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection