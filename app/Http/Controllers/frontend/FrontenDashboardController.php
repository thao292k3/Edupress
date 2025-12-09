<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\InfoBox;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontenDashboardController extends Controller
{
    public function home(){

        $all_slider = Slider::latest()->get();

        $all_info = InfoBox::all();

        $all_categories = Category::inRandomOrder()->limit(6)->get();

        return view('frontend.index', compact('all_slider', 'all_info', 'all_categories'));
    }
    
}
