<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ThirdParty;
use App\Traits\ImageUploadTrait;

class AdminThirdPartyUserProfileController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = ThirdParty::where('user_id', Auth::user()->id)->first();
        return view('admin_user.third-party-profile.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => ['nullable','image', 'max:3000'],
            //'shop_name' => ['required', 'max:200'],
            'phone' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:200'],
            'address' => ['required'],
            'description' => ['required'],
            'fb_link' => ['nullable', 'url'],
            'tw_link' => ['nullable', 'url'],
            'insta_link' => ['nullable', 'url'],
        ]);

        $thirdParty = ThirdParty::where('user_id', Auth::user()->id)->first();
        $bannerPath = $this->updateImage($request, 'banner', 'uploads', $thirdParty->banner);
        $thirdParty->banner = empty(!$bannerPath) ? $bannerPath : $thirdParty->banner;
        $thirdParty->phone = $request->phone;
        //$thirdParty->shop_name = $request->shop_name;
        $thirdParty->email = $request->email;
        $thirdParty->address = $request->address;
        $thirdParty->description = $request->description;
        $thirdParty->fb_link = $request->fb_link;
        $thirdParty->tw_link = $request->tw_link;
        $thirdParty->insta_link = $request->insta_link;
        $thirdParty->save();

        toastr('Updated Successfully!', 'success');

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}