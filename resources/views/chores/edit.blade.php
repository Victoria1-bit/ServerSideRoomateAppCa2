@extends('layouts.app')

@section('content')
<div class="page-container">
    <div class="page-header">
        <div>
            <h1>Edit Chore</h1>
            <p>Update the chore details.</p>
        </div>

        <a href="{{ route('chores.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card">
        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form id="editChoreForm" action="{{ route('chores.update', $chore) }}" method="POST" class="form">
            @csrf
            @method('PUT')

            <label for="title">Title</label>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title', $chore->title) }}"
                required
            >

            <label for="assigned_to">Assign To</label>
            <select name="assigned_to" id="assigned_to" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('assigned_to', $chore->assigned_to) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <label for="due_date">Due Date</label>
            <input
                type="date"
                name="due_date"
                id="due_date"
                value="{{ old('due_date', $chore->due_date) }}"
            >

            <label for="photo_description">Photo Description</label>
            <textarea
                name="photo_description"
                id="photo_description"
                rows="4"
            >{{ old('photo_description', $chore->photo_description) }}</textarea>

            <button type="submit" class="btn btn-primary">Update Chore</button>
        </form>
    </div>
</div>
@endsection