<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Default pageConfig
    protected $pageConfigs = [
        'navbarType' => 'sticky',
        'footerType' => 'static',
        'horizontalMenuType' => 'floating',
        'theme' => 'dark',
        'navbarColor' => 'bg-primary'
    ];

    // Dashboard - Analytics
    public function dashboardAnalytics(){

        return view('/pages/dashboard-analytics', [
            'pageConfigs' => $this->pageConfigs
        ]);
    }

}

