@extends('layout');
<form action="{{ route('admin.store') }}" method='post' class='form_create_new'>
    @csrf
    <a href="{{ route('admin.index') }}" class="return">
    </a>
    <p class="title">Create New</p>
    <div class="inputs">
        <div class="input_name input">
            <input type="text" name="name" placeholder="username" class="username">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="input_email input">
            <input type="text" name="email" placeholder="e-mail" class="email">
            @error('email')
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
        <input type="submit" name="submit" value="create">
    </div>
</form>