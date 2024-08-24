@extends('layout.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ __('messages.chat') }}</h5>
                </div>
                <div class="card-body" style="overflow-y: auto; max-height: 400px;">
                    <ul class="list-group">
                        @foreach($messages as $message)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div>
                                    <strong>{{ $message->user->name }}:</strong> {{ $message->content }}
                                </div>
                                <small class="text-muted">{{ $message->created_at->format('H:i') }}</small>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer">
                    <form action="{{ route('chat.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="recipient_id" value="{{ $recipient_id }}">
                        <div class="input-group">
                            <input type="text" name="message" class="form-control" placeholder="{{ __('messages.type_a_message') }}" required>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">{{ __('messages.send') }}</button>
                            </div>
                        </div>
                        @error('message')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
