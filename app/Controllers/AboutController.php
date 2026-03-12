<?php

namespace App\Controllers;

use App\Models\AboutModel;
use App\Models\TimelineModel;
use App\Models\TeamModel;

class AboutController extends BaseController
{
    public function index()
    {
        $aboutModel = new AboutModel();
        $timelineModel = new TimelineModel();
        $teamModel = new TeamModel();

        $about = $aboutModel->first() ?: [
            'title' => 'About Us',
            'subtitle' => 'Learn more about us',
            'content' => 'Our company is committed to delivering the best services.'
        ];

        $timeline = $timelineModel->findAll();
        $team = $teamModel->findAll();

        return view('about/index', compact('about', 'timeline', 'team'));
    }
}