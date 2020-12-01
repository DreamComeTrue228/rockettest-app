<?php

namespace App\Jobs;

use App\Models\PaymentHistory;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PaymentHistoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $data;

    /**
     * Create a new job instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        PaymentHistory::query()->create([
            "product_id" => $this->data["productId"],
            "amount" => $this->data["amount"],
            "currency" => $this->data["currency"],
            "description" => $this->data["description"],
            "payed_at" => $this->data['time']
        ]);

        $product = Product::query()->find($this->data["productId"]);
        if ($product->quantity > 0) {
            Product::query()->decrement("quantity");
        }
        Log::info($this->data);
    }
}
