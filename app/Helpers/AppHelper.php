<?php
namespace App\Helpers;

use App\Models\AgentBooking;
use App\Models\Booking;
use App\Models\CleaningPrice;
use App\Models\PaypalAccount;
use App\Models\SiteSetting;
use App\Models\Subscriptions;
use App\Models\User;
use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Cache;


class AppHelper
{

    public static function stripe_publich_key()
    {
        $siteSettings = 'pk_test_51O7I8oAZ0UHvqN9MrghpSQQtLwiu1AocMEVJH061wgBwcE1PF8k8OAKBMEJ5uTePqwalQBlkm8zekhkOofvGbv5o00ttwEIoIf';
        return $siteSettings;
    }

    public static function stripe_secret_key()
    {
        $siteSettings = 'sk_test_51O7I8oAZ0UHvqN9MsTAG6scrpai9LHnMqbqkm5dWDPBhyXClu5czpLazeNizUNrLPmwR40C2lpnKawjuMggi3uJ600wkuFVuvy';
        return $siteSettings;
    }

    public static function booking_status($status) {
        $color = '';
        $text = '';
        if($status == 1) {
            $text = 'Confirmed';
            $color = 'text-success';
            $bgColor = 'bg-light-success';
        } else if($status == 2) {
            $text = 'Process';
            $color = 'text-info';
            $bgColor = 'bg-light-info';
        } else if($status == 3) {
            $text = 'Rejected';
            $color = 'text-danger';
            $bgColor = 'bg-light-danger';
        } else if($status == 4) {
            $text = 'Started';
            $color = 'text-primary-color';
            $bgColor = 'bg-light-primary';
        }else if($status == 5) {
            $text = 'Completed';
            $color = 'text-success';
            $bgColor = 'bg-light-success';
        } else {
            $text = 'Pending';
            $color = 'text-warning';
            $bgColor = 'bg-light-warning';
        }
        return array($bgColor,$color,$text);
    }

    public static function booking_payment_status($status) {
        $color = '';
        $text = '';
        $bgColor= '';
        if($status == 1) {
            $text = 'Paid';
            $color = 'text-success';
            $bgColor = 'bg-light-success';

        } else {
            $text = 'Unpaid';
            $color = 'text-warning';
            $bgColor = 'bg-light-warning';
        }
        return array($bgColor,$color,$text);
    }

    public static function site_name() {
        return 'Real Estate';
    }

    public static function userDetail($id) {
        return User::find($id);
    }

    public static function bookingDetail($id) {
        return Booking::find($id);
    }

   public static function agentBookingDetail($id) {
        return AgentBooking::find($id);
    }

    public static function subscriptionDetail($id) {
        return Subscriptions::find($id);
    }

    public static function appCurrencySign(): string
    {
        return '€';
    }

    public static function appCurrencyCode(): string
    {
      return 'eur';
    }

    public static function stored_prices() {
        $keysWithDescriptions = AppHelper::booking_keys_array();
        $keys = array_keys($keysWithDescriptions);
        $basePrice = 10.00; // Starting price
        foreach ($keys as $key) {
            CleaningPrice::create([
                'key' => $key,
                'price' => $basePrice,
            ]);

            $basePrice += 10.00;
        }
    }

}
