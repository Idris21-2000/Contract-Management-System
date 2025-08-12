<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_id')->unique();
            $table->string('counterpart_name');
            $table->text('counsel_comment');
            $table->string('attach_file_path');
            $table->foreignId('contract_type_id')->constrained('contract_types');
            $table->foreignId('assignees_id')->constrained('users');
            $table->integer('period_of_contract');
            $table->date('signing_date');
            $table->date('renewal_date');
            $table->foreignId('cost_id')->constrained('costs');
            $table->foreignId('payment_mode_id')->constrained('payment_modes');
            $table->foreignId('payment_type_id')->constrained('payment_types');
            $table->enum('implementation_mode', ['Support On Call', 'Onsite IT Support']);
            $table->enum('status', ['Open', 'Closed', 'Extended', 'Terminated', 'Overdue']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
