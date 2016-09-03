# Stripe + Laravle Cashier (L 5.2)

Stripe is the best way to accept payments online and in mobile apps. We handle billions of dollars every year for forward-thinking businesses around the world.


### Installation (Laravel Cashier)
### Composer

First, add the Cashier package for Stripe to your composer.json file and run the composer update command:

```sh
"laravel/cashier": "~6.0"
```
### Service Provider
Next, register the Laravel\Cashier\CashierServiceProvider service provider in your app configuration file.

```sh
Laravel\Cashier\CashierServiceProvider::class,
```

### Database Migrations
Before using Cashier, we'll also need to prepare the database. We need to add several columns to your users table and create a new subscriptions table to hold all of our customer's subscriptions:

```sh
Schema::table('users', function ($table) {
    $table->string('stripe_id')->nullable();
    $table->string('card_brand')->nullable();
    $table->string('card_last_four')->nullable();
    $table->timestamp('trial_ends_at')->nullable();
});

Schema::create('subscriptions', function ($table) {
    $table->increments('id');
    $table->integer('user_id');
    $table->string('name');
    $table->string('stripe_id');
    $table->string('stripe_plan');
    $table->integer('quantity');
    $table->timestamp('trial_ends_at')->nullable();
    $table->timestamp('ends_at')->nullable();
    $table->timestamps();
});
```

Once the migrations have been created, simply run the migrate Artisan command.


### Model Setup

Next, add the Billable trait to your model definition:

```sh
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Billable;
}
```

### Provider Keys
Next, you should configure your Stripe key in your services.php configuration file:
```sh
'stripe' => [
    'model'  => App\User::class,
    'secret' => env('STRIPE_SECRET'),
],
```
### Installation Stripe

### composer
First, add the udaykumar77/stripe package to your composer.json file and run the composer update command:

```sh
"udaykumar77/stripe": "v1.0"
```
### Service Provider
Next, register the UdayKumar77\Stripe\StripeServiceProvider service provider in your app configuration file.
```sh
UdayKumar77\Stripe\StripeServiceProvider::class,
```

### Facade
Next, register the UdayKumar77\Stripe\Facade\StripeController facade in your
app configuration file aliases.

```sh
'Stripe' => UdayKumar77\Stripe\Facade\StripeController::class,
```
### Command
Run the following command from your terminal.

```sh
composer dump-autoload
```

### Register your stripe account

- Go to Account Settings -> API Keys
- Add the Secret & Publishable keys in your .env file

### .env
Add the following in your .env file

```sh
STRIPE_SECRET=**************************
STRIPE_PUBLISHABLE_SECRET=*********************
```
### Methods
- To generate Stripe Token
```sh
Stripe::generateCardToken(array $params)

$params = ["number"     => "4242424242424242",
            "exp_month" => "9",
            "exp_year"  => "2017",
            "cvc"       => "456"]
```

### Usage
use the name space in your controller like this

```sh
<?php
namespace App\Http\Controllers\Stripe;
use Stripe;

public function generateToken() {
        $stripeToken = Stripe::generateCardToken(
                               ["number"    => "4242424242424242",
                                "exp_month" => "9",
                                "exp_year"  => "2017",
                                "cvc"       => "456"]);
        return response()->json($stripeToken);
    }
```
License
----

MIT License (MIT)
@ Uday Kumar Gudivada
