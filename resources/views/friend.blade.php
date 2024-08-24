@extends('layout.master')

@section('content')
<div class="container">
    <div class="row m-3">
        <div class="col-12">
            @forelse ($users as $user)
                @if ($user->id != auth()->id())
                    <a href="{{ route('chat.index', ['recipient_id' => $user->id]) }}">
                        <div class="d-flex justify-content-between">
                            <p>{{ $user->name }}</p>
                            <button class="btn btn-primary">Remove Friend</button>
                        </div>
                    </a>
                @endif
            @empty
                <h3>There's no friend currentlyf</h3>
            @endforelse
        </div>
    </div>
</div>
@endsection