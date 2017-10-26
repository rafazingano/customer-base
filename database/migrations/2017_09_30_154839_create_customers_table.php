<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('status')->nullable();
            $table->string('code')->nullable();
            $table->timestamp('data')->nullable();            
            $table->string('nivel')->nullable();
            //$table->string('canal')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('ie')->nullable();
            $table->string('razao_social')->nullable();
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('uf')->nullable();
            $table->string('cep')->nullable();
            //$table->string('promotor')->nullable();
            //$table->string('kit')->nullable();
            //$table->string('represvendedor')->nullable();
            $table->string('localizador')->nullable();
            $table->string('qt')->nullable();
            $table->string('roteiro')->nullable();
            $table->string('previsao')->nullable();
            //$table->string('telefone')->nullable();
            $table->text('desconformidade')->nullable();
            $table->text('feedback')->nullable();
            $table->boolean('concluido')->default(0);
            $table->timestamp('concluido_data')->nullable();
            $table->string('recebido_por')->nullable();
            $table->string('loja')->nullable();
            $table->string('contato')->nullable();
            $table->string('fone_1')->nullable();
            $table->string('fone_2')->nullable();
            $table->string('email')->nullable();
            $table->string('distancia')->nullable();
            $table->timestamp('data_2')->nullable();
            
            $table->integer('kit_id')->unsigned()->nullable();            
            $table->foreign('kit_id')
                    ->references('id')
                    ->on('kits')
                    ->onDelete('cascade');

            $table->integer('promoter_id')->unsigned();            
            $table->foreign('promoter_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->integer('representative_id')->unsigned()->nullable();            
            $table->foreign('representative_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->integer('campaign_id')->unsigned();            
            $table->foreign('campaign_id')
                    ->references('id')
                    ->on('campaigns')
                    ->onDelete('cascade');

            $table->integer('status_id')->unsigned();            
            $table->foreign('status_id')
                    ->references('id')
                    ->on('statuses')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('customers');
    }
}
