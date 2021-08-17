@extends('layouts.app')

@section('content')

<div class="container mt-5">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-12">
                    @include('partials.alerts')
                </div>
            </div>
            <div class="card">
                <div class="card-header text-center">{{ __('web.login') }}</div>

                <div class="card-body align-items-center py-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                      
                        <div class="form-group row justify-content-center align-items-center">
                            <div class="col-md-6">
                                <label for="username">{{ __('web.username') }}</label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-center align-items-center">
                            <div class="col-6">
                                <label for="password">{{ __('web.password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center align-items-center">
                            <div class="col-12 text-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('web.remember') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center align-items-center">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('web.login') }}
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('web.forgot') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
