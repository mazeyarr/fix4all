<?php

namespace App\Http\Controllers;

use App\RecentProject;
use App\Texts;
use Illuminate\Http\Request;
use Image;
use File;
class BackendController extends Controller
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

    public function index()
    {
        return view('auth.backend-intro')->withIntro(Texts::find(1)->intro);
    }

    public function saveIntro(Request $request)
    {
        $request->validate([
            'intro' => 'required|max:255',
        ]);

        $text = Texts::find(1);
        $text->intro  = $request->intro;
        $text->save();

        return redirect()->back()->withSuccess("Opgeslagen");
    }

    public function saveAbout(Request $request)
    {
        $request->validate([
            'about' => 'required|max:255',
        ]);

        $text = Texts::find(1);
        $text->about  = $request->about;
        $text->save();

        return redirect()->back()->withSuccess("Opgeslagen");
    }

    public function showAbout()
    {
        return view('auth.backend-about')->withAbout(Texts::find(1)->about);
    }

    public function showOpdrachten()
    {
        return view('auth.backend-opdrachten')->withProjects(RecentProject::all());
    }

    public function OpdrachtenCreate()
    {
        return view('auth.backend-opdrachten-new');
    }

    public function OpdrachtenCreateSave(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'discription' => 'required|max:255',
            'discription_long' => 'required',
            'thumbnail' => 'required|mimes:jpeg,png,jpg,JPG',
            'img_before' => 'mimes:jpeg,png,jpg,JPG',
            'img_after' => 'mimes:jpeg,png,jpg,JPG'
        ]);

        $project = new RecentProject();
        $project->title = $request->title;
        $project->discription = $request->discription;
        $project->discription_long = $request->discription_long;

        $thumnail = $request->file('thumbnail');
        $thumbnail_filename = time() . '.' . $thumnail->getClientOriginalExtension();

        Image::make($thumnail)->resize(360, 240)->save(public_path('uploads/thumbnails/' . $thumbnail_filename));
        $project->thumbnail = $thumbnail_filename;

        if ($request->hasFile('img_before')){
            $img_before = $request->file('img_before');
            $img_before_filename = time() . '.' . $img_before->getClientOriginalExtension();

            Image::make($img_before)->resize(200, 200)->save(public_path('uploads/before/' . $img_before_filename));
            $project->img_before = $img_before_filename;
        }

        if ($request->hasFile('img_after')){
            $img_after = $request->file('img_after');
            $img_after_filename = time() . '.' . $img_after->getClientOriginalExtension();

            Image::make($img_after)->resize(200, 200)->save(public_path('uploads/after/' . $img_before_filename));
            $project->img_after = $img_after_filename;
        }

        $project->save();

        return redirect()->route('user_opdrachten')->withSuccess("Opgeslagen!");
    }

    public function OpdrachtenSave(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'discription' => 'required|max:255',
            'discription_long' => 'required'
        ]);

        $project = RecentProject::findOrFail($id);
        $project->title = $request->title;
        $project->discription = $request->discription;
        $project->discription_long = $request->discription_long;
        $project->save();

        return redirect()->back()->withSuccess($project->title . " Opgeslagen!");

    }

    public function OpdrachtenUpload(Request $request, $id)
    {
        $request->validate([
            'thumbnail' => 'required|mimes:jpeg,png,jpg,JPG',
            'img_before' => 'mimes:jpeg,png,jpg,JPG',
            'img_after' => 'mimes:jpeg,png,jpg,JPG'
        ]);

        $project = RecentProject::findOrFail($id);
        File::delete('uploads/thumbnails/' . $project->thumbnail);

        $thumnail = $request->file('thumbnail');
        $thumbnail_filename = time() . '.' . $thumnail->getClientOriginalExtension();

        Image::make($thumnail)->resize(360, 240)->save(public_path('uploads/thumbnails/' . $thumbnail_filename));
        $project->thumbnail = $thumbnail_filename;

        if ($request->hasFile('img_before')){
            File::delete('uploads/before/' . $project->img_before);

            $img_before = $request->file('img_before');
            $img_before_filename = time() . '.' . $img_before->getClientOriginalExtension();

            Image::make($img_before)->resize(200, 200)->save(public_path('uploads/before/' . $img_before_filename));
            $project->img_before = $img_before_filename;
        }

        if ($request->hasFile('img_after')){
            File::delete('uploads/after/' . $project->img_after);

            $img_after = $request->file('img_after');
            $img_after_filename = time() . '.' . $img_after->getClientOriginalExtension();

            Image::make($img_after)->resize(200, 200)->save(public_path('uploads/after/' . $img_before_filename));
            $project->img_after = $img_after_filename;
        }

        $project->save();

        return redirect()->back()->withSuccess($project->title . " Opgeslagen!");
    }

    public function OpdrachtenDelete($id)
    {
        $project = RecentProject::findOrFail($id);

        try {
            File::delete('uploads/thumbnails/' . $project->thumbnail);
            if (!empty($project->img_before)) {
                File::delete('uploads/before/' . $project->img_before);
            }
            if (!empty($project->img_after)) {
                File::delete('uploads/after/' . $project->img_after);
            }
            $project->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors( $e->getMessage());
        }

        return redirect()->back()->withSuccess($project->title . "Verwijderd");
    }
}
