@extends('layouts.app')

@section('content')
<div class="page-container">
    <div class="page-header">
        <div>
            <h1>Create Household</h1>
            <p>Create a household and share the code with roommates.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="card">
        <form method="POST" action="{{ route('households.store') }}" class="form">
            @csrf

            <label for="name">Household Name</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                placeholder="e.g. Victoria House"
            >

            <button type="submit" class="btn btn-primary">
                Create Household Code
            </button>
        </form>
    </div>
</div>
@endsection