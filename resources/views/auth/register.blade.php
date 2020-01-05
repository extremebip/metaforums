@extends('layouts.app')

@section('content')
<div class="container">
    <div style="margin:auto;max-width:330px;padding:15px">
        <h1 class="text-center mb-3">Metaforums</h1>
        {{ Form::open(['route' => 'register']) }}
            <div class="form-group">
                {{ Form::email('email', null, ['class' => 'form-control rounded-pill '.($errors->has('email') ? 'is-invalid' : '') , 'placeholder' => 'E-mail']) }}
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong> {{ $message }} </strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {{ Form::text('username', null, ['class' => 'form-control rounded-pill '.($errors->has('username') ? 'is-invalid' : '') , 'placeholder' => 'Username']) }}
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong> {{ $message }} </strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {{ Form::password('password', ['class' => 'form-control rounded-pill '.($errors->has('password') ? 'is-invalid' : '') , 'placeholder' => 'Password']) }}
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong> {{ $message }} </strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {{ Form::password('password_confirmation', ['class' => 'form-control rounded-pill' , 'placeholder' => 'Confirm Password']) }}
            </div>
            
            <div class="form-group">
                {{ Form::submit('SIGN UP', ['class' => 'btn btn-primary rounded-pill', 'style' => 'width:100%']) }}
            </div>
        {{ Form::close() }}
    </div> 
</div>
@endsection