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
            $table->string('bar_code')->nullable();
            $table->string('role')->default('patient');

            // Dati Anagrafici
            $table->string('name');
            $table->string('last_name');
            $table->boolean('foreigner')->nullable();
            $table->string('image_profile')->nullable();
            $table->string('cf', 16)->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('country_of_birth')->nullable();
            $table->boolean('sex')->nullable();
            $table->tinyInteger('height')->nullable();
            $table->string('profession')->nullable();
            $table->string('business_name')->nullable();
            $table->string('p_iva', 11)->unique()->nullable();
            $table->string('password');

            // Recapiti
            $table->string('mobile_phone')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('address')->nullable();
            $table->smallInteger('civic')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('cap')->nullable();

            // Stato di salute
            $table->string('allergies')->nullable();
            $table->string('interventions')->nullable();
            $table->string('patologys')->nullable();
            $table->string('medications')->nullable();
            $table->string('disturbance')->nullable();
            $table->boolean('artrosi')->default(false);
            $table->string('placche')->nullable();
            $table->string('diseases')->nullable();
            $table->boolean('covid_vaccine')->default(false);

            // Stile di vita
            $table->boolean('sport')->default(false);
            $table->string('diuresi')->nullable();
            $table->string('diuresi_qta')->nullable();
            $table->boolean('menopause')->default(false);
            $table->boolean('cicle')->default(false);
            $table->boolean('contraceptive')->default(false);
            $table->boolean('smoker')->default(false);
            $table->smallInteger('pregnancy')->nullable();
            $table->string('cellulite')->nullable();
            $table->string('intestine')->nullable();

            // Come ci conosce?
            $table->string('knows')->nullable();

            // Alimentazione
            $table->boolean('alimentation')->default(true);
            $table->text('alimentation_note')->nullable();
            $table->boolean('alimentation_follow')->default(false);
            $table->string('alimentation_since')->nullable();
            $table->string('drenant')->nullable();
            $table->string('integration')->nullable();

            // Tipo Estetica
            $table->boolean('aesthetics')->default(true);

            // Info Varie
            $table->boolean('adipe')->default(false);
            $table->boolean('skin_relax')->default(false);
            $table->boolean('teleangectasia')->default(false);
            $table->string('body_cream')->nullable();
            $table->string('face_cream')->nullable();

            // Pelle
            $table->string('skin')->nullable();
            $table->string('skin_type')->nullable();
            $table->string('skin_blemishes')->nullable();
            $table->string('body_blemishes')->nullable();
            $table->boolean('solar_lamp')->default(false);

            //
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
