@extends('backend.layouts.master')

@section('content')
<div class="container text-center mt-5">
    <h1 class="display-1">500</h1>
    <h3>Something went wrong!</h3>
    <p>We are working to fix the issue. Please try again later.</p>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mt-3">Go Home</a>
</div>
@endsection
