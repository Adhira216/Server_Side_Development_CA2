<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('food_list_restaurant')) {
            Schema::create('food_list_restaurant', function (Blueprint $table) {
                $table->id();
                $table->foreignId('food_list_id')->constrained('food_lists')->cascadeOnDelete();
                $table->foreignId('restaurant_id')->constrained()->cascadeOnDelete();
                $table->timestamps();
                $table->unique(['food_list_id', 'restaurant_id']);
            });
        }

        if (Schema::hasTable('list_restaurant')) {
            $existingLinks = DB::table('list_restaurant')
                ->select('list_id', 'restaurant_id', 'created_at', 'updated_at')
                ->get();

            foreach ($existingLinks as $link) {
                DB::table('food_list_restaurant')->updateOrInsert(
                    [
                        'food_list_id' => $link->list_id,
                        'restaurant_id' => $link->restaurant_id,
                    ],
                    [
                        'created_at' => $link->created_at ?? now(),
                        'updated_at' => $link->updated_at ?? now(),
                    ]
                );
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('food_list_restaurant');
    }
};
