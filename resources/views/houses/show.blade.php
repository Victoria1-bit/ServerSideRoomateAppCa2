<x-app-layout>
    <div class="house-page">
        @if(session('success'))
            <div class="house-alert success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="house-alert error">{{ session('error') }}</div>
        @endif

        <div class="house-hero">
            <div>
                <span class="house-pill">Current House</span>
                <h1>{{ $house->name }}</h1>
                <p>Led by {{ $house->housekeeper->name ?? 'Unknown' }} (HouseKeeper)</p>
            </div>

            <div class="invite-code-box">
                <span>Invite Code</span>
                <strong>{{ $house->invite_code }}</strong>
                <small>Share this manually with members.</small>
            </div>
        </div>

        <div class="house-grid">
            <div class="house-panel">
                <div class="panel-top">
                    <h2>Members</h2>
                    <span>{{ $house->members->count() }} total</span>
                </div>

                @foreach($house->members as $member)
                    <div class="member-row">
                        <div class="member-left">
                            @if($member->profile_photo)
                                <img src="{{ asset('storage/' . $member->profile_photo) }}" alt="Profile">
                            @else
                                <div class="member-avatar">{{ strtoupper(substr($member->name, 0, 1)) }}</div>
                            @endif

                            <div>
                                <strong>{{ $member->name }}</strong>
                                <p>{{ $member->email }}</p>
                            </div>
                        </div>

                        <div class="member-actions">
                            <span class="member-role">
                                {{ $member->role === 'admin' ? 'HouseKeeper' : 'Member' }}
                            </span>

                            @if(auth()->user()->role === 'admin' && $member->id !== auth()->id())
                                <form action="{{ route('house.member.remove', $member->id) }}" method="POST" onsubmit="return confirm('Remove this member from the house?');">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit">Remove</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="house-panel">
                <div class="panel-top">
                    <h2>Invite Members</h2>
                </div>

                @if(auth()->user()->role === 'admin')
                    <form action="{{ route('house.invite') }}" method="POST" class="invite-form">
                        @csrf
                        <label>Optional local email</label>
                        <input type="email" name="email" placeholder="student@roommate.test">

                        <button type="submit">Save Invite Note</button>
                    </form>

                    <div class="demo-box">
                        <h3>School Demo Flow</h3>
                        <p>Since this app runs locally, users join by entering this invite code:</p>
                        <strong>{{ $house->invite_code }}</strong>
                    </div>
                @else
                    <div class="demo-box">
                        <h3>You are a house member</h3>
                        <p>You can view chores and expenses assigned to this house.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .house-page {
            max-width: 1300px;
            margin: 0 auto;
            padding: 32px;
        }

        .house-alert {
            padding: 13px 16px;
            border-radius: 14px;
            margin-bottom: 18px;
            font-weight: 800;
        }

        .house-alert.success {
            background: #dcfce7;
            color: #166534;
        }

        .house-alert.error {
            background: #fee2e2;
            color: #991b1b;
        }

        .house-hero {
            background: linear-gradient(135deg, #14382b, #166534);
            color: white;
            border-radius: 28px;
            padding: 32px;
            display: flex;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 26px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.16);
        }

        .house-pill {
            display: inline-flex;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            padding: 7px 12px;
            border-radius: 999px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .house-hero h1 {
            margin: 0;
            font-size: 38px;
            font-weight: 900;
        }

        .house-hero p {
            margin: 8px 0 0;
            color: #dcfce7;
        }

        .invite-code-box {
            min-width: 260px;
            background: white;
            color: #14382b;
            border-radius: 22px;
            padding: 20px;
        }

        .invite-code-box span,
        .invite-code-box small {
            display: block;
            color: #64748b;
            font-weight: 700;
        }

        .invite-code-box strong {
            display: block;
            font-size: 30px;
            margin: 6px 0;
            letter-spacing: 2px;
        }

        .house-grid {
            display: grid;
            grid-template-columns: 1.4fr 0.8fr;
            gap: 24px;
        }

        .house-panel {
            background: white;
            border: 1px solid #dbe7df;
            border-radius: 24px;
            padding: 26px;
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.06);
        }

        .panel-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .panel-top h2 {
            margin: 0;
            font-size: 22px;
            color: #14382b;
            font-weight: 900;
        }

        .panel-top span {
            color: #64748b;
            font-weight: 800;
        }

        .member-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 15px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .member-row:last-child {
            border-bottom: none;
        }

        .member-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .member-left img,
        .member-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
        }

        .member-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #14382b;
            color: white;
            font-weight: 900;
        }

        .member-left strong {
            color: #14382b;
        }

        .member-left p {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .member-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .member-role {
            background: #dcfce7;
            color: #166534;
            padding: 7px 11px;
            border-radius: 999px;
            font-weight: 800;
            font-size: 12px;
        }

        .member-actions button,
        .invite-form button {
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 8px 12px;
            font-weight: 800;
            cursor: pointer;
        }

        .invite-form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .invite-form label {
            color: #14382b;
            font-weight: 800;
        }

        .invite-form input {
            border: 1px solid #d1d5db;
            border-radius: 12px;
            padding: 11px 13px;
        }

        .invite-form button {
            background: #14382b;
        }

        .demo-box {
            margin-top: 18px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            padding: 18px;
        }

        .demo-box h3 {
            margin: 0 0 8px;
            color: #14382b;
            font-weight: 900;
        }

        .demo-box p {
            color: #64748b;
            margin: 0 0 10px;
        }

        .demo-box strong {
            color: #14382b;
            font-size: 22px;
            letter-spacing: 1px;
        }

        @media (max-width: 900px) {
            .house-hero,
            .member-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .house-grid {
                grid-template-columns: 1fr;
            }

            .invite-code-box {
                width: 100%;
                min-width: unset;
            }

            .house-page {
                padding: 18px;
            }
        }
    </style>
</x-app-layout>
