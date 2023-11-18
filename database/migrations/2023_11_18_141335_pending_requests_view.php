<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Staudenmeir\LaravelMergedRelations\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::createMergeView(
            'pending_requests_view',
            [(new User())->pendingFriendsFrom(), (new User())->pendingFriendsTo()]
        );
    }

    public function down(): void
    {
        //
    }

};
