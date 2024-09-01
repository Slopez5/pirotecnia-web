<?php

namespace App\Jobs;

use App\Models\Inventory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateInventory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $event;
    /**
     * Create a new job instance.
     */
    public function __construct($event)
    {
        //
        $this->event = $event;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        Inventory::updateQuantityProducts($this->event);
    }
}
