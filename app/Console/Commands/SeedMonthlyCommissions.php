<?PHP

// app/Console/Commands/SeedMonthlyCommissions.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AffiliateSale;
use App\Models\Commission;
use Carbon\Carbon;

class SeedMonthlyCommissions extends Command
{
    protected $signature = 'commissions:seed {--month=}';
    protected $description = 'Create pending Commission records for last month’s sales';

    public function handle()
    {
        $month = $this->option('month')
            ? Carbon::createFromFormat('Y-m', $this->option('month'))
            : Carbon::now()->subMonth();

        $start = $month->copy()->startOfMonth();
        $end   = $month->copy()->endOfMonth();
        $due   = $end; // or adjust as your policy

        $sales = AffiliateSale::whereBetween('created_at', [$start, $end])
                    ->where('refunded', false)
                    ->get();

        foreach ($sales as $sale) {
            Commission::firstOrCreate([
                'affiliate_sale_id' => $sale->id,
            ], [
                'affiliate_id' => $sale->referrer_id,
                'amount'       => $sale->commission,
                'due_date'     => $due,
            ]);
        }

        $this->info("Commission records seeded for {$month->format('F Y')}");
    }
}
