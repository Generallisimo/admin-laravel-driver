<!-- @extends('admin.layouts')
@section('title', 'driver')
@section('content')

<form method="POST" action="{{ route('login') }}">
@csrf
<label for="email" class="block font-medium text-sm text-gray-700">{{ __('Email') }}</label>
<input id="email" class="block mt-1 w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
@error('email')
<span class="text-sm text-red-600">{{ $message }}</span>
@enderror
<label for="password">Password</label>
<input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
@error('password')
    <span class="text-red-600">{{ $message }}</span>
@enderror
<button type="submit" class="ml-3">
    {{ __('Log in') }}
</button>

</form>

@endsection -->