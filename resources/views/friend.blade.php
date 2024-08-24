@extends('layout.master')

@section('friendA', 'active')

@section('content')
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-12">
            <h2>{{ __('messages.friends_list') }}</h2>
            @forelse ($users as $user)
                @if ($user->id != auth()->id())
                    <div class="card mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <a href="{{ route('chat.index', ['recipient_id' => $user->id]) }}" class="text-decoration-none text-dark">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('asset/profile_pic/' . $user->profile_pic) }}" class="img-thumbnail rounded-circle me-3" style="width: 50px; height: 50px;" alt="{{ __('messages.profile_picture_of') }} {{ $user->name }}">
                                    <p class="m-0">{{ $user->name }}</p>
                                </div>
                            </a>
                            <form action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ __('messages.remove_friend') }}</button>
                            </form>
                        </div>
                    </div>
                @endif
            @empty
                <div class="alert alert-info">{{ __('messages.no_friends') }}</div>
            @endforelse
        </div>
    </div>
</div>
@endsection