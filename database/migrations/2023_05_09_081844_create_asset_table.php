<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset', function (Blueprint $table) {
            $table->id();
            $table->unsignedbiginteger('asset_type_id');
            $table->unsignedbiginteger('asset_model_id');
            $table->string('asset_configuration', 255)->nullable();
            $table->string('asset_sn_number', 255)->nullable();
            $table->text('tagging_code')->nullable();
            $table->unsignedbiginteger('vendor_id');
            $table->unsignedbiginteger('asset_transactions_id');
            $table->unsignedbiginteger('manufacturer_id');
            $table->date('servicing_date')->nullable();
            $table->string('remarks', 255)->nullable();
            $table->string('cb', 255)->nullable();
            $table->timestamp('cd')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('ub', 255)->nullable();
            $table->timestamp('ud')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('asset_type_id')->references('id')->on('asset_type');
            $table->foreign('asset_model_id')->references('id')->on('asset_model');
            $table->foreign('vendor_id')->references('id')->on('vendor');
            $table->foreign('asset_transactions_id')->references('id')->on('asset_transactions');
            $table->foreign('manufacturer_id')->references('id')->on('manufacturer');
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset');
    }
}