@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h3 class="mb-3 text-center">Verify MFA Code</h3>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($errors->has('code'))
            <div class="alert alert-danger">
                {{ $errors->first('code') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verify-mfa') }}">
            @csrf
            <div class="mb-3">
                <label for="mfa_code" class="form-label">MFA Code</label>
                <input type="text" name="mfa_code" id="mfa_code" class="form-control @error('mfa_code') is-invalid @enderror" required autofocus>
                @error('mfa_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Verify</button>
        </form>

        <p class="mt-3 text-center text-muted">Check your email for the MFA code.</p>
    </div>
</div>
@endsection
