<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use App\news;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Redirect;
use App\career;
class AdminController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }
    public function index(){

        return view('admin.profile');

    }



    public function editprofile(){

        $admin = User::find(Auth::User()->id);

        return view('admin.profile',compact('admin'));

    }

    

    public function updateprofile(Request $request){

        // dd($request->all());

        $admin = User::find(Auth::User()->id);

        // $fileName = "";

        //     if ($request->file('image') != "") {

        //         $userFile = User::find(Auth::User()->id);

        //         if ($userFile->image != "") {

        //             unlink($userFile->image);

        //         }

        //         $file = $request->file('image');

        //         $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();

        //         $file->move('uploads/profiles/', $fileName);

        //         // $fileName = 'uploads/profiles/'.$fileName;
        //         $fileName = $request->root().'/uploads/profiles/'.$fileName;

        //     }else{

        //         $userFile = User::find(Auth::User()->id);

        //         $fileName=$userFile->image;

        //     }

        $data = [

            'name' => $request->name,

            // 'phone' => $request->phone,

            'email' => $request->email,

            // 'image' => $fileName,

            'password' => isset($request->password)?Hash::make($request->password):$admin->password,

        ];

        // dd($data);

        User::where('id',Auth::User()->id)->update($data);

        // dd($admin);

        return redirect()->back()->with('message', 'Admin Updated');

        

    }
    public function requests($type){
        if($type="contacts"){
            $contacts = DB::table('contact')->get();
            return view('admin.requests.contacts',compact('contacts'));
        }elseif($type="partnerships"){
            $partnerships = DB::table('partnerships')->latest()->get();
            return view('admin.requests.partnerships',compact('partnerships'));
        }else{
            return vie('not_found');
        }
    }
    public function NewsList(){
        $list = news::all();
        return view('admin.news.list',compact('list'));
    }
    public function addnews(Request $request){
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'frontimage'=>'required|dimensions:max_width=602,max_height=445',
                'city' => 'required',
                'country' => 'required|not_in:0',
                'date' => 'required',
                'detail1'=>'required'
            ],[
                'name.required' => 'Please enter news title',
                'frontimage.required' => 'Please add image for news',
                'frontimage.dimensions' => 'Please add  image with specified dimensions',
                'city.required' => 'Please enter city',
                'country.required' => 'Please select country',
                'date.required' => 'Please add date',
                'detail1.required'=>'please add details for the news'
            ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput();
        } 
        $image = "";
        if ($request->file('frontimage') != "") {
            
            $file = $request->file('frontimage');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('uploads/news/', $fileName);
            $image = 'uploads/news/' . $fileName;
        }
        $newsId = news::insertGetId([
            'name' => $request->name,
            'frontimage' => $image,
            'detail' => $request->detail1,
            'date' => Carbon::parse($request->date),
            'city'=>$request->city,
            'country'=>$request->country,
            'status'=>0,
            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
            "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()

        ]);
        
        DB::commit();
        if($newsId){
            return redirect()->back()->with('success', 'News added successfully');
        }else{
            return Redirect::back()->with('error','Something went wrong,Please check again');
        }
        

    }
    public function editnews($id,Request $request){
        $validator = Validator::make($request->all(),
        [
            'editname' => 'required',
            'frontimage'=>'dimensions:max_width=602,max_height=445',
            'editcity' => 'required',
            'editcountry' => 'required|not_in:0',
            'date1' => 'required',
            'detail2'=>'required'
        ],[
            'editname.required' => 'Please enter news title',
            // 'frontimage.required' => 'Please add image for news',
            'frontimage.dimensions' => 'Please add  image with specified dimensions',
            'editcity.required' => 'Please enter city',
            'editcountry.required' => 'Please select country',
            'date1.required' => 'Please add date',
            'detail2.required'=>'please add details for the news'
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput();
        } 
        $image = "";
        $old = news::find($id);
        if ($request->file('frontimage') != "") {
            
            $file = $request->file('frontimage');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('uploads/news/', $fileName);
            $image = 'uploads/news/' . $fileName;
        }else{
            $image = $old->frontimage;
        }
        $data = [
            'name' => $request->editname,
            'frontimage' => $image,
            'detail' => $request->detail2,
            'date' => Carbon::parse($request->date1),
            'city'=>$request->editcity,
            'country'=>$request->editcountry,
            'status'=>$request->status,
        ];
        // dd($data);
        $update = news::where('id',$id)->update($data);
        return redirect()->back()->with('success', 'News details Updated');
    }
    public function CareerList(){
        $list = career::all();
        return view('admin.career.list',compact('list'));
    }
    public function addcareer(Request $request){
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'opening' => 'required',
                'country' => 'required|not_in:0',
                'date1' => 'required',
                'detail1'=>'required'
            ],[
                'name.required' => 'Please enter news title',
                'opening.required' => 'Please enter no.of opening for the post',
                'country.required' => 'Please select country',
                'date1.required' => 'Please add date',
                'detail1.required'=>'please add details for the career'
            ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput();
        } 
        
        $careerId = career::insertGetId([
            'name' => $request->name,
            'numbers' => $request->opening,
            'detail' => $request->detail1,
            'date' => Carbon::parse($request->date),
            'country'=>$request->country,
            'status'=>0,
            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
            "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()

        ]);
        
        DB::commit();
        if($careerId){
            return redirect()->back()->with('success', 'Career added successfully');
        }else{
            return Redirect::back()->with('error','Something went wrong,Please check again');
        }
        

    }
    public function editcareer($id,Request $request){
        $validator = Validator::make($request->all(),
        [
            'editname' => 'required',
            'editopening' => 'required',
            'editcountry' => 'required',
            'date' => 'required',
            'detail2'=>'required'
        ],[
            'editname.required' => 'Please enter news title',
            'editopening.required' => 'Please enter no.of openings',
            'editcountry.required' => 'Please select country',
            'date.required' => 'Please add date',
            'detail2.required'=>'please add details for the news'
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput();
        } 
        $old = career::find($id);
        $data = [
            'name' => $request->editname,
            'numbers' => $request->editopening,
            'detail' => $request->detail2,
            'date' => Carbon::parse($request->date),
            'country'=>$request->editcountry,
            'status'=>$request->status,
        ];
        // dd($data);
        $update = career::where('id',$id)->update($data);
        return redirect()->back()->with('success', 'Career details Updated');
    }
    public function upload_images(Request $request){
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
           
            $request->file('upload')->move(public_path('images'), $fileName);
       
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
                  
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }

    public function logout(Request $request)

    {

        Auth::logout();

        Session::flush();

        return redirect('/login');

    }
}
