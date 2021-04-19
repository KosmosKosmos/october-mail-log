<?php namespace SureSoftware\MailLog\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class AddBackendUserToLogTable extends Migration
{
    public function up()
    {
        Schema::table('suresoftware_maillog_log', function (Blueprint $table) {
            $table->unsignedInteger('backend_user_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('suresoftware_maillog_log', function (Blueprint $table){
            if (Schema::hasColumn('suresoftware_maillog_log', 'backend_user_id')) {
                $table->dropColumn('backend_user_id');
            }
        });
    }
}
