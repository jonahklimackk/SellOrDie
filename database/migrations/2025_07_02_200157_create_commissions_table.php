<?PHP

// database/migrations/2025_07_02_000000_create_commissions_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsTable extends Migration
{
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('affiliate_sale_id')
                  ->constrained('affiliate_sales')
                  ->cascadeOnDelete();
            $table->foreignId('affiliate_id')
                  ->constrained('users');        // the referrer
            $table->decimal('amount', 10, 2);   // commission earned
            $table->enum('status', ['pending','paid'])
                  ->default('pending');
            $table->date('due_date');           // e.g. last day of the sale month
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('commissions');
    }
}
