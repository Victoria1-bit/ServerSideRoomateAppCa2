<x-app-layout>
    <div class="chores-page">
        <div class="chores-header">
            <div>
                <h1>Chores</h1>
                <p>Manage assigned chores, descriptions, pictures, and completion status.</p>
            </div>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('chores.create') }}" class="chores-create-btn">+ Create Chore</a>
            @endif
        </div>

        @if(session('success'))
            <div class="chores-alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="chores-grid">
            @forelse($chores as $chore)
                <div class="chore-card">
                    @if($chore->image_path)
                        <img src="{{ asset('storage/' . $chore->image_path) }}" alt="Chore image" class="chore-image">
                    @endif

                    <div class="chore-content">
                        <div class="chore-top">
                            <div>
                                <h3>{{ $chore->title }}</h3>

                                @if($chore->description)
                                    <p class="chore-description">{{ $chore->description }}</p>
                                @endif
                            </div>

                            <span class="chore-badge {{ $chore->status === 'completed' ? 'done' : 'pending' }}">
                                {{ ucfirst($chore->status) }}
                            </span>
                        </div>

                        <div class="chore-meta">
                            <div>
                                <span>Assigned to</span>
                                <strong>{{ $chore->assignedUser->name ?? 'N/A' }}</strong>
                            </div>

                            <div>
                                <span>Assigned by</span>
                                <strong>{{ $chore->assignedByUser->name ?? 'N/A' }}</strong>
                            </div>
                        </div>

                        <div class="chore-actions">
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('chores.edit', $chore) }}" class="chore-btn edit">Edit</a>
                            @endif

                            @if($chore->status !== 'completed')
                                <form action="{{ route('chores.complete', $chore) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="chore-btn complete">Mark Complete</button>
                                </form>
                            @endif

                            @if(auth()->user()->role === 'admin')
                                <form action="{{ route('chores.destroy', $chore) }}" method="POST" onsubmit="return confirm('Delete this chore?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="chore-btn delete">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-chores">No chores found.</div>
            @endforelse
        </div>
    </div>

    <style>
        .chores-page {
            max-width: 1400px;
            margin: 0 auto;
            padding: 32px;
        }

        .chores-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 24px;
        }

        .chores-header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 800;
            color: #14382b;
        }

        .chores-header p {
            margin: 6px 0 0;
            color: #64748b;
        }

        .chores-create-btn {
            background: #14382b;
            color: white;
            padding: 11px 16px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
        }

        .chores-alert {
            margin-bottom: 18px;
            padding: 12px 16px;
            background: #dcfce7;
            color: #166534;
            border-radius: 12px;
            font-weight: 700;
        }

        .chores-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .chore-card {
            background: white;
            border: 1px solid #dbe7df;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.06);
        }

        .chore-image {
            width: 100%;
            height: 230px;
            object-fit: cover;
            display: block;
        }

        .chore-content {
            padding: 24px;
        }

        .chore-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 18px;
            margin-bottom: 18px;
        }

        .chore-top h3 {
            margin: 0;
            font-size: 22px;
            font-weight: 800;
            color: #14382b;
        }

        .chore-description {
            margin: 8px 0 0;
            color: #64748b;
            line-height: 1.5;
        }

        .chore-badge {
            padding: 7px 13px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 800;
            white-space: nowrap;
        }

        .chore-badge.done {
            background: #dcfce7;
            color: #166534;
        }

        .chore-badge.pending {
            background: #ffedd5;
            color: #9a3412;
        }

        .chore-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 20px;
        }

        .chore-meta div {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 14px;
        }

        .chore-meta span {
            display: block;
            color: #64748b;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .chore-meta strong {
            color: #14382b;
        }

        .chore-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .chore-btn {
            border: none;
            border-radius: 10px;
            padding: 9px 13px;
            color: white;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            display: inline-flex;
        }

        .chore-btn.edit {
            background: #f59e0b;
        }

        .chore-btn.complete {
            background: #16a34a;
        }

        .chore-btn.delete {
            background: #dc2626;
        }

        .empty-chores {
            background: white;
            border-radius: 18px;
            padding: 24px;
            color: #64748b;
        }

        @media (max-width: 900px) {
            .chores-grid {
                grid-template-columns: 1fr;
            }

            .chores-page {
                padding: 18px;
            }

            .chores-header {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</x-app-layout>
