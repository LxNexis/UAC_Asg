@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>Sorry, you overpaid {{ $diff }}. Would you like to reenter the balance or convert the excess to your money?</h3>
            <div class="btng mx-auto">
                <form action="{{ route('pay.handleOverpay', ['diff' => $diff]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-primary">Yes</button>
                </form>
                <a href="{{ route('pay.show') }}">
                    <button class="btn btn-primary">No</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection