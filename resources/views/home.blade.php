@extends('layouts.app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.5/push.js"></script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                   <posts :groups="{{ $groups }}" :user="{{ auth()->user() }}" :user_notifications="{{ auth()->user()->notifications }}" />

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
