<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $homes = Home::orderBy('id', 'DESC')->get();
        return view('admin.home.index', compact('homes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.home.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validasi = $request->validate([
                'image' => 'required|image|mimes:png,jpeg,jpg,jfif|max:2048',
                'subtitle' => 'required|string',
                'title' => 'required|string',
                'description' => 'required|string'

            ]);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAS('uploads/home', $filename, 'public');
                $validasi['image'] = $path;
            };

            //INSERT INTO homes () VALUES ()
            Home::create($validasi);
            return redirect()->route('home-admin.index');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => 'Ups, terjadi kesalahan ' . $th->getMessage()]);
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
        $home = Home::find($id);
        return view('admin.home.edit', compact('home'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $home = Home::find($id);
            $validasi = $request->validate([
                'image' => 'nullable|image|mimes:png,jpeg,jpg,jfif|max:2048',
                'subtitle' => 'required|string',
                'title' => 'required|string',
                'description' => 'required|string'
            ]);
            if ($request->hasFile('image')) {
                //delete foto jika ada fotonya:  ->ini dibutuhkan di destroy agar tidak penuh di storage
                if ($home->image && Storage::disk('public')->exists($home->image)) {
                    Storage::disk('public')->delete($home->image);
                }
                //ini buat upload gambar barunya
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAS('uploads/home', $filename, 'public');
                $validasi['image'] = $path;
            } else {
                //jika tidak perlu ganti gambarnya, dia masih nyimpen foto lama
                $validasi['image'] = $home->image;
            }
            $home->update($validasi);
            return redirect()->route('home-admin.index');
        } catch (\Exception $th) {
            return back()->withErrors(['error' => 'Ups, terjadi kesalahan ' . $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $home = Home::find($id);
        if ($home->image && Storage::disk('public')->exists($home->image)) {
            Storage::disk('public')->delete($home->image);
        }
        $home->delete();

        return redirect()->route('home-admin.index');
    }
}
