<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $homepage_section_promo = Promo::where('key', 'homepage_section_promo')->first();
        $homepage_section_promo = json_decode($homepage_section_promo?->value);

        return view('admin_user.promo.index', compact('homepage_section_promo'));
    }

    public function homepagePromoSection(Request $request)
    {

        $request->validate([
            'promo_one_image' => ['image'],
            'promo_one_url' => ['required'],
            'promo_two_image' => ['image'],
            'promo_two_url' => ['required'],
            'promo_three_image' => ['image'],
            'promo_three_url' => ['required'],
        ]);

        /** Handle the image upload */
        $imagePath = $this->updateImage($request, 'promo_one_image', 'uploads/selected');
        $imagePathTwo = $this->updateImage($request, 'promo_two_image', 'uploads/selected');
        $imagePathThree = $this->updateImage($request, 'promo_three_image', 'uploads/selected');

        $value = [
            'promo_one' => [
                'promo_url' => $request->promo_one_url,
                'status' => $request->promo_one_status == 'on' ? 1 : 0
            ],
            'promo_two' => [
                'promo_url' => $request->promo_two_url,
                'status' => $request->promo_two_status == 'on' ? 1 : 0
            ],
            'promo_three' => [
                'promo_url' => $request->promo_three_url,
                'status' => $request->promo_three_status == 'on' ? 1 : 0
            ]
        ];
        if (!empty($imagePath)) {
            $value['promo_one']['promo_image'] = $imagePath;
        } else {

            $value['promo_one']['promo_image'] = $request->promo_one_old_image;
        }
        if (!empty($imagePathTwo)) {
            $value['promo_two']['promo_image'] = $imagePathTwo;
        } else {

            $value['promo_two']['promo_image'] = $request->promo_two_old_image;
        }
        if (!empty($imagePathThree)) {
            $value['promo_three']['promo_image'] = $imagePathThree;
        } else {

            $value['promo_three']['promo_image'] = $request->promo_three_old_image;
        }

        $value = json_encode($value);
        Promo::updateOrCreate(
            ['key' => 'homepage_section_promo'],
            ['value' => $value]
        );

        toastr('Updated Successfully!', 'success', 'success');

        return redirect()->back();
    }
}
