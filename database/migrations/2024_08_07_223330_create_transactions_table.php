<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('customer_name', 150);
            $table->unsignedBigInteger('identification_documents_id')->index();
            $table->text('description');
            $table->string('value');
            $table->unsignedBigInteger('statuses_id')->index();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('payment_methods_id')->index();
            $table->string('payment_date', 30);
            $table->float('total_percentage');
            $table->string('status_transaction', 40);
            $table->tinyInteger('active')->default(true);
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
        Schema::dropIfExists('transactions');
    }
}
