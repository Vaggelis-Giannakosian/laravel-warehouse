<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('username')->unique();
            $table->string('password');

            $table->string('name');
            $table->string('last_name');
            $table->text('address');
            $table->string('email')->unique();
            $table->integer('registration_date');
            $table->string('status')->default(User::STATUS_ACTIVE);
            $table->boolean('is_admin')->default(false);

            $table->rememberToken();
            $table->timestamps();

            $table->foreignId('country_id')->constrained('countries')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
