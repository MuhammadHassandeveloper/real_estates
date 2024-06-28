<?php
namespace App\Helpers;

use App\Models\ActivityReport;
use App\Models\AgentBooking;
use App\Models\Booking;
use App\Models\City;
use App\Models\CleaningPrice;
use App\Models\PaypalAccount;
use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\PropertyImage;
use App\Models\PropertyType;
use App\Models\SiteSetting;
use App\Models\State;
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

    public static function country_status($status) {
        $color = '';
        $text = '';
        $bgColor= '';
        if($status == 1) {
            $text = 'Active';
            $color = 'text-success';
            $bgColor = 'bg-success-subtle';

        } else {
            $text = 'Inactive';
            $color = 'text-warning';
            $bgColor = 'bg-warning-subtle';
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

   public static function adminEmail() {
        return 'muhammadhassan5075729@gmail.com';
    }

    public static function userDetail($id) {
        return User::find($id);
    }

    public static function agencyAgents($id) {
        return User::where('agency_id', $id)
            ->whereHas('country', function ($query) {
                $query->where('status', 1);
            })
            ->whereNotNull('photo')
            ->whereNotNull('city_id')
            ->whereNotNull('state_id')
            ->latest()
            ->with(['city', 'state', 'country'])
            ->get();
    }

    public static function tenNonFeaturedProerties() {
        return Property::where('is_featured', 0)
            ->whereHas('country', function ($query) {
                $query->where('status', 1);
            })
            ->latest()
            ->limit(10)
            ->inRandomOrder()
            ->get();
    }

    public static function tenFeaturedProerties() {
        return Property::where('is_featured', 1)
            ->whereHas('country', function ($query) {
                $query->where('status', 1);
            })
            ->latest()
            ->limit(10)
            ->inRandomOrder()
            ->get();
    }


    public static function propertyDetail($id) {
        return Property::find($id);
    }

    public static function cityProperties() {
        return Property::whereHas('country', function ($query) {
            $query->where('status', 1);
        })
            ->select('city_id', DB::raw('count(*) as property_count'))
            ->groupBy('city_id')
            ->orderBy('property_count', 'desc')
            ->limit(8)
            ->get();
    }


    public static function allFeaturedProperties() {

    }

    public static function agentProperties($id) {
        return Property::where('agent_id', $id)
            ->whereHas('country', function ($query) {
                $query->where('status', 1);
            })
            ->get();
    }

    public static function agentRentProperties($id) {
        return Property::where('agent_id', $id)
            ->where('property_category', 'Rent')
            ->whereHas('country', function ($query) {
                $query->where('status', 1);
            })
            ->get();
    }

    public static function agentSaleProperties($id) {
        return Property::where('agent_id', $id)
            ->where('property_category', 'Sale')
            ->whereHas('country', function ($query) {
                $query->where('status', 1);
            })
            ->get();
    }

    public static function agencyProperties($id) {
        return Property::where('agency_id', $id)
            ->whereHas('country', function ($query) {
                $query->where('status', 1);
            })
            ->get();
    }


    public static function agencyRentProperties($id) {
        return Property::where('agency_id', $id)
            ->where('property_category', 'Rent')
            ->whereHas('country', function ($query) {
                $query->where('status', 1);
            })
            ->get();
    }

    public static function agencySaleProperties($id) {
        return Property::where('agency_id', $id)
            ->where('property_category', 'Sale')
            ->whereHas('country', function ($query) {
                $query->where('status', 1);
            })
            ->get();
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

    public static function propertyType($id)
    {
        return PropertyType::find($id);
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


    public static function agents() {
        return User::whereHas('roles', function($query) {
            $query->where('roles.slug', 'agent');
        })
            ->whereHas('country', function ($query) {
                $query->where('status', 1);
            })
            ->whereNotNull('photo')
            ->whereNotNull('city_id')
            ->whereNotNull('state_id')
            ->latest()
            ->with(['city', 'state', 'country'])
            ->paginate(12);
    }

    public static function latestAgents() {
        return User::whereHas('roles', function($query) {
            $query->where('slug', 'agent');
        })
            ->whereHas('country', function ($query) {
                $query->where('status', 1);
            })
            ->whereNotNull('photo')
            ->whereNotNull('city_id')
            ->whereNotNull('state_id')
            ->whereNotNull('whatsapp_phone')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->with(['city', 'state', 'country'])
            ->get();
    }

    public static function agencies() {
        return User::whereHas('roles', function($query) {
            $query->where('slug', 'agency');
        })
            ->whereHas('country', function ($query) {
                $query->where('status', 1);
            })
            ->whereNotNull('agency_logo')
            ->whereNotNull('city_id')
            ->whereNotNull('state_id')
            ->latest()
            ->with(['city', 'state', 'country'])
            ->paginate(12);
    }

    public static function latestAgencies() {
        return User::whereHas('roles', function($query) {
            $query->where('slug', 'agency');
        })
            ->whereHas('country', function ($query) {
                $query->where('status', 1);
            })
            ->whereNotNull('agency_logo')
            ->whereNotNull('city_id')
            ->whereNotNull('state_id')
            ->whereNotNull('whatsapp_phone')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->with(['city', 'state', 'country'])
            ->get();
    }

    public  static function SingleFeaturedProperty() {
        return Property::where('is_featured',1)->inRandomOrder()->first();
    }

    public static function RandomFeaturedProperties($count = 5) {
        return Property::where('is_featured', 1)->inRandomOrder()->take($count)->get();
    }

    public static function propertImages($id) {
        return PropertyImage::where('property_id', $id)->get();
    }

    public static function checkAgentProfileCompletion($id)
    {
        $user = User::find($id);
        $missingFields = [];

        if (empty($user->city)) {
            $missingFields[] = 'city';
        }
        if (empty($user->state)) {
            $missingFields[] = 'state';
        }
        if (empty($user->photo)) {
            $missingFields[] = 'photo';
        }
        if (empty($user->bio)) {
            $missingFields[] = 'bio';
        }
        if (empty($user->whatsapp_phone)) {
            $missingFields[] = 'whatsapp_phone';
        }
        return $missingFields;
    }

    public static function checkAgencyProfileCompletion($id)
    {
        $user = User::find($id);
        $missingFields = [];

        if (empty($user->city)) {
            $missingFields[] = 'city';
        }
        if (empty($user->state)) {
            $missingFields[] = 'state';
        }
        if (empty($user->agency_logo)) {
            $missingFields[] = 'agency_logo';
        }
        if (empty($user->bio)) {
            $missingFields[] = 'bio';
        }
        if (empty($user->whatsapp_phone)) {
            $missingFields[] = 'whatsapp_phone';
        }
        return $missingFields;
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

    public  static function stateCities($state_id){
        return City::whereHas('state', function ($query) use ($state_id) {
            $query->where('id', $state_id)
                ->whereHas('country', function ($query) {
                    $query->where('status', 1);
                });
        })->with('state')->get();
    }

    public static function countries() {

       return Country::where('status', 1)
           ->get();
    }

    public static function state($state_id) {
        return State::with('country')->find($state_id);
    }

    public static function stateCountry($country_id) {
        return Country::find($country_id);
    }

    public static function states() {
        return State::whereHas('country', function ($query) {
            $query->where('status', 1);
        })->get();
    }

    public static function cities() {
        return City::whereHas('state.country', function ($query) {
            $query->where('status', 1);
        })
//            ->with('state','country')
            ->get();
    }

    public static function CustometFavoriteproperties($customer_id) {
       return Property::join('favourite_properties', 'properties.id', '=', 'favourite_properties.property_id')
            ->where('favourite_properties.user_id', $customer_id)
            ->select('properties.*')
            ->latest()
           ->limit(5)
            ->get();
    }

    public static function CustometerAllFavoriteproperties($customer_id) {
        return Property::join('favourite_properties', 'properties.id', '=', 'favourite_properties.property_id')
            ->where('favourite_properties.user_id', $customer_id)
            ->select('properties.*')
            ->get();
    }

}
