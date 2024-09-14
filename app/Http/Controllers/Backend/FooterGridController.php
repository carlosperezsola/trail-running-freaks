<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterGridDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterGrid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterGridController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterGridDataTable $dataTable)
    {
        return $dataTable->render('admin_user.footer.footer-grid.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_user.footer.footer-grid.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'url' => ['required', 'url'],
            'status' => ['required']
        ]);

        $footer = new FooterGrid();
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();

        Cache::forget('footer_grid');

        toastr('Created Successfully!', 'success', 'success');

        return redirect()->route('admin_user.footer-grid.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $footer = FooterGrid::findOrFail($id);
        return view('admin_user.footer.footer-grid.edit', compact('footer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'url' => ['required', 'url'],
            'status' => ['required']
        ]);

        $footer = FooterGrid::findOrFail($id);
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();

        Cache::forget('footer_grid');

        toastr('Update Successfully!', 'success', 'success');

        return redirect()->route('admin_user.footer-grid.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footer = FooterGrid::findOrFail($id);
        $footer->delete();
        Cache::forget('footer_grid');

        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $footer = FooterGrid::findOrFail($request->id);
        $footer->status = $request->status == 'true' ? 1 : 0;
        $footer->save();

        Cache::forget('footer_grid');

        return response(['message' => 'Status has been updated!']);
    }
}
