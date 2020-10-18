<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Client;

class AlterToClientTypeClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('document')->unique()->change();
            $table->date('dateBirth')->nullable()->change();
            \DB::statement("ALTER TABLE clients CHANGE COLUMN gender gender CHAR(10) NULL");
            $maritalStatus = array_keys(Client::MARITAL_STATUS);
            $maritalStatusString = array_map(function ($value) {
                return "'$value'";
            }, $maritalStatus);
            $maritalStatusEnum = implode(',', $maritalStatusString);
            \DB::statement("ALTER TABLE clients CHANGE COLUMN maritalStatus maritalStatus ENUM($maritalStatusEnum) NULL");
            $table->string('companyName')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropUnique('clients_document_unique');
            $table->date('dateBirth')->change();
            \DB::statement('ALTER TABLE clients CHANGE COLUMN gender gender CHAR(10) NULL');
            $maritalStatus = array_keys(Client::MARITAL_STATUS);
            $maritalStatusString = array_map(function ($value) {
                return "'$value'";
            }, $maritalStatus);
            $maritalStatusEnum = implode(',', $maritalStatusString);
            \DB::statement("ALTER TABLE clients CHANGE COLUMN maritalStatus maritalStatus ENUM($maritalStatusEnum) NOT NULL");
            $table->dropColumn('companyName');
        });
    }
}
