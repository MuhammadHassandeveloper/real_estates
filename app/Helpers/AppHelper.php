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
    public static function booking_keys_array()
    {
        return [
            'is_studio' => 'Selected Place Type: Studio Apartment',
            'is_house' => 'Selected Place Type: House/Flat',
            'no_of_bed' => 'Selected Number of Bedrooms',
            'no_of_bath' => 'Selected Number of Bathrooms',
            'no_of_level' => 'Selected Number of Levels',
            'is_combine_kitchen' => 'Kitchen/Living Room: Combined',
            'is_separated_kitchen' => 'Kitchen/Living Room: Separated',
            'is_utility' => 'Utility Room: Selected For Cleaning',
            'is_office_room' => 'Study Room/Office: Selected For Cleaning',
            'is_conservatory' => 'Conservatory: Selected For Cleaning',
            'is_addition_area' => 'Additional Areas: Selected For Cleaning',
            'additional_areas_names' => 'Names of Additional Areas',
            'is_hoovered' => 'Carpets/Rugs Cleaning: Hoovered Only',
            'is_professionally_cleaned' => 'Carpets/Rugs Cleaning: Professionally Cleaned',
            'is_professionally' => 'Carpets/Rugs Cleaning: Professionally Cleaned',
            'is_carpets' => 'Flooring Type: Carpets Installed',
            'is_bedroom' => 'Carpets Installed in Bedrooms',
            'is_living_room' => 'Carpets Installed in Living Room',
            'is_dining_room' => 'Carpets Installed in Dining Room',
            'is_hallway' => 'Carpets Installed in Hallway',
            'is_staircase' => 'Carpets Installed on Staircase',
            'is_landing' => 'Carpets Installed on Landing',
            'no_of_bed_rooms' => 'Selected Number of Bedrooms Needing Carpet Cleaning',
            'no_of_living_rooms' => 'Selected Number of Living Rooms Needing Carpet Cleaning',
            'no_of_dining_rooms' => 'Selected Number of Dining Rooms Needing Carpet Cleaning',
            'no_of_hallways' => 'Selected Number of Hallways Needing Carpet Cleaning',
            'no_of_staircases' => 'Selected Number of Staircases Needing Carpet Cleaning',
            'no_of_landings' => 'Selected Number of Landings Needing Carpet Cleaning',
            'is_upholstery' => 'Upholstery Cleaning - Sofa',
            'is_armchair' => 'Upholstery Cleaning - Armchair',
            'is_mattress' => 'Upholstery Cleaning - Mattress',
            'is_curtains' => 'Upholstery Cleaning - Curtains',
            'no_of_two_seater_sofa' => 'Selected Number of Two-Seater Sofas',
            'no_of_three_seater_sofa' => 'Selected Number of Three-Seater Sofas',
            'no_of_four_seater_sofa' => 'Selected Number of Four-Seater Sofas',
            'no_of_five_seater_sofa' => 'Selected Number of Five-Seater Sofas',
            'no_of_armchairs' => 'Selected Number of Armchairs',
            'no_of_single_mattress' => 'Selected Number of Single Mattresses',
            'no_of_double_mattress' => 'Selected Number of Double Mattresses',
            'no_of_king_mattress' => 'Selected Number of King Mattresses',
            'no_of_half_length_curtains' => 'Selected Number of Half-Length Curtains',
            'no_of_full_length_curtains' => 'Selected Number of Full-Length Curtains',
            'is_window_cleaning' => 'Additional Cleaning - Window Cleaning',
            'is_balcony_cleaning' => 'Additional Cleaning - Balcony Cleaning',
            'is_garage_cleaning' => 'Additional Cleaning - Garage Cleaning',
            'is_windows_outside_clean' => 'Window Cleaning - Outside',
            'is_windows_inside_clean' => 'Window Cleaning - Inside',
            'is_windows_inside_outside_clean' => 'Window Cleaning - Inside and Outside',
            'terraced_house_highest_window_floor_name' => 'Terraced House Highest Window Floor',
            'semi_detached_house_highest_window_floor_name' => 'Semi-Detached House Highest Window Floor',
            'detached_house_highest_window_floor_name' => 'Detached House Highest Window Floor',
            'property_floor_no' => 'Property Floor Number',
            'has_lift' => 'There is a Lift Available in the Building',
            'parking_type' => 'Type of Parking Space',
            'is_small_rugs' => 'Cleaning Small Rugs',
            'is_medium_rugs' => 'Cleaning Medium Rugs',
            'is_large_rugs' => 'Cleaning Large Rugs',
            'no_of_small_rugs' => 'Selected Number of Small Rugs',
            'no_of_medium_rugs' => 'Selected Number of Medium Rugs',
            'no_of_large_rugs' => 'Selected Number of Large Rugs',
            'is_standard_rugs' => 'Standard, Fabric, Synthetic Rugs',
            'is_delicate_rugs' => 'Delicate, Wool, Cotton Rugs',
            'is_single_oven' => 'Cleaning Single Oven',
            'is_double_oven' => 'Cleaning Double Oven',
            'is_range_cooker' => 'Cleaning Range Cooker',
            'is_aga_oven' => 'Cleaning AGA Oven',
            'no_of_single_ovens' => 'Selected Number of Single Ovens',
            'no_of_double_ovens' => 'Selected Number of Double Ovens',
            'no_of_range_cookers' => 'Selected Number of Range Cookers',
            'no_of_cm' => 'Selected Number of CM Cookers',
            'no_of_aga_oven' => 'Selected Number of AGA Ovens',
            'ovens_material_is_hobs' => 'Oven Material - Hobs',
            'ovens_material_is_splashback' => 'Oven Material - Splashback',
            'ovens_material_is_extractor' => 'Oven Material - Extractor',
            'no_of_ovens_hobs' => 'Selected Number of Hobs',
            'no_of_ovens_splashback' => 'Selected Number of Splashbacks',
            'no_of_ovens_extraxtor' => 'Selected Number of Extractors',
            'is_kitchen_outside_cleaned' => 'Kitchen Cleaning - Outside',
            'is_kitchen_inside_outside_cleaned' => 'Kitchen Cleaning - Inside and Outside',
            'is_kitchen_customize_cleaned' => 'Kitchen Cleaning - Customize',
            'is_prefer_clean' => 'Customize Cleaning Preferences',
            'is_dining_chair_cleaned' => 'Cleaning Dining Chairs',
            'is_armchair_cleaned' => 'Cleaning Armchairs',
            'is_two_seater_sofa' => 'Cleaning Two-Seater Sofas',
            'is_three_seater_sofa' => 'Cleaning Three-Seater Sofas',
            'is_four_seater_sofa' => 'Cleaning Four-Seater Sofas',
            'is_five_seater_sofa' => 'Cleaning Five-Seater Sofas',
            'no_of_dining_chairs' => 'Selected Number of Dining Chairs',
            'no_of_armchair' => 'Selected Number of Armchairs',
            'sofas_material_fabric' => 'Sofas/Chairs Material - Fabric',
            'sofas_material_velvet' => 'Sofas/Chairs Material - Velvet',
            'sofas_material_delicate' => 'Sofas/Chairs Material - Delicate',
            'sofas_material_other' => 'Sofas/Chairs Material - Other',
            'no_of_sofas_material_other' => 'Selected Number of Other Materials',
            'is_single_mattress' => 'Cleaning Single Mattresses',
            'is_double_mattress' => 'Cleaning Double Mattresses',
            'is_king_mattress' => 'Cleaning King Size Mattresses',
            'is_fridge_mattress' => 'Cleaning Fridges',
            'is_microwave_mattress' => 'Cleaning Microwaves',
            'is_washing_machine' => 'Cleaning Washing Machines',
            'is_dishwasher' => 'Cleaning Dishwashers',
            'no_of_fridges' => 'Selected Number of Fridges',
            'no_of_microwaves' => 'Selected Number of Microwaves',
            'no_of_machines' => 'Selected Number of Washing Machines',
            'no_of_dishwashers' => 'Selected Number of Dishwashers',
            'is_oven_cleaning' => 'Oven Cleaning',
            'is_one_off_cleaning' => 'One-Off Cleaning',
            'is_detergents_provide' => 'Detergents Provided',
            'is_detergents_equipment_provide' => 'Detergents and Equipment Provided',
            'is_everything_provide' => 'Customer Provides Everything',
            'is_oven_only' => 'Cleaning Oven Only',
            'is_window_cleaned' => 'Window Cleaned',
            'is_carpet_cleaned' => 'Carpet Cleaned',
            'is_upholstery_cleaned' => 'Upholstery Cleaned',
            'is_upholstery_cleaning' => 'Upholstery Cleaned',
            'is_dining_armchair_cleaned' =>'Dining Armchair Cleaned',
            'is_not_have_carpet' => 'No Carpets Installed',
            'is_curtains_cleaned' => 'Curtains Cleaned',
            'office_square_meters' => 'Office Square Meters',
            'is_kitchen_oven_type' => 'Kitchen Oven Type Cleaning',
            'is_bathrooms_oven_type' => 'Bathroom Oven Type Cleaning',
            'is_toilet_oven_type' => 'Toilet Oven Type Cleaning',
            'is_other_oven_type' => 'Other Oven Type Cleaning',
            'no_of_kitchens' => 'Selected Number of Kitchens',
            'no_of_toilets' => 'Selected Number of Toilets',
            'no_of_other_ovens' => 'Selected Number of Other Ovens',
            'is_once_service' => 'Service Frequency: One-Time',
            'is_weekly_service' => 'Service Frequency: Weekly',
            'is_blinds' => 'Blinds Requiring Dusting: Selected For Cleaning',
            'no_of_blinds' => 'Selected Selected Number of Blinds',
            'is_fortnightly_service' => 'Service Frequency: Fortnightly',
            'is_mattress_cleaned' => 'Mattress Cleaned',
            'is_half_length_mattress' => 'Half Length Mattress Cleaned',
            'is_full_lenght_mattress' => 'Full Length Mattress Cleaned',
            'is_flat' => 'Selected  Place Is  Flat',
            'is_terraced' => 'Selected  Place Is  Terraced',
            'is_semi_detached' => 'Selected  Place Is Semi  Detached',
            'is_detached_house' => 'Selected  Place Is  Detached House',
            'is_lift' => 'lift Is Available in the building',
            'other_kitchen_cupboards_appliances_cleaned' => 'Other Kitchen Cupboards Appliances Cleaned',
        ];
    }


    public static function getBookingData($request) {
        $bookingData = [];
        if ($request->has('is_studio')) {
            $bookingData['is_studio'] = $request->input('is_studio') ? 'Yes' : 'No';
        }

        if ($request->has('is_house')) {
            $bookingData['is_house'] = $request->input('is_house') ? 'Yes' : 'No';
        }

        if ($request->has('is_mattress_cleaned')) {
            $bookingData['is_mattress_cleaned'] = $request->input('is_mattress_cleaned') ? 'Yes' : 'No';
        }
        if ($request->has('is_kitchen_oven_type')) {
            $bookingData['is_kitchen_oven_type'] = $request->input('is_kitchen_oven_type') ? 'Yes' : 'No';
        }

        if ($request->has('is_single_mattress')) {
            $bookingData['is_single_mattress'] = $request->input('is_single_mattress') ? 'Yes' : 'No';
        }
        if ($request->has('is_double_mattress')) {
            $bookingData['is_double_mattress'] = $request->input('is_double_mattress') ? 'Yes' : 'No';
        }

        if ($request->has('is_king_mattress')) {
            $bookingData['is_king_mattress'] = $request->input('is_king_mattress') ? 'Yes' : 'No';
        }

       if ($request->has('is_bathrooms_oven_type')) {
            $bookingData['is_bathrooms_oven_type'] = $request->input('is_bathrooms_oven_type') ? 'Yes' : 'No';
        }
       if ($request->has('is_toilet_oven_type')) {
            $bookingData['is_toilet_oven_type'] = $request->input('is_toilet_oven_type') ? 'Yes' : 'No';
        }

        if ($request->has('is_other_oven_type')) {
            $bookingData['is_other_oven_type'] = $request->input('is_other_oven_type') ? 'Yes' : 'No';
        }

        if ($request->has('no_of_other_ovens')) {
            $bookingData['no_of_other_ovens'] = $request->input('no_of_other_ovens');
        }
        if ($request->has('no_of_bed')) {
            $bookingData['no_of_bed'] = $request->input('no_of_bed');
        }
        if ($request->has('no_of_bed_rooms')) {
            $bookingData['no_of_bed_rooms'] = $request->input('no_of_bed_rooms');
        }

        if ($request->has('no_of_bath')) {
            $bookingData['no_of_bath'] = $request->input('no_of_bath');
        }
        if ($request->has('no_of_blinds')) {
            $bookingData['no_of_blinds'] = $request->input('no_of_blinds');
        }

        if ($request->has('no_of_level')) {
            $bookingData['no_of_level'] = $request->input('no_of_level');
        }

        // Additional property features inputs
        if ($request->has('is_combine_kitchen')) {
            $bookingData['is_combine_kitchen'] = $request->input('is_combine_kitchen') ? 'Yes' : 'No';
        }

        if ($request->has('is_separated_kitchen')) {
            $bookingData['is_separated_kitchen'] = $request->input('is_separated_kitchen') ? 'Yes' : 'No';
        }
        if ($request->has('is_dining_chair_cleaned')) {
            $bookingData['is_dining_chair_cleaned'] = $request->input('is_dining_chair_cleaned') ? 'Yes' : 'No';
        }

        if ($request->has('is_utility')) {
            $bookingData['is_utility'] = $request->input('is_utility') ? 'Yes' : 'No';
        }

        if ($request->has('is_office_room')) {
            $bookingData['is_office_room'] = $request->input('is_office_room') ? 'Yes' : 'No';
        }

        if ($request->has('is_conservatory')) {
            $bookingData['is_conservatory'] = $request->input('is_conservatory') ? 'Yes' : 'No';
        }

        if ($request->has('is_addition_area')) {
            $bookingData['is_addition_area'] = $request->input('is_addition_area') ? 'Yes' : 'No';
        }

        // Cleaning options inputs
        if ($request->has('is_hoovered')) {
            $bookingData['is_hoovered'] = $request->input('is_hoovered') ? 'Yes' : 'No';
        }

        if ($request->has('is_professionally_cleaned')) {
            $bookingData['is_professionally_cleaned'] = $request->input('is_professionally_cleaned') ? 'Yes' : 'No';
        }
        if ($request->has('is_professionally')) {
            $bookingData['is_professionally'] = $request->input('is_professionally') ? 'Yes' : 'No';
        }

        if ($request->has('is_carpets')) {
            $bookingData['is_carpets'] = $request->input('is_carpets') ? 'Yes' : 'No';
        }

        // Cleaning areas inputs
        if ($request->has('is_bedroom')) {
            $bookingData['is_bedroom'] = $request->input('is_bedroom') ? 'Yes' : 'No';
        }

        if ($request->has('is_living_room')) {
            $bookingData['is_living_room'] = $request->input('is_living_room') ? 'Yes' : 'No';
        }

        if ($request->has('is_dining_room')) {
            $bookingData['is_dining_room'] = $request->input('is_dining_room') ? 'Yes' : 'No';
        }

        if ($request->has('is_hallway')) {
            $bookingData['is_hallway'] = $request->input('is_hallway') ? 'Yes' : 'No';
        }

        if ($request->has('is_staircase')) {
            $bookingData['is_staircase'] = $request->input('is_staircase') ? 'Yes' : 'No';
        }

        if ($request->has('is_landing')) {
            $bookingData['is_landing'] = $request->input('is_landing') ? 'Yes' : 'No';
        }

        // Cleaning areas quantity inputs
        if ($request->has('no_of_bedrooms')) {
            $bookingData['no_of_bedrooms'] = $request->input('no_of_bedrooms');
        }

        if ($request->has('no_of_living_rooms')) {
            $bookingData['no_of_living_rooms'] = $request->input('no_of_living_rooms');
        }

        if ($request->has('no_of_dining_rooms')) {
            $bookingData['no_of_dining_rooms'] = $request->input('no_of_dining_rooms');
        }

        if ($request->has('no_of_hallways')) {
            $bookingData['no_of_hallways'] = $request->input('no_of_hallways');
        }

        if ($request->has('no_of_staircases')) {
            $bookingData['no_of_staircases'] = $request->input('no_of_staircases');
        }

        if ($request->has('no_of_landings')) {
            $bookingData['no_of_landings'] = $request->input('no_of_landings');
        }

        // Upholstery cleaning inputs
        if ($request->has('is_upholstery')) {
            $bookingData['is_upholstery'] = $request->input('is_upholstery') ? 'Yes' : 'No';
        }
        if ($request->has('is_blinds')) {
            $bookingData['is_blinds'] = $request->input('is_blinds') ? 'Yes' : 'No';
        }

        if ($request->has('is_armchair')) {
            $bookingData['is_armchair'] = $request->input('is_armchair') ? 'Yes' : 'No';
        }

        if ($request->has('is_mattress')) {
            $bookingData['is_mattress'] = $request->input('is_mattress') ? 'Yes' : 'No';
        }

        if ($request->has('is_curtains')) {
            $bookingData['is_curtains'] = $request->input('is_curtains') ? 'Yes' : 'No';
        }
        if ($request->has('is_half_length_mattress')) {
            $bookingData['is_half_length_mattress'] = $request->input('is_half_length_mattress') ? 'Yes' : 'No';
        }
        if ($request->has('is_full_lenght_mattress')) {
            $bookingData['is_full_lenght_mattress'] = $request->input('is_full_lenght_mattress') ? 'Yes' : 'No';
        }
        if ($request->has('is_flat')) {
            $bookingData['is_flat'] = $request->input('is_flat') ? 'Yes' : 'No';
        }
        if ($request->has('is_terraced')) {
            $bookingData['is_terraced'] = $request->input('is_terraced') ? 'Yes' : 'No';
        }
        if ($request->has('is_semi_detached')) {
            $bookingData['is_semi_detached'] = $request->input('is_semi_detached') ? 'Yes' : 'No';
        }
        if ($request->has('is_detached_house')) {
            $bookingData['is_detached_house'] = $request->input('is_detached_house') ? 'Yes' : 'No';
        }

        // Quantity of sofas and armchairs inputs
        if ($request->has('no_of_two_seater_sofa')) {
            $bookingData['no_of_two_seater_sofa'] = $request->input('no_of_two_seater_sofa');
        }

        if ($request->has('no_of_three_seater_sofa')) {
            $bookingData['no_of_three_seater_sofa'] = $request->input('no_of_three_seater_sofa');
        }

        if ($request->has('no_of_four_seater_sofa')) {
            $bookingData['no_of_four_seater_sofa'] = $request->input('no_of_four_seater_sofa');
        }

        if ($request->has('no_of_five_seater_sofa')) {
            $bookingData['no_of_five_seater_sofa'] = $request->input('no_of_five_seater_sofa');
        }

        if ($request->has('no_of_armchairs')) {
            $bookingData['no_of_armchairs'] = $request->input('no_of_armchairs');
        }

        // Quantity of mattresses inputs
        if ($request->has('no_of_single_mattress')) {
            $bookingData['no_of_single_mattress'] = $request->input('no_of_single_mattress');
        }

        if ($request->has('no_of_double_mattress')) {
            $bookingData['no_of_double_mattress'] = $request->input('no_of_double_mattress');
        }

        if ($request->has('no_of_king_mattress')) {
            $bookingData['no_of_king_mattress'] = $request->input('no_of_king_mattress');
        }
        if ($request->has('additional_areas_names')) {
            $bookingData['additional_areas_names'] = $request->input('additional_areas_names');
        }

        // Quantity of curtains inputs
        if ($request->has('no_of_half_length_curtains')) {
            $bookingData['no_of_half_length_curtains'] = $request->input('no_of_half_length_curtains');
        }

        if ($request->has('no_of_full_length_curtains')) {
            $bookingData['no_of_full_length_curtains'] = $request->input('no_of_full_length_curtains');
        }

        // Window cleaning inputs
        if ($request->has('is_window_cleaning')) {
            $bookingData['is_window_cleaning'] = $request->input('is_window_cleaning') ? 'Yes' : 'No';
        }

        if ($request->has('is_balcony_cleaning')) {
            $bookingData['is_balcony_cleaning'] = $request->input('is_balcony_cleaning') ? 'Yes' : 'No';
        }

        if ($request->has('is_garage_cleaning')) {
            $bookingData['is_garage_cleaning'] = $request->input('is_garage_cleaning') ? 'Yes' : 'No';
        }

        // Sides of windows to be cleaned inputs
        if ($request->has('is_windows_outside_clean')) {
            $bookingData['is_windows_outside_clean'] = $request->input('is_windows_outside_clean') ? 'Yes' : 'No';
        }

        if ($request->has('is_windows_inside_clean')) {
            $bookingData['is_windows_inside_clean'] = $request->input('is_windows_inside_clean') ? 'Yes' : 'No';
        }

        if ($request->has('is_windows_inside_outside_clean')) {
            $bookingData['is_windows_inside_outside_clean'] = $request->input('is_windows_inside_outside_clean') ? 'Yes' : 'No';
        }

        // Highest window floor inputs for different house types
        if ($request->has('terraced_house_highest_window_floor_name')) {
            $bookingData['terraced_house_highest_window_floor_name'] = $request->input('terraced_house_highest_window_floor_name');
        }

        if ($request->has('semi_detached_house_highest_window_floor_name')) {
            $bookingData['semi_detached_house_highest_window_floor_name'] = $request->input('semi_detached_house_highest_window_floor_name');
        }

        if ($request->has('detached_house_highest_window_floor_name')) {
            $bookingData['detached_house_highest_window_floor_name'] = $request->input('detached_house_highest_window_floor_name');
        }
        // Property-related inputs
        if ($request->has('property_floor_no')) {
            $bookingData['property_floor_no'] = $request->input('property_floor_no');
        }

        if ($request->has('is_lift')) {
            $bookingData['is_lift'] = $request->input('is_lift') ? 'Yes' : 'No';
        }

        if ($request->has('parking_type')) {
            $bookingData['parking_type'] = $request->input('parking_type');
        }

        //rug cleaning

        if ($request->has('is_small_rugs')) {
            $bookingData['is_small_rugs'] = $request->input('is_small_rugs') ? 'Yes' : 'No';
        }
        if ($request->has('no_of_small_rugs')) {
            $bookingData['no_of_small_rugs'] = $request->input('no_of_small_rugs');
        }

        if ($request->has('is_medium_rugs')) {
            $bookingData['is_medium_rugs'] = $request->input('is_medium_rugs') ? 'Yes' : 'No';
        }
        if ($request->has('no_of_medium_rugs')) {
            $bookingData['no_of_medium_rugs'] = $request->input('no_of_medium_rugs');
        }

        if ($request->has('is_large_rugs')) {
            $bookingData['is_large_rugs'] = $request->input('is_large_rugs') ? 'Yes' : 'No';
        }
        if ($request->has('no_of_large_rugs')) {
            $bookingData['no_of_large_rugs'] = $request->input('no_of_large_rugs');
        }

        if ($request->has('is_standard_rugs')) {
            $bookingData['is_standard_rugs'] = $request->input('is_standard_rugs') ? 'Yes' : 'No';
        }
        if ($request->has('is_delicate_rugs')) {
            $bookingData['is_delicate_rugs'] = $request->input('is_delicate_rugs') ? 'Yes' : 'No';
        }

        if ($request->has('is_window')) {
            $bookingData['is_window'] = $request->input('is_window') ? 'Yes' : 'No';
        }
        if ($request->has('is_oven')) {
            $bookingData['is_oven'] = $request->input('is_oven') ? 'Yes' : 'No';
        }
        if ($request->has('is_upholstery')) {
            $bookingData['is_upholstery'] = $request->input('is_upholstery') ? 'Yes' : 'No';
        }
        if ($request->has('is_one_off_cleaning')) {
            $bookingData['is_one_off_cleaning'] = $request->input('is_one_off_cleaning') ? 'Yes' : 'No';
        }
        if ($request->has('is_detergents_provide')) {
            $bookingData['is_detergents_provide'] = $request->input('is_detergents_provide') ? 'Yes' : 'No';
        }
        if ($request->has('is_detergents_equipment_provide')) {
            $bookingData['is_detergents_equipment_provide'] = $request->input('is_detergents_equipment_provide') ? 'Yes' : 'No';
        }
        if ($request->has('is_everything_provide')) {
            $bookingData['is_everything_provide'] = $request->input('is_everything_provide') ? 'Yes' : 'No';
        }
        // oven cleaning

        if ($request->has('is_single_oven')) {
            $bookingData['is_single_oven'] = $request->input('is_single_oven') ? 'Yes' : 'No';
        }
        if ($request->has('no_of_single_ovens')) {
            $bookingData['no_of_single_ovens'] = $request->input('no_of_single_ovens');
        }

        if ($request->has('is_double_oven')) {
            $bookingData['is_double_oven'] = $request->input('is_double_oven') ? 'Yes' : 'No';
        }
        if ($request->has('no_of_double_ovens')) {
            $bookingData['no_of_double_ovens'] = $request->input('no_of_double_ovens');
        }

        if ($request->has('is_range_cooker')) {
            $bookingData['is_range_cooker'] = $request->input('is_range_cooker') ? 'Yes' : 'No';
        }
        if ($request->has('no_of_range_cookers')) {
            $bookingData['no_of_range_cookers'] = $request->input('no_of_range_cookers');
        }
        if ($request->has('no_of_cm')) {
            $bookingData['no_of_cm'] = $request->input('no_of_cm');
        }

        if ($request->has('is_aga_oven')) {
            $bookingData['is_aga_oven'] = $request->input('is_aga_oven') ? 'Yes' : 'No';
        }
        if ($request->has('no_of_aga_oven')) {
            $bookingData['no_of_aga_oven'] = $request->input('no_of_aga_oven');
        }

        if ($request->has('is_kitchen_outside_cleaned')) {
            $bookingData['is_kitchen_outside_cleaned'] = $request->input('is_kitchen_outside_cleaned') ? 'Yes' : 'No';
        }
        if ($request->has('is_kitchen_inside_outside_cleaned')) {
            $bookingData['is_kitchen_inside_outside_cleaned'] = $request->input('is_kitchen_inside_outside_cleaned') ? 'Yes' : 'No';
        }
        if ($request->has('is_kitchen_customize_cleaned')) {
            $bookingData['is_kitchen_customize_cleaned'] = $request->input('is_kitchen_customize_cleaned') ? 'Yes' : 'No';
        }

        if ($request->has('is_oven_cleaning')) {
            $bookingData['is_oven_cleaning'] = $request->input('is_oven_cleaning') ? 'Yes' : 'No';
        }

        if ($request->has('is_upholstery_cleaning')) {
            $bookingData['is_upholstery_cleaning'] = $request->input('is_upholstery_cleaning') ? 'Yes' : 'No';
        }

        if ($request->has('is_armchair_cleaned')) {
            $bookingData['is_armchair_cleaned'] = $request->input('is_armchair_cleaned') ? 'Yes' : 'No';
        }
        if ($request->has('is_armchair_cleaned')) {
            $bookingData['is_armchair_cleaned'] = $request->input('is_armchair_cleaned') ? 'Yes' : 'No';
        }
        if ($request->has('is_two_seater_sofa')) {
            $bookingData['is_two_seater_sofa'] = $request->input('is_two_seater_sofa') ? 'Yes' : 'No';
        }
        if ($request->has('is_three_seater_sofa')) {
            $bookingData['is_three_seater_sofa'] = $request->input('is_three_seater_sofa') ? 'Yes' : 'No';
        }
        if ($request->has('is_four_seater_sofa')) {
            $bookingData['is_four_seater_sofa'] = $request->input('is_four_seater_sofa') ? 'Yes' : 'No';
        }
        if ($request->has('is_five_seater_sofa')) {
            $bookingData['is_five_seater_sofa'] = $request->input('is_five_seater_sofa') ? 'Yes' : 'No';
        }

        if ($request->has('is_curtains_cleaned')) {
            $bookingData['is_curtains_cleaned'] = $request->input('is_curtains_cleaned') ? 'Yes' : 'No';
        }
        if ($request->has('no_of_ovens_splashback')) {
            $bookingData['no_of_ovens_splashback'] = $request->input('no_of_ovens_splashback');
        }


        if ($request->has('no_of_ovens_extraxtor')) {
            $bookingData['no_of_ovens_extraxtor'] = $request->input('no_of_ovens_extraxtor');
        }

        if ($request->has('ovens_material_is_hobs')) {
            $bookingData['ovens_material_is_hobs'] = $request->input('ovens_material_is_hobs') ? 'Yes' : 'No';
        }

        if ($request->has('ovens_material_is_splashback')) {
            $bookingData['ovens_material_is_splashback'] = $request->input('ovens_material_is_splashback') ? 'Yes' : 'No';
        }
        if ($request->has('ovens_material_is_extractor')) {
            $bookingData['ovens_material_is_extractor'] = $request->input('ovens_material_is_extractor') ? 'Yes' : 'No';
        }

        if ($request->has('sofas_material_other')) {
            $bookingData['sofas_material_other'] = $request->input('sofas_material_other') ? 'Yes' : 'No';
        }

        if ($request->has('no_of_ovens_hobs')) {
            $bookingData['no_of_ovens_hobs'] = $request->input('no_of_ovens_hobs');
        }

        if ($request->has('no_of_sofas_material_other')) {
            $bookingData['no_of_sofas_material_other'] = $request->input('no_of_sofas_material_other');
        }
// Fridge mattress
        if ($request->has('is_fridge_mattress')) {
            $bookingData['is_fridge_mattress'] = $request->input('is_fridge_mattress') ? 'Yes' : 'No';
        }

// Microwave mattress
        if ($request->has('is_microwave_mattress')) {
            $bookingData['is_microwave_mattress'] = $request->input('is_microwave_mattress') ? 'Yes' : 'No';
        }

// Washing machine
        if ($request->has('is_washing_machine')) {
            $bookingData['is_washing_machine'] = $request->input('is_washing_machine') ? 'Yes' : 'No';
        }

        if ($request->has('is_dishwasher')) {
            $bookingData['is_dishwasher'] = $request->input('is_dishwasher') ? 'Yes' : 'No';
        }

        if ($request->has('no_of_fridges')) {
            $bookingData['no_of_fridges'] = $request->input('no_of_fridges');
        }
        if ($request->has('no_of_microwaves')) {
            $bookingData['no_of_microwaves'] = $request->input('no_of_microwaves');
        }
        if ($request->has('no_of_machines')) {
            $bookingData['no_of_machines'] = $request->input('no_of_machines');
        }
        if ($request->has('no_of_dishwashers')) {
            $bookingData['no_of_dishwashers'] = $request->input('no_of_dishwashers');
        }

        if ($request->has('sofas_material_fabric')) {
            $bookingData['sofas_material_fabric'] = $request->input('sofas_material_fabric') ? 'Yes' : 'No';
        }

        if ($request->has('sofas_material_velvet')) {
            $bookingData['sofas_material_velvet'] = $request->input('sofas_material_velvet') ? 'Yes' : 'No';
        }

        if ($request->has('sofas_material_delicate')) {
            $bookingData['sofas_material_delicate'] = $request->input('sofas_material_delicate') ? 'Yes' : 'No';
        }

        if ($request->has('is_oven_only')) {
            $bookingData['is_oven_only'] = $request->input('is_oven_only') ? 'Yes' : 'No';
        }
        if ($request->has('is_window_cleaned')) {
            $bookingData['is_window_cleaned'] = $request->input('is_window_cleaned') ? 'Yes' : 'No';
        }
        if ($request->has('is_carpet_cleaned')) {
            $bookingData['is_carpet_cleaned'] = $request->input('is_carpet_cleaned') ? 'Yes' : 'No';
        }
        if ($request->has('is_upholstery_cleaned')) {
            $bookingData['is_upholstery_cleaned'] = $request->input('is_upholstery_cleaned') ? 'Yes' : 'No';
        }
        if ($request->has('is_not_have_carpet')) {
            $bookingData['is_not_have_carpet'] = $request->input('is_not_have_carpet') ? 'Yes' : 'No';
        }
        if ($request->has('is_dining_armchair_cleaned')) {
            $bookingData['is_dining_armchair_cleaned'] = $request->input('is_dining_armchair_cleaned') ? 'Yes' : 'No';
        }
        if ($request->has('is_prefer_clean')) {
            $bookingData['is_prefer_clean'] = $request->input('is_prefer_clean') ? 'Yes' : 'No';
        }


        if ($request->has('is_once_service')) {
            $bookingData['is_once_service'] = $request->input('is_once_service') ? 'Yes' : 'No';
        }

        if ($request->has('is_weekly_service')) {
                $bookingData['is_weekly_service'] = $request->input('is_weekly_service') ? 'Yes' : 'No';
        }
        if ($request->has('is_fortnightly_service')) {
                $bookingData['is_fortnightly_service'] = $request->input('is_fortnightly_service') ? 'Yes' : 'No';
        }

        if ($request->has('other_kitchen_cupboards_appliances_cleaned')) {
                $bookingData['other_kitchen_cupboards_appliances_cleaned'] = $request->input('other_kitchen_cupboards_appliances_cleaned') ? 'Yes' : 'No';
        }

        if ($request->has('no_of_dining_chairs')) {
            $bookingData['no_of_dining_chairs'] = $request->input('no_of_dining_chairs');
        }
        if ($request->has('no_of_armchair')) {
            $bookingData['no_of_armchair'] = $request->input('no_of_armchair');
        }
        if ($request->has('no_of_kitchens')) {
            $bookingData['no_of_kitchens'] = $request->input('no_of_kitchens');
        }
        if ($request->has('no_of_toilets')) {
            $bookingData['no_of_toilets'] = $request->input('no_of_toilets');
        }

        if ($request->has('office_square_meters')) {
            $bookingData['office_square_meters'] = $request->input('office_square_meters');
        }



        return $bookingData;
    }

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
        return 'Clean Up';
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
