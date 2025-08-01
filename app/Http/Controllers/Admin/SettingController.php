<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index(){
        $appSettings = Setting::all();
        return view('admin.setting.index', compact('appSettings'));
    }
    public function edit(){
        $setting = Setting::first();
        return view('admin.setting.edit', compact('setting'));
    }

    public function store(Request $request){
        $setting = Setting::first();
        
        if($setting){
            $setting->update([
                'website_name'=> $request->website_name,
                'website_url'=> $request->website_url,
                'page_title'=> $request->page_title,
                
                'address'=> $request->address,
                'phone1'=> $request->phone1,
                'phone2'=> $request->phone2,
                'email1'=> $request->email1,
                'email2'=> $request->email2,
                'facebook'=> $request->facebook,

                'twitter'=> $request->twitter,
                'instagram'=> $request->instagram,
                'youtube'=> $request->youtube,
            ]);
            return redirect()->back()->with('message', 'Settings Updated');
        }
        else{
            Setting::create([
                'website_name'=> $request->website_name,
                'website_url'=> $request->website_url,
                'page_title'=> $request->page_title,

                'address'=> $request->address,
                'phone1'=> $request->phone1,
                'phone2'=> $request->phone2,
                'email1'=> $request->email1,
                'email2'=> $request->email2,

                'facebook'=> $request->facebook,
                'twitter'=> $request->twitter,
                'instagram'=> $request->instagram,
                'youtube'=> $request->youtube,
            ]);
        }
        return redirect()->back()->with('message', 'Settings Saved');
    }

    // public function destroy(int $setting_id){

    //     $setting = Setting::findOrFail($setting_id);
    //     $setting->delete();
    //     return redirect('/admin/settings')->with('message', 'Profile Deleted Successfully!');
    // }
    
}
