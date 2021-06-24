<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class LoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref_no', 50)->default('1000');
            
            //$table->bigIncrements('ref_no')->default('1000');
            //$table->tinyInteger('ref_no')->default('1');

            
            $table->unsignedBigInteger('loan_type_id');
            $table->unsignedBigInteger('loan_plan_id');
            $table->unsignedBigInteger('borrower_id');
            $table->double('amount', 20, 2);
            $table->text('purpose', 65535);
            $table->string('status', 50);            
            $table->date('date_released');
            $table->timestamps();

            //$table->primary( array( 'id', 'ref_no' ) );

            $table->foreign('loan_type_id')->references('id')->on('loan_types')->onDelete('cascade');
            $table->foreign('loan_plan_id')->references('id')->on('loan_plans')->onDelete('cascade');
            $table->foreign('borrower_id')->references('id')->on('borrowers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
