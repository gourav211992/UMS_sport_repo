<?php

namespace App\Jobs;

use App\Mail\Alert;
use App\Models\user;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
//use Mail;

class TrackingEmailFrequency implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public $user;
	public $alias;

	public function __construct($user, $alias) {

		$this->user = $user;
		$this->alias = $alias;
		
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle() {

		$email = new Alert($this->user, $this->alias);
		$to = isset($this->user['email']) && !empty($this->user['email']) ? $this->user['email'] : 'demo@staqo.com';
		$mail = Mail::to($to);
        return $mail = $mail->send($email);
		
	}

	
}
