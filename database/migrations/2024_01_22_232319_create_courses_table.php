<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('subcategory_id')->constrained('subcategories')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('course_image')->nullable();
            $table->text('course_title')->nullable();
            $table->text('course_name')->nullable();
            $table->string('course_name_slug')->nullable();            
            $table->text('prerequisites')->nullable();
            

            $table->longText('description')->nullable();
            $table->string('video')->nullable();
            $table->string('level')->nullable();
            $table->string('duration')->nullable();
            $table->string('resources')->nullable();
            $table->string('certificate')->nullable();

            $table->decimal('selling_price', 8, 2)->nullable();
            $table->decimal('discount_price', 8, 2)->nullable();
            $table->timestamp('discount_expiry_date');
            
            $table->string('bestseller')->nullable();
            $table->string('featured')->nullable();
            $table->string('highestrated')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=Inactive','1=Active'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
