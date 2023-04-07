@extends('layouts.app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.5/push.js"></script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('To Do List') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <to_do_list :groups_to_do_list="{{ $groups_to_do_list }}" :user_to_do_list="{{ $user_to_do_list }}" :user="{{ auth()->user() }}" />


                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection