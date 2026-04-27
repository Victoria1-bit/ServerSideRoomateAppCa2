@extends('layouts.app')

@section('content')
<div class="page-container">
    <div class="page-header">
        <div>
            <h1>Chores</h1>
            <p>Manage roommate tasks and responsibilities.</p>
        </div>

        @if(auth()->user()->isAdmin())
            <a href="{{ route('chores.create') }}" class="btn btn-primary">+ Create Chore</a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid">
        @forelse($chores as $chore)
            <div class="card chore-card">
                <div class="card-top">
                    <h2>{{ $chore->title }}</h2>

                    <span class="badge {{ $chore->status === 'completed' ? 'badge-success' : 'badge-warning' }}">
                        {{ ucfirst($chore->status) }}
                    </span>
                </div>

                <p><strong>Due:</strong> {{ $chore->due_date ?? 'No due date' }}</p>
                <p><strong>Assigned to:</strong> {{ $chore->assignedUser->name ?? 'N/A' }}</p>
                <p><strong>Assigned by:</strong> {{ $chore->assignedByUser->name ?? 'N/A' }}</p>

                @if($chore->photo_description)
                    <p class="description">
                        <strong>Photo Description:</strong><br>
                        {{ $chore->photo_description }}
                    </p>
                @endif

                <div class="actions">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('chores.edit', $chore) }}" class="btn btn-small btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('chores.destroy', $chore) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-small btn-danger"
                                onclick="return confirm('Delete this chore?')"
                            >
                                Delete
                            </button>
                        </form>
                    @endif

                    @if($chore->status !== 'completed')
                        <form action="{{ route('chores.complete', $chore) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="btn btn-small btn-success">
                                Mark Complete
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="card">
                <p>No chores found.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection