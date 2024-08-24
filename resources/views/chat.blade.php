@extends('layout.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Chat</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($messages as $message)
                            <li class="list-group-item">
                                <strong>{{ $message->user->name }}:</strong> {{ $message->content }}
                                <span class="float-right">{{ $message->created_at->format('H:i') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer">
                    <form action="{{ route('chat.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="recipient_id" value="{{ $recipient_id }}">
                        <div class="input-group">
                            <input type="text" name="message" class="form-control" placeholder="Type a message...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Send</button>
                            </div>
                        </div>
                        @error('message')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
