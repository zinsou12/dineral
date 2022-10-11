<?php

use App\Models\Niveau;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('niveaux', function (Blueprint $table) {
            $table->id();
            $table->string('libeller', 15);
            $table->timestamps();
        });
for($i=1; $i<=7; $i++)
{
    Niveau::create([
        'libeller'=>'niveau'.$i,
    ]);
}

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('niveaux');
    }
};
