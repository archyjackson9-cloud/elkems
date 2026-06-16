<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Client;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_messages'  => ContactMessage::count(),
            'unread_messages' => ContactMessage::unread()->count(),
            'total_services'  => Service::count(),
            'total_team'      => TeamMember::count(),
            'total_clients'   => Client::count(),
        ];

        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages'));
    }
}
