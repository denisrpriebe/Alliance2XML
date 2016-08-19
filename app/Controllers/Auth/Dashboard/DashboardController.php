<?php

namespace App\Controllers\Auth\Dashboard;

use App\Controllers\Controller;
use App\Facades\Components\Nav;
use App\Facades\Components\View;
use App\Models\Setting;

class DashboardController extends Controller {

    /**
     * Shows the dashboard page.
     * 
     */
    protected function showDashboard() {

        Nav::setActiveTabs([
            'dashboard'
        ]);

        View::add('settings', Setting::first());
        View::show('pages/auth/dashboard');
    }

}
