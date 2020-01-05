@extends('layouts.app')

@section('content')
<div class="container">
    <div style="margin:auto;max-width:330px;padding:15px">
        <h1 class="text-center mb-3">Metaforum</h1>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        {{ Form::open(['route' => 'password.email']) }}
            <div class="form-group">
                {{ Form::email('email', null, ['class' => 'form-control rounded-pill '.($errors->has('email') ? 'is-invalid' : ''), 'placeholder' => 'E-mail']) }}
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {{ Form::submit('Send Password Reset Link', ['class' => 'btn btn-primary rounded-pill', 'style' => 'width:100%']) }}
            </div>

            <div class="form-group text-center text-dark">
                <a href="{{ route('login') }}" type="button" class="text-dark"><i class="fa fa-arrow-left"></i> Back to Login</a>
            </div>
        {{ Form::close() }}
    </div>
</div>
@endsection