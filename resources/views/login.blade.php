<@extends('layout');
@section('form')
<form action="{{ route('admin.login_crud') }}" method='GET' class='form_login'>
    @csrf
    <p class="title">Login</p>
    <div class="inputs">
        <div class="input_name input">
            <input type="text" name="name" placeholder="username" class="username">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="input_password  input">
            <input type="password" name="password" placeholder="password">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="submit">
        <input type="submit" name="submit" value="login">
        <p>Dont't have an account? <a href="{{ route('admin.create') }}">Register</a></p>
    </div>
</form>
@endsection
