@extends('layout.app_without_login')
@section('title','Login')
@section('container')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="card-body text-center">
            <h2><strong>Login</strong></h2>
            <h4>Sign In to your account</h4>
            <form method="POST" id="login-form" action="{{ route('auth.login.submit') }}">
                @csrf
                <div class="row">
                    <div class="col-9 d-block mx-auto">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="UserName" name="username" id="username">
                        </div>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn  btn-secondary btn-block px-4">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

@endsection

@push('custom-styles')

@endpush
@push('custom-scripts')
{!! JsValidator::formRequest('App\Http\Requests\Auth\LoginRequest','#login-form') !!}
@endpush