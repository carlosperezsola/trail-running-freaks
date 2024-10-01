<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\TrademarkDataTable;
use App\Http\Controllers\Controller;
use App\Models\Trademark;
use App\Models\Product;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TrademarkController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(TrademarkDataTable $dataTable)
    {
        return $dataTable->render('admin_user.trademark.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_user.trademark.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => ['image', 'required', 'max:2000'],
            'name' => ['required', 'max:200'],
            'is_featured' => ['required'],
            'status' => ['required']
        ]);

        $logoPath = $this->uploadImage($request, 'logo', 'uploads');
        $trademark = new Trademark();

        $trademark->logo = $logoPath;
        $trademark->name = $request->name;
        $trademark->slug = Str::slug($request->name);
        $trademark->is_featured = $request->is_featured;
        $trademark->status = $request->status;
        $trademark->save();

        toastr('Created Successfully!', 'success');
        return redirect()->route('admin_user.trademark.index');
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
        $trademark = Trademark::findOrFail($id);
        return view('admin_user.trademark.edit', compact('trademark'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'logo' => ['image', 'max:2000'],
            'name' => ['required', 'max:200'],
            'is_featured' => ['required'],
            'status' => ['required']
        ]);

        $trademark = Trademark::findOrFail($id);

        $logoPath = $this->updateImage($request, 'logo', 'uploads', $trademark->logo);

        $trademark->logo = empty(!$logoPath) ? $logoPath : $trademark->logo;
        $trademark->name = $request->name;
        $trademark->slug = Str::slug($request->name);
        $trademark->is_featured = $request->is_featured;
        $trademark->status = $request->status;
        $trademark->save();

        toastr('Updated Successfully!', 'success');
        return redirect()->route('admin_user.trademark.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $trademark = Trademark::findOrFail($id);
        if (Product::where('trademark_id', $trademark->id)->count() > 0) {
            return response(['status' => 'error', 'message' => 'This trademark have products you can\'t delete it.']);
        }
        $this->deleteImage($trademark->logo);
        $trademark->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $category = Trademark::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response(['message' => 'Status has been updated!']);
    }
}
