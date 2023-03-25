@extends('layout.app_without_login')
@section('title','Register')
@section('container')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="card-body text-center">
            <h2><strong>Register</strong></h2>

            <form method="POST" id="register-form" action="{{ route('auth.register.submit') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-9 d-block mx-auto">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name">
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name">
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Email" name="email" id="email">
                        </div>

                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="input-group">
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Phone number" name="phone_number" id="phone_number">
                        </div>
                        <div class="input-group">
                            <input type="file" accept="image/*" placeholder="Email" name="profile_pic" id="profile_pic">
                        </div>
                        <div class="input-group">
                            <select class="form-control select2 hobbies" name="hobbies[]" multiple id="hobbies">
                                <option value=""></option>
                                <option value="1">Singing</option>
                                <option value="2">Sports</option>
                                <option value="3">Gaming</option>
                                <option value="4">Surfing</option>
                                <option value="5">Music</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn  btn-secondary btn-block px-4">
                            Register
                        </button>
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
{!! JsValidator::formRequest('App\Http\Requests\Auth\RegisterRequest','#register-form') !!}
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select Hobbies",
            allowClear: true
        });
    });
</script>
@endpush