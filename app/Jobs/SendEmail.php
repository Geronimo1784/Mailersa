<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\Correo;
use Illuminate\Support\Facades\DB;

class SendEmail implements ShouldQueue
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
    public function handle(){
        
        $Email = new Correo();
        Mail::to('vitola1784@gmail.com')->send($Email);

        DB::table('mails')->where('estado', 'no enviado')
        ->lazyById()->each(function ($Mail) {
        DB::table('mails')
            ->where('id', $Mail->id)
            ->update(['estado' => 'enviado']);
        });


    }
}
