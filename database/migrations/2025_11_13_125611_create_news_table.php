<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up (): void
    {
        Schema::create ('news', function (Blueprint $table) {
            $table->id ();
            $table->string ('title');
            $table->string ('slug');
            $table->text ('description')->nullable();
            $table->string ('image')->nullable();
            // image for logo
            $table->string ("image_logo")->nullable();
            $table->string ("title_logo")->nullable();
            // relationship to category
            // $table->foreignIdFor (Category::class)->constrained ()->cascadeOnDelete ()->onDelete ("cascade");
            $table->timestamps ();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down (): void
    {
        Schema::dropIfExists ('news');
    }
};
