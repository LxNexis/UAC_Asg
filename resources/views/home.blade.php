@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($users as $userId => $userGroup)
            <div class="col-3">
                <!-- <h2>{{ $userGroup->first()->name }}</h2>
                @foreach ($userGroup as $user)
                    <p>{{ $user->interest_name }}</p>
                @endforeach -->
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('asset/profile_pic/' . $userGroup->first()->profile_pic) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $userGroup->first()->name }}</h5>
                        @foreach ($userGroup as $user)
                            <p>{{ $user->interest_name }}</p>
                        @endforeach
                        <form action="{{ route('friend.request', ['id' => $userGroup->first()->id]) }}" method="POST">
                            @csrf
                            <button type="submit" style="border: none; background: transparent; cursor: pointer;">
                                <i class="fas fa-thumbs-up"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection