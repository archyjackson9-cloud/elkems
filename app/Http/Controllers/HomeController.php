<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Models\AboutSection;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Client;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $hero    = HeroSection::active();
        $about   = AboutSection::singleton();
        $services = Service::active()->get();
        $team    = TeamMember::active()->get();
        $clients = Client::active()->get();
        $settings = [
            'phone'    => Setting::get('phone', '+233 XX XXX XXXX'),
            'email'    => Setting::get('email', 'info@eldsolutions.com'),
            'address'  => Setting::get('address', 'Accra, Ghana'),
            'linkedin' => Setting::get('linkedin', '#'),
            'twitter'  => Setting::get('twitter', '#'),
            'facebook' => Setting::get('facebook', '#'),
        ];

        return view('frontend.home', compact(
            'hero', 'about', 'services', 'team', 'clients', 'settings'
        ));
    }
}
