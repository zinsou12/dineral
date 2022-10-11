<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('noms');
            $table->string('sexe', 25);
            $table->string('tel', 25);
            $table->string('pays', 50);
            $table->float('gains')->default(0);
            $table->string('login', 30);
            $table->string('mdp');
            $table->float('vente_mensuelle')->default(0);
            $table->float('gains_vente')->default(0);
            $table->integer('niveau_actuel')->default(1);
            $table->float('investissement')->default(0);            
            $table->timestamp('email_verified_at')->nullable();            
            $table->rememberToken();          
            $table->timestamps();
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
};
