<?php

namespace App\Http\Controllers;

use App\Log;
use App\MetaData;
use App\RecentProject;
use App\Texts;
use Illuminate\Http\Request;
use Image;
use File;
class BackendController extends Controller
{
    protected $thumbnailHeight = 360;
    protected $thumbnailWidth = 240;
    protected $imageHeight = 200;
    protected $imageWidth = 200;
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
            'intro' => 'required',
        ]);

        $text = Texts::find(1);
        $text->intro  = str_replace('<p>', '<p class="promo-text">', $request->intro);

        if ($text->isDirty()) {
            foreach ($text->getDirty() as $field => $newData) {
                $oldData = $text->getOriginal($field);
                if ($oldData != $newData)
                {
                    Log::create([
                        'page' => \Route::getCurrentRoute()->getName(),
                        'old' => $oldData,
                        'new' => $newData,
                        'discription' => "Project has been changed: " . $oldData . " --> " . $newData,
                        'user_id' => \Auth::user()->id,
                    ]);
                }
            }
        }

        $text->save();

        return redirect()->back()->withSuccess("Opgeslagen");
    }

    public function saveAbout(Request $request)
    {
        $request->validate([
            'about' => 'required',
        ]);

        $text = Texts::find(1);
        $text->about  = str_replace('<p>', '<p class="promo-text">', $request->about);

        if ($text->isDirty()) {
            foreach ($text->getDirty() as $field => $newData) {
                $oldData = $text->getOriginal($field);
                if ($oldData != $newData)
                {
                    Log::create([
                        'page' => \Route::getCurrentRoute()->getName(),
                        'old' => $oldData,
                        'new' => $newData,
                        'discription' => "Project has been changed: " . $oldData . " --> " . $newData,
                        'user_id' => \Auth::user()->id,
                    ]);
                }
            }
        }

        $text->save();

        return redirect()->back()->withSuccess("Opgeslagen");
    }

    public function showAbout()
    {
        return view('auth.backend-about')->withAbout(Texts::find(1)->about);
    }

    public function showMeta()
    {
        return view('auth.backend-meta')->withMeta(MetaData::find(1));
    }

    public function saveMeta(Request $request)
    {
        $request->validate([
            'keywords' => 'required',
            'subject' => 'required',
            'description' => 'required',
        ]);

        $meta = Texts::find(1);
        $meta->keywords = $request->keywords;
        $meta->subject = $request->subject;
        $meta->description = $request->description;

        if ($meta->isDirty()) {
            foreach ($meta->getDirty() as $field => $newData) {
                $oldData = $meta->getOriginal($field);
                if ($oldData != $newData)
                {
                    Log::create([
                        'page' => \Route::getCurrentRoute()->getName(),
                        'old' => $oldData,
                        'new' => $newData,
                        'discription' => "Project has been changed: " . $oldData . " --> " . $newData,
                        'user_id' => \Auth::user()->id,
                    ]);
                }
            }
        }

        $meta->save();

        return redirect()->back()->withSuccess("Opgeslagen");
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

        $image = Image::make($thumnail)->resize($this->thumbnailHeight, $this->thumbnailWidth, function ($constraint){
            $constraint->aspectRatio();
        });

        $canvas = Image::canvas($this->thumbnailHeight ,$this->thumbnailWidth);
        $canvas->insert($image, 'center');
        $canvas->save(public_path('uploads/thumbnails/' . $thumbnail_filename));

        $project->thumbnail = $thumbnail_filename;

        if ($request->hasFile('img_before')){
            $img_before = $request->file('img_before');
            $img_before_filename = time() . '.' . $img_before->getClientOriginalExtension();

            $image = Image::make($img_before)->resize($this->imageHeight, $this->imageWidth, function ($constraint){
                $constraint->aspectRatio();
            });
            $canvas = Image::canvas($this->imageHeight, $this->imageWidth);
            $canvas->insert($image, 'center');
            $canvas->save(public_path('uploads/before/' . $img_before_filename));

            $project->img_before = $img_before_filename;
        }

        if ($request->hasFile('img_after')){
            $img_after = $request->file('img_after');
            $img_after_filename = time() . '.' . $img_after->getClientOriginalExtension();

            $image = Image::make($img_after)->resize($this->imageHeight, $this->imageWidth, function ($constraint){
                $constraint->aspectRatio();
            });
            $canvas = Image::canvas($this->imageHeight , $this->imageWidth);
            $canvas->insert($image, 'center');
            $canvas->save(public_path('uploads/after/' . $img_before_filename));

            $project->img_after = $img_after_filename;
        }

        Log::create([
            'page' => \Route::getCurrentRoute()->getName(),
            'old' => "-",
            'new' => $project->title . " | ID: " . $project->id,
            'discription' => "New project added to website",
            'user_id' => \Auth::user()->id,
        ]);

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

        if ($project->isDirty()) {
            foreach ($project->getDirty() as $field => $newData) {
                $oldData = $project->getOriginal($field);
                if ($oldData != $newData)
                {
                    Log::create([
                        'page' => \Route::getCurrentRoute()->getName(),
                        'old' => $oldData,
                        'new' => $newData,
                        'discription' => "Project has been changed: " . $oldData . " --> " . $newData,
                        'user_id' => \Auth::user()->id,
                    ]);
                }
            }
        }

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

        $image = Image::make($thumnail)->resize($this->thumbnailHeight, $this->thumbnailWidth, function ($constraint){
            $constraint->aspectRatio();
        });
        $canvas = Image::canvas($this->thumbnailHeight ,$this->thumbnailWidth);
        $canvas->insert($image, 'center');
        $canvas->save(public_path('uploads/thumbnails/' . $thumbnail_filename));

        $project->thumbnail = $thumbnail_filename;

        if ($request->hasFile('img_before')){
            File::delete('uploads/before/' . $project->img_before);

            $img_before = $request->file('img_before');
            $img_before_filename = time() . '.' . $img_before->getClientOriginalExtension();

            $image = Image::make($img_before)->resize($this->imageHeight, $this->imageWidth, function ($constraint){
                $constraint->aspectRatio();
            });
            $canvas = Image::canvas($this->imageHeight, $this->imageWidth);
            $canvas->insert($image, 'center');
            $canvas->save(public_path('uploads/before/' . $img_before_filename));

            $project->img_before = $img_before_filename;
        }

        if ($request->hasFile('img_after')){
            File::delete('uploads/after/' . $project->img_after);

            $img_after = $request->file('img_after');
            $img_after_filename = time() . '.' . $img_after->getClientOriginalExtension();

            $image = Image::make($img_after)->resize($this->imageHeight, $this->imageWidth, function ($constraint){
                $constraint->aspectRatio();
            });
            $canvas = Image::canvas($this->imageHeight ,$this->imageWidth);
            $canvas->insert($image, 'center');
            $canvas->save(public_path('uploads/after/' . $img_before_filename));

            $project->img_after = $img_after_filename;
        }

        if ($project->isDirty()) {
            foreach ($project->getDirty() as $field => $newData) {
                $oldData = $project->getOriginal($field);
                if ($oldData != $newData)
                {
                    Log::create([
                        'page' => \Route::getCurrentRoute()->getName(),
                        'old' => $oldData,
                        'new' => $newData,
                        'discription' => "Project has been changed: " . $oldData . " --> " . $newData,
                        'user_id' => \Auth::user()->id,
                    ]);
                }
            }
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

            Log::create([
                'page' => \Route::getCurrentRoute()->getName(),
                'old' => "Exists",
                'new' => "Deleted",
                'discription' => "Project has been deleted",
                'user_id' => \Auth::user()->id,
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors( $e->getMessage());
        }

        return redirect()->back()->withSuccess($project->title . "Verwijderd");
    }

    public function getLog()
    {
        return Log::all()->toJson();
    }
}
