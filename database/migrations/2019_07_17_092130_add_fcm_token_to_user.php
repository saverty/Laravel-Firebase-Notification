<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFcmTokenToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach(config('firebase-notification.tables') as $t){
            if(Schema::hasTable($t)){
                if (!Schema::hasColumn($t, 'fcm_token')){
                    Schema::table($t, function (Blueprint $table) {
                        $table->string('fcm_token')->nullable();
                    });
                }
            }
        }
    }
}
