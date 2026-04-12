<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            if (!Schema::hasColumn('restaurants', 'cuisine')) {
                $table->string('cuisine')->nullable()->after('location');
            }

            if (!Schema::hasColumn('restaurants', 'price_range')) {
                $table->string('price_range')->nullable()->after('cuisine');
            }

            if (!Schema::hasColumn('restaurants', 'rating')) {
                $table->decimal('rating', 3, 1)->nullable()->after('price_range');
            }

            if (!Schema::hasColumn('restaurants', 'opening_hours')) {
                $table->string('opening_hours')->nullable()->after('rating');
            }

            if (!Schema::hasColumn('restaurants', 'phone')) {
                $table->string('phone')->nullable()->after('opening_hours');
            }

            if (!Schema::hasColumn('restaurants', 'website')) {
                $table->string('website')->nullable()->after('phone');
            }

            if (!Schema::hasColumn('restaurants', 'image_url')) {
                $table->string('image_url')->nullable()->after('website');
            }

            if (!Schema::hasColumn('restaurants', 'menu_highlights')) {
                $table->text('menu_highlights')->nullable()->after('image_url');
            }
        });

        if (Schema::hasColumn('restaurants', 'cuisine_type') && Schema::hasColumn('restaurants', 'cuisine')) {
            DB::table('restaurants')
                ->whereNull('cuisine')
                ->update([
                    'cuisine' => DB::raw('cuisine_type'),
                ]);
        }
    }

    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $columns = [
                'cuisine',
                'price_range',
                'rating',
                'opening_hours',
                'phone',
                'website',
                'image_url',
                'menu_highlights',
            ];

            $existingColumns = array_values(array_filter(
                $columns,
                fn (string $column) => Schema::hasColumn('restaurants', $column)
            ));

            if ($existingColumns !== []) {
                $table->dropColumn($existingColumns);
            }
        });
    }
};
