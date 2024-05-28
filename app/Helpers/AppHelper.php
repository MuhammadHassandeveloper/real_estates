<?php
namespace App\Helpers;

use App\Models\ActivityReport;
use App\Models\AgentBooking;
use App\Models\Booking;
use App\Models\CleaningPrice;
use App\Models\PaypalAccount;
use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\PropertyType;
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

    public static function property_status($status) {
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

    public static function property_payment_status($status) {
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
        return User::find($id)->first();
    }

    public static function propertyDetail($id) {
        return Property::find($id)->first();
    }

   public static function agentProperties($id) {
        return Property::where('agent_id',$id)->get();
    }
    public static function agentPropertiescount($id) {
        return Property::where('agent_id',$id)->count();
    }

    public static function customerProperties($id) {
        return Property::where('user_id',$id)->get();
    }


    public static function appCurrencySign(): string
    {
        return '$';
    }

    public static function appCurrencyCode(): string
    {
      return 'eur';
    }

    public static function featureDetail($id)
    {
      return PropertyFeature::find($id)->first();
    }

    public static function propertyType($id)
    {
        return PropertyType::find($id)->first();
    }

    public static function agency($id)
    {
        return User::where('id',$id)->first();
    }

    public static function property_category($status) {
        if($status == 'Rent') {
            $text = 'For Rent';
            $color = 'text-info';
            $bgColor = 'bg-info-subtle';

        } else {
            $text = 'For Sale';
            $color = 'text-danger';
            $bgColor = 'bg-danger-subtle';
        }
        return array($bgColor,$color,$text);
    }

    public static function roleName($userId) {
        $roleName = DB::table('role_users')
            ->join('roles', 'role_users.role_id', '=', 'roles.id')
            ->where('role_users.user_id', $userId)
            ->select('roles.name')
            ->first();
        return $roleName ? $roleName->name : null;
    }

    public static function storeActivity($heading, $detail, $color, $uid, $type, $system_id,$role)
    {
        $store = ActivityReport::create([
            'user_id' => $uid,
            'system_id' => $system_id,
            'heading' => $heading,
            'content' => $detail,
            'color' => $color,
            'type' => $type,
            'role' => $role,
        ]);
        return $store;
    }

}
