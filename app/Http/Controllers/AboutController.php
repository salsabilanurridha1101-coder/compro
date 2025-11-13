<?php

namespace App\Http\Controllers;

use App\Models\about;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = about::orderBy('id', 'DESC')->get();
        return view('admin.about.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validasi = $request->validate([
                'image' => 'required|image|mimes:png,jpeg,jpg,jfif|max:2048',
                'title' => 'required',
                'description' => 'required',
                'feature' => 'required|string',
            ]);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAS('uploads/about', $filename, 'public');
                $validasi['image'] = $path;
            };
            $feature = [];
            if ($request->feature) {
                $feature = array_map('trim', explode(',', $request->feature));
            }
            $validasi['feature'] = $feature;
            //INSERT INTO abouts () VALUES ()
            about::create($validasi);
            return redirect()->route('about-admin.index');
        } catch (\Exception $th) {
            return back()->withErrors(['error' => 'Ups, terjadi kesalahan di-' . $th->getMessage()]);
        }
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
        $about = about::find($id);
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $about = about::find($id);
            $validasi = $request->validate([
                'image' => 'nullable|image|mimes:png,jpeg,jpg,jfif|max:2048',
                'title' => 'required',
                'description' => 'required',
                'feature' => 'string',
            ]);
            if ($request->hasFile('image')) {
                //delete foto jika ada fotonya:  ->ini dibutuhkan di destroy agar tidak penuh di storage
                if ($about->image && Storage::disk('public')->exists($about->image)) {
                    Storage::disk('public')->delete($about->image);
                }
                //ini buat upload gambar barunya
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAS('uploads/about', $filename, 'public');
                $validasi['image'] = $path;
            } else {
                //jika tidak perlu ganti gambarnya, dia masih nyimpen foto lama
                $validasi['image'] = $about->image;
            }
            $feature = [];
            if ($request->feature) {
                $feature = array_map('trim', explode(',', $request->feature));
            }
            $validasi['feature'] = $feature;
            $about->update($validasi);
            return redirect()->route('about-admin.index');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => 'Ups, terjadi kesalahan di-' . $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $about = about::find($id);
        if ($about->image && Storage::disk('public')->exists($about->image)) {
            Storage::disk('public')->delete($about->image);
        }
        $about->delete();

        return redirect()->route('about-admin.index');
    }
}
