<?php

namespace App\Http\Controllers;

use App\RecentProject;
use App\Texts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('landing')->withIntro(Texts::find(1)->intro)->withAbout(Texts::find(1)->about)->withProjects(RecentProject::all());
    }

    public function showOpdracht($id)
    {
        $project = RecentProject::findOrFail($id);
        return view('opdracht-bekijken')->withProject($project);
    }
}
