<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleVisualizationController extends Controller
{
    public function index()
    {
        return view('sampleVisualization');
    }
}
