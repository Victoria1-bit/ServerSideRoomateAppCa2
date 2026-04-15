<x-app-layout>
    <!-- Wraps the page in the main app layout (navbar, styles, etc.) -->

    <div style="padding: 20px;">
        <!-- Main container for the dashboard -->

        <!-- PAGE TITLE -->
        <h1 style="font-size: 32px; font-weight: bold; margin-bottom: 20px;">
            Dashboard
        </h1>

        <!-- ===================== TOP OVERVIEW SECTION ===================== -->
        <!-- Uses a grid layout to display summary cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 30px;">

            <!-- ----------- CHORE OVERVIEW CARD ----------- -->
            <div style="background: white; border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
                
                <!-- Section title -->
                <h2 style="font-size: 18px; margin-bottom: 10px;">Chore Overview</h2>

                <!-- Total chores count -->
                <p><strong>Total Chores</strong></p>
                <p style="font-size: 28px; margin: 0;">
                    {{ $totalChores ?? 0 }}
                </p>

                <!-- Completed chores -->
                <div style="margin-top: 15px;">
                    <p><strong>Completed</strong></p>
                    <p style="font-size: 24px; margin: 0;">
                        {{ $completedChores ?? 0 }}
                    </p>
                </div>

                <!-- Pending chores -->
                <div style="margin-top: 15px;">
                    <p><strong>Pending</strong></p>
                    <p style="font-size: 24px; margin: 0;">
                        {{ $pendingChores ?? 0 }}
                    </p>
                </div>
            </div>

            <!-- ----------- EXPENSE OVERVIEW CARD ----------- -->
            <div style="background: white; border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
                
                <!-- Section title -->
                <h2 style="font-size: 18px; margin-bottom: 10px;">Expense Overview</h2>

                <!-- Total number of expenses -->
                <p><strong>Total Expenses</strong></p>
                <p style="font-size: 28px; margin: 0;">
                    {{ $totalExpenses ?? 0 }}
                </p>

                <!-- Total money spent -->
                <div style="margin-top: 15px;">
                    <p><strong>Total Spent</strong></p>
                    <p style="font-size: 24px; margin: 0;">
                        €{{ number_format($totalSpent ?? 0, 2) }}
                    </p>
                </div>

                <!-- Paid expenses count -->
                <div style="margin-top: 15px;">
                    <p><strong>Paid Expenses</strong></p>
                    <p style="font-size: 24px; margin: 0;">
                        {{ $paidExpenses ?? 0 }}
                    </p>
                </div>

                <!-- Pending expenses count -->
                <div style="margin-top: 15px;">
                    <p><strong>Pending Expenses</strong></p>
                    <p style="font-size: 24px; margin: 0;">
                        {{ $pendingExpenses ?? 0 }}
                    </p>
                </div>

                <!-- Total paid amount -->
                <div style="margin-top: 15px;">
                    <p><strong>Paid Amount</strong></p>
                    <p style="font-size: 24px; margin: 0;">
                        €{{ number_format($paidAmount ?? 0, 2) }}
                    </p>
                </div>

                <!-- Total pending amount -->
                <div style="margin-top: 15px;">
                    <p><strong>Pending Amount</strong></p>
                    <p style="font-size: 24px; margin: 0;">
                        €{{ number_format($pendingAmount ?? 0, 2) }}
                    </p>
                </div>
            </div>
        </div>

        <!-- ===================== RECENT DATA SECTION ===================== -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px;">

            <!-- ----------- RECENT CHORES ----------- -->
            <div style="background: white; border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
                
                <!-- Title + link -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <h2 style="font-size: 20px; margin: 0;">Recent Chores</h2>
                    <!-- Link to full chore list -->
                    <a href="{{ route('chores.index') }}" style="text-decoration: none; color: #2563eb;">
                        View all →
                    </a>
                </div>

                <!-- Loop through recent chores -->
                @forelse($recentChores ?? [] as $chore)

                    <div style="padding: 12px 0; border-bottom: 1px solid #eee;">
                        <!-- Chore title -->
                        <p style="margin: 0; font-weight: bold;">
                            {{ $chore->title }}
                        </p>

                        <!-- Chore status -->
                        <p style="margin: 5px 0 0 0;">
                            {{ ucfirst($chore->status) }}
                        </p>
                    </div>

                @empty
                    <!-- If no chores exist -->
                    <p>No chores yet.</p>
                @endforelse
            </div>

            <!-- ----------- RECENT EXPENSES ----------- -->
            <div style="background: white; border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
                
                <!-- Title + link -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <h2 style="font-size: 20px; margin: 0;">Recent Expenses</h2>

                    <!-- Link to full expense list -->
                    <a href="{{ route('expenses.index') }}" style="text-decoration: none; color: #2563eb;">
                        View all →
                    </a>
                </div>

                <!-- Loop through expenses -->
                @forelse($recentExpenses ?? [] as $expense)

                    <div style="padding: 12px 0; border-bottom: 1px solid #eee;">
                        <!-- Expense title -->
                        <p style="margin: 0; font-weight: bold;">
                            {{ $expense->title }}
                        </p>

                        <!-- Expense amount -->
                        <p style="margin: 5px 0 0 0;">
                            €{{ number_format($expense->amount, 2) }}
                        </p>
                    </div>

                @empty
                    <!-- If no expenses exist -->
                    <p>No expenses yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>