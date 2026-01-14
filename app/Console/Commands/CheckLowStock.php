<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\User;
use App\Mail\LowStockAlert;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckLowStock extends Command
{
    protected $signature = 'stock:check-low';
    protected $description = 'Check for low stock products and send email alerts';

    public function handle()
    {
        $lowStockProducts = Product::lowStock()->with('supplier')->get();

        if ($lowStockProducts->isEmpty()) {
            $this->info('No low stock products found.');
            return 0;
        }

        // Send email to admins
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new LowStockAlert($lowStockProducts));
        }

        $this->info('Low stock alert sent to ' . $admins->count() . ' admin(s).');
        return 0;
    }
}