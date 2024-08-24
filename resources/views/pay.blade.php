@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>You need to pay {{ auth()->user()->registerFee }} to register</h3>
            <form action="{{ route('pay.process') }}" method="POST">
                @method('PUT')
                @csrf
                <label for="money" class="form-label">Enter Price</label>
                <input type="tel" name="money" class="form-control" id="money">
                @error('money')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <button type="submit" class="btn btn-primary">Pay</button>
            </form>
        </div>
    </div>
</div>
@endsection