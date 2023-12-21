<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->text('body')->nullable();
            $table->string('image')->nullable();
            $table->enum('visibility', ['private', 'public', 'friends']);
            $table->timestamp('published_at')->nullable();
            $table->boolean("is_profile_update")->default(false);
            $table->integer("shared")->default(0);
            $table->unsignedBigInteger("shared_post")->nullable();
            $table->foreign('shared_post')->references('id')->on('posts')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
