<x-app-layout>
    <div class="choice-page">
        <div class="choice-card">
            <div class="choice-header">
                <div class="choice-icon">🏠</div>
                <h1>Welcome, {{ auth()->user()->name }}</h1>
                <p>Before using the app, choose how you want to enter the house system.</p>
            </div>

            <div class="choice-grid">
                <form action="{{ route('choose.housekeeper') }}" method="POST" class="choice-option">
                    @csrf
                    <div class="option-icon">🧹</div>
                    <h2>Become a HouseKeeper</h2>
                    <p>Create one house, manage members, create chores, and track expenses.</p>
                    <button type="submit">Continue as HouseKeeper</button>
                </form>

                <form action="{{ route('choose.member') }}" method="POST" class="choice-option">
                    @csrf
                    <div class="option-icon">👥</div>
                    <h2>Join as House Member</h2>
                    <p>Enter an invite code from your HouseKeeper and join their house.</p>
                    <button type="submit">Join a House</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .choice-page {
            min-height: calc(100vh - 90px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px;
        }

        .choice-card {
            width: 100%;
            max-width: 1050px;
            background: white;
            border: 1px solid #dbe7df;
            border-radius: 28px;
            padding: 34px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        }

        .choice-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .choice-icon {
            font-size: 52px;
            margin-bottom: 12px;
        }

        .choice-header h1 {
            margin: 0;
            font-size: 34px;
            font-weight: 900;
            color: #14382b;
        }

        .choice-header p {
            margin: 8px auto 0;
            color: #64748b;
            max-width: 560px;
        }

        .choice-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 22px;
        }

        .choice-option {
            border: 1px solid #dbe7df;
            border-radius: 22px;
            padding: 28px;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .option-icon {
            font-size: 42px;
        }

        .choice-option h2 {
            margin: 0;
            color: #14382b;
            font-size: 24px;
            font-weight: 900;
        }

        .choice-option p {
            color: #64748b;
            line-height: 1.6;
            margin: 0 0 10px;
        }

        .choice-option button {
            margin-top: auto;
            background: #14382b;
            color: white;
            border: none;
            border-radius: 14px;
            padding: 12px 16px;
            font-weight: 800;
            cursor: pointer;
        }

        @media (max-width: 800px) {
            .choice-grid {
                grid-template-columns: 1fr;
            }

            .choice-card {
                padding: 22px;
            }
        }
    </style>
</x-app-layout>
