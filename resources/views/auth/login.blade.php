@extends('layouts.app')

@section('content')
<div class="container">
    <div style="margin:auto;max-width:330px;padding:15px">
        <h1 class="text-center mb-3">Metaforum</h1>
        {{ Form::open(['route' => 'login']) }}
            <div class="form-group">
                {{ Form::text('email', null, ['class' => 'form-control rounded-pill '.($errors->has('email') ? 'is-invalid' : ''), 'placeholder' => 'Username or E-Mail']) }}
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                {{ Form::password('password', ['class' => 'form-control rounded-pill '.($errors->has('password') ? 'is-invalid' : ''), 'placeholder' => 'Password']) }}
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                {{ Form::submit('LOG IN', ['class' => 'btn btn-primary rounded-pill', 'style' => 'width:100%']) }}
            </div>

            @if (Route::has('password.request'))
                <div class="form-group text-center">
                    <a href="{{ route('password.request') }}" type="button" class="text-dark">Forgot your password?</a>
                </div>
            @endif
        {{ Form::close() }}
    </div>
</div>
@endsection
