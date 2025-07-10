<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get chart data for the last 30 days
        $chartData = $this->getChartData();
        
        // Get admin chart data if user is admin
        $adminChartData = null;
        if (Auth::user()->email === 'admin@docmag.com') {
            $adminChartData = $this->getAdminChartData();
        }
        
        return view('home', compact('chartData', 'adminChartData'));
    }
    
    /**
     * Get chart data for document uploads over time
     *
     * @return array
     */
    private function getChartData()
    {
        $labels = [];
        $data = [];
        
        // Get data for the last 30 days
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('M d');
            
            // Count documents uploaded on this date
            $count = Auth::user()->documents()
                ->whereDate('created_at', $date->format('Y-m-d'))
                ->count();
            
            $data[] = $count;
        }
        
        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
    
    /**
     * Get admin chart data for system-wide document uploads
     *
     * @return array
     */
    private function getAdminChartData()
    {
        $labels = [];
        $data = [];
        
        // Get data for the last 30 days
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('M d');
            
            // Count all documents uploaded on this date
            $count = Document::whereDate('created_at', $date->format('Y-m-d'))->count();
            
            $data[] = $count;
        }
        
        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
}
