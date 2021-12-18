<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use Illuminate\Support\Facades\Session;
class AdminController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }
    public function index(){

        return view('admin.home');

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
        $list = News::all();
        return view('admin.news.list',compact('list'));
    }
    public function logout(Request $request)

    {

        Auth::logout();

        Session::flush();

        return redirect('/login');

    }
}
