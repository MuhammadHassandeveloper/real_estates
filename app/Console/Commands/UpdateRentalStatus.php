<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PropertyRental;
use Carbon\Carbon;

class UpdateRentalStatus extends Command
{
    protected $signature = 'rental:update-status';
    protected $description = 'Update rental status and payment status if end date has passed';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $currentDate = Carbon::now();

        PropertyRental::where('end_date', '<', $currentDate)
            ->where('status', '!=', 2)
            ->update(['status' => 2, 'payment_status' => 2]);

        $this->info('Rental statuses updated successfully.');
    }
}

