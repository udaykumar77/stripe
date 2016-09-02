<?php
namespace UdayKumar77\Stripe;

use Illuminate\Http\Request;
use App\Http\Requests;
use Exception;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Stripe\Token as StripeToken;
use Stripe\Stripe;
use App\User;

class StripeController extends Controller
{
	protected $request;

	public function __construct(Request $request, User $user) {
		$this->request = $request;
		$this->user    = $user;
	}

	//-------------------------------------------------------------------------

    public function generateCardToken(array $params)
    {
        $apiKey = Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $stripeToken = StripeToken::create([
                    "card"      => [
                    "number"    => $params['number'],
                    "exp_month" => $params['exp_month'],
                    "exp_year"  => $params['exp_year'],
                    "cvc"       => $params['cvc']
                  ]
                ]);

            return $stripeToken;
        }
        catch (Exception $e) {
            return $e->getMessage();
        }
    }

}