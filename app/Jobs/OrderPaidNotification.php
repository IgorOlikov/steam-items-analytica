<?php

namespace App\Jobs;

use App\Mail\OrderPaid;
use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class OrderPaidNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly User $user,
        private readonly Order $order
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Mail::to($this->user->email)
            ->send(new OrderPaid(
                $this->user,
                $this->order
            ));
    }

}
