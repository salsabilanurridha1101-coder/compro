<?php

namespace App\Http\Controllers;

use App\Models\instructor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $inst = Instructor::all(); // <-- ngambil semua data dari tabel instructors
        $inst = Instructor::orderBy('id', 'DESC')->get();
        return view('admin.inst.index', compact('inst'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.inst.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validasi = $request->validate([
                'image' => 'required|image|mimes:png,jpeg,jpg,jfif|max:2048',
                'sosmed' => 'required|string',
                'nama' => 'required|string',
                'jurusan' => 'required|string',
                'sosmed_urls' => 'required|string',

            ]);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAS('uploads/home', $filename, 'public');
                $validasi['image'] = $path;
            };
            // Ubah string jadi array (pisah pakai koma)
            $sosmed = [];
            if ($request->sosmed) {
                $sosmed = array_map('trim', explode(',', $request->sosmed));
            }
            $validasi['sosmed'] = $sosmed;

            $sosmed_urls = [];
            if ($request->sosmed_urls) {
                $sosmed_urls = array_map('trim', explode(',', $request->sosmed_urls));
            }
            $validasi['sosmed_urls'] = $sosmed_urls;
            instructor::create($validasi);
            return redirect()->route('inst-admin.index');
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
        $inst = instructor::find($id);
        return view('admin.inst.edit', compact('inst'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // $inst = instructor::find($id);
            $inst = Instructor::findOrFail($id);
            $validasi = $request->validate([
                'image' => 'nullable|image|mimes:png,jpeg,jpg,jfif|max:2048',
                'sosmed' => 'required|string',
                'nama' => 'required|string',
                'jurusan' => 'required|string'

            ]);
            if ($request->hasFile('image')) {
                if ($inst->image && Storage::disk('public')->exists($inst->image)) {
                    Storage::disk('public')->delete($inst->image);
                }
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAS('uploads/home', $filename, 'public');
                $validasi['image'] = $path;
            } else {
                //jika tidak perlu ganti gambar
                $validasi['image'] = $inst->image;
            }
            $sosmed = [];
            if ($request->sosmed) {
                $sosmed = array_map('trim', explode(',', $request->sosmed));
            }
            $validasi['sosmed'] = $sosmed;

            $sosmed_urls = [];
            if ($request->sosmed_urls) {
                $sosmed_urls = array_map('trim', explode(',', $request->sosmed_urls));
            }
            $validasi['sosmed_urls'] = $sosmed_urls;
            $inst->update($validasi);

            return redirect()->route('inst-admin.index');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => 'Ups, terjadi kesalahan: ' . $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inst = instructor::find($id);
        if ($inst->image && Storage::disk('public')->exists($inst->image)) {
            Storage::disk('public')->delete($inst->image);
        }
        $inst->delete();

        return redirect()->route('inst-admin.index');
    }
}
