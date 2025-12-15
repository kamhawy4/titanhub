<?php
// app/Modules/Tasks/Infrastructure/Migrations/2025_12_14_000001_create_tasks_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tasks', function(Blueprint $table){
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('title')->index();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('creator_id')->index();
            $table->unsignedBigInteger('owner_id')->nullable()->index();
            $table->enum('status',['open','in_progress','done','archived'])->default('open')->index();
            $table->tinyInteger('priority')->default(2)->index();
            $table->timestamp('due_at')->nullable()->index();
            $table->json('meta')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down() {
        Schema::dropIfExists('tasks');
    }
};
