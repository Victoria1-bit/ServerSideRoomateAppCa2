public function up(): void
{
    Schema::create('chores', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->foreignId('assigned_to')->constrained('users')->onDelete('cascade');
        $table->foreignId('assigned_by')->constrained('users')->onDelete('cascade');
        $table->string('status')->default('pending');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('chores');
}