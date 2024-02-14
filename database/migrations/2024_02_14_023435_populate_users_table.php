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
        $password = bcrypt('123');

        $users = [
            ['name' => 'Juan', 'email' => 'juan@example.com', 'password' => $password],
            ['name' => 'María', 'email' => 'maria@example.com', 'password' => $password],
            ['name' => 'Pedro', 'email' => 'pedro@example.com', 'password' => $password],
            ['name' => 'Luis', 'email' => 'luis@example.com', 'password' => $password],
            ['name' => 'Ana', 'email' => 'ana@example.com', 'password' => $password],
        ];

        DB::table('users')->insert($users);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')->whereIn('email', ['juan@example.com', 'maria@example.com', 'pedro@example.com', 'luis@example.com', 'ana@example.com'])->delete();
    }
};
