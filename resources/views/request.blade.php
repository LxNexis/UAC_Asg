@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 p-3">
            <h3>Pending Friend Request</h3>
            @forelse ($usersGo as $user)
                <div class="d-flex justify-content-between">
                    <p>{{ $user->name }}</p>
                    Pending
                </div>
            @empty
                There's no pending friend request at the moment
            @endforelse
        </div>
        <div class="col-6 p-3">
            <h3>Incoming Friend Request</h3>
            @forelse ($usersCome as $user)
                <div class="d-flex justify-content-between">
                    <p>{{ $user->name }}</p>
                    <form action="{{ route('friend.request', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Accept</button>
                    </form>
                </div>
            @empty
                There's no incoming friend request at the moment
            @endforelse
        </div>
    </div>
</div>
@endsection