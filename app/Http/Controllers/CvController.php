<?php

namespace App\Http\Controllers;
use App\Cv;
use App\Experience;
use App\Http\Requests\cvRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
   

use Auth;
class CvController extends Controller
{
    public function __construct(){
         $this->middleware('auth');
    }
    public function index()
    {
        if(Auth::user()->is_admin){
            $listcv = Cv::all();
        }
        else{
            $listcv = Auth::user()->cvs;
        }
        return view('cv.index',['cvs'=>$listcv]);
    }
    public function create()
    {
        return view('cv.create');
    }
    public function store(cvRequest $request)
    {
        $cv = new Cv();
        $cv->titre = $request->input('titre');
        $cv->presentation = $request->input('presentation');
        $cv->user_id = Auth::user()->id;

        if($request->hasFile('photo')){
            $cv->photo = $request->photo->store('image');
        }

        $cv->save();
        session()->flash('success','le CV a été bien ajouté!');
        return redirect('cvs');

    }
    public function edit($id)
    {
        $cv = Cv::find($id);
        $this->authorize('update',$cv);
        return view('cv.edit',['cv'=>$cv]);
    }
    public function update(cvRequest $request, $id)
    {
        $cv = Cv::find($id);
        $cv->titre = $request->input('titre');
        $cv->presentation = $request->input('presentation');
        if($request->hasFile('photo')){
            $cv->photo = $request->photo->store('image');
        }
        $cv->save();
        return redirect('cvs');

    }
    public function destroy(Request $request, $id)
    {
        $cv = Cv::find($id);
        $this->authorize('delete', $cv);
        $cv->delete();

        return redirect('cvs');
    }

    public function show($id)
    {
        return view('cv.detaille',['id'=>$id]);
    }

    public function getExperiences($id){
        $cv = Cv::find($id);
        return $cv->experiences()->orderBy('debut','desc')->get();
    }

    public function addExperience(Request $request){
        $experience= new Experience;
        $experience->titre = $request->titre;
        $experience->body  = $request->body;
        $experience->debut = $request->debut;
        $experience->fin = $request->fin;
        $experience->cv_id = $request->cv_id;
        $experience->save();
        return response()->json(['etat' => true,'id' =>$experience->id]);
    }

    public function updateExperience(Request $request){
        $experience=  Experience::find($request->id);
        $experience->titre = $request->titre;
        $experience->body  = $request->body;
        $experience->debut = $request->debut;
        $experience->fin = $request->fin;
        $experience->cv_id = $request->cv_id;
        $experience->save();
        return response()->json(['etat' => true]); 
    }
    public function deleteExperience($id){
        $experience = Experience::find($id);
        $experience->delete();
        return response()->json(['etat' => true]);
    }
}
