<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $homepage_section_banner = Banner::where('key', 'homepage_section_banner')->first();
        $homepage_section_banner = json_decode($homepage_section_banner?->value);

        return view('admin_user.banner.index', compact('homepage_section_banner'));
    }

    public function homepageBannerSection(Request $request)
    {

        $request->validate([
            'banner_one_image' => ['image'],
            'banner_one_url' => ['required'],
            'banner_two_image' => ['image'],
            'banner_two_url' => ['required'],
            'banner_three_image' => ['image'],
            'banner_three_url' => ['required'],
        ]);

        /** Handle the image upload */
        $imagePath = $this->updateImage($request, 'banner_one_image', 'uploads');
        $imagePathTwo = $this->updateImage($request, 'banner_two_image', 'uploads');
        $imagePathThree = $this->updateImage($request, 'banner_three_image', 'uploads');

        $value = [
            'banner_one' => [
                'banner_url' => $request->banner_one_url,
                'status' => $request->banner_one_status == 'on' ? 1 : 0
            ],
            'banner_two' => [
                'banner_url' => $request->banner_two_url,
                'status' => $request->banner_two_status == 'on' ? 1 : 0
            ],
            'banner_three' => [
                'banner_url' => $request->banner_three_url,
                'status' => $request->banner_three_status == 'on' ? 1 : 0
            ]
        ];
        if (!empty($imagePath)) {
            $value['banner_one']['banner_image'] = $imagePath;
        } else {

            $value['banner_one']['banner_image'] = $request->banner_one_old_image;
        }
        if (!empty($imagePathTwo)) {
            $value['banner_two']['banner_image'] = $imagePathTwo;
        } else {

            $value['banner_two']['banner_image'] = $request->banner_two_old_image;
        }
        if (!empty($imagePathThree)) {
            $value['banner_three']['banner_image'] = $imagePathThree;
        } else {

            $value['banner_three']['banner_image'] = $request->banner_three_old_image;
        }

        $value = json_encode($value);
        Banner::updateOrCreate(
            ['key' => 'homepage_section_banner'],
            ['value' => $value]
        );

        toastr('Updated Successfully!', 'success', 'success');

        return redirect()->back();
    }
}
