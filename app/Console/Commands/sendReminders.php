<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Cart;
use Mail;
use App\Mail\sendReminder;
use Carbon\Carbon;
use Log;

class sendReminders extends command {
    protected $signature = 'webshop:sendReminders';

    protected $description = 'Sends reminders to carts that havent been finished';

    public function _construct() {
        parent::__construct();
    }
    public function handle() {
		$cartLines = Cart::all();
		foreach($cartLines as $cartLine) {
			if($cartLine->created_at > Carbon::now()->addMinutes(-32) && $cartLine->created_at < Carbon::now()->addMinutes(-15)) {
				if(!empty($cartLine->user_id)) {
					$user = User::find($cartLine->user_id);
					Mail::to($user->email)->send(new sendReminder);
				}
			}
		}
    }
}
