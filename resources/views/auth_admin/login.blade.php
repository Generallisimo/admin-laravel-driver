@extends('admin.layouts')
@section('title', 'login')
@section('content')

<div class="d-flex justify-content-center mt-auto mb-auto">
  <div class="card" style="margin-top:250px">
    <div class="card-body">
    <form class="mx-auto" method="POST" action="{{ route('login') }}">
        @csrf
    <div class="mb-3">
    <label for="phone" class="form-label">{{ __('Phone') }}</label>
    <input id="phone" class="form-control" type="text" name="phone" value="{{ old('phone') }}" required autofocus autocomplete="phone">
    @if($errors->has('phone'))
        <p class="mt-2 text-sm text-red-600">{{ $errors->first('phone') }}</p>
    @endif
    </div>

    <div class="mb-3">
    <label for="password" class="form-label">{{ __('Password') }}</label>
    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
    </div>
    <button type="submit" class="btn btn-primary">{{ __('Log in') }}</button>

  </form>
</div>
</div>
</div>


@endsection