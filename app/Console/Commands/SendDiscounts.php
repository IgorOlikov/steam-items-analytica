<?php

namespace App\Console\Commands;

use App\Mail\Discounts;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;

class SendDiscounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-discounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отправляет письма пользователям с информацией о скидках';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::whereNotNull('email_verified_at')->chunk(200, function (Collection $users) {
            foreach ($users as $user) {
                Mail::to($user->email)->send(new Discounts($user));
            }
        });




    }
}
