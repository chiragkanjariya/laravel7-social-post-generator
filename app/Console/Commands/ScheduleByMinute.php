<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Scheduler;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class ScheduleByMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:minute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification and mail to all users at their schedule time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now()->format('Y-m-d H:i');
        $schedulers = Scheduler::where('schedule', '>', $now)->get();
        foreach ($schedulers as $one) {
            $schedule = Carbon::parse($one->schedule)->format('Y-m-d H:i');
            // if ($now === $schedule) {
                $email = $one->user->email;
                $email = 'user@localhost.com';
                Mail::send('mails.notification', [], function($message) use ($email)
                {    
                    // $message->from('levantapp1@gmail.com', 'Alert')
                    //     ->to($email)
                    //     ->subject('Alert');

                    $message->from('root@localhost.com', 'Alert')
                        ->to($email)
                        ->subject('Alert');
                });
            // }
        }
    }
}
