<?php

use App\Enums\OauthTokenTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('oauth_tokens', function (Blueprint $table) {
            $table->id();
            $table->enum('token_type' , [OauthTokenTypeEnum::GOOGLE_API->value]);
            $table->text('access_token');
            $table->text('refresh_token');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oauth_tokens');
    }
};
