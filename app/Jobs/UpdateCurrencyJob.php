<?php

namespace App\Jobs;

use App\Models\Currency;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpdateCurrencyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $res = Http::get("https://nationalbank.kz/rss/rates_all.xml");
        if ($res->status() === 200) {
            $xml = simplexml_load_string($res->body());
            $array = json_decode(json_encode($xml), true);

            $currencies = Currency::query()->get();

            foreach ($currencies as $currency) {
                foreach ($array["channel"]["item"] as $item) {
                    if ($currency->code === $item["title"]) {
                        Currency::query()->where("code", $item["title"])
                            ->update(["value" => $item['description']]);
                        Log::info("desc {$item['description']}");
                    }
                }
            }
        }
    }
}
