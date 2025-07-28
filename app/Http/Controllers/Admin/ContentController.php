<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $query = Content::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $contents = $query->orderBy('id', 'desc')->get();

        return view('admin.content.index', compact('contents'));
    }
    
    public function create()
    {
        return view('admin.content.create');
    }

    public function store(Request $request)
    {
        try {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|string',
            'open_time' => 'nullable|date_format:H:i',
            'close_time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        
        $data['slug'] = Str::slug($data['name'], '-');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imagePath = $file->store('assets/content', 'public'); // simpan ke storage/app/public/content
            $data['image'] = $imagePath;
        }

        Content::create($data);

        return redirect()->route('content.index')->with('success', 'Konten berhasil ditambahkan.');
        } catch (\Exception $e) {
        return back()
            ->withInput()
            ->with('error', 'Terjadi kesalahan saat menambahkan konten: ' . $e->getMessage());
        }
    }

    public function edit(Content $content)
    {
        return view('admin.content.edit', compact('content'));
    }

    public function update(Request $request, Content $content)
    {
        try {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'slug' => 'nullable|string|max:255|unique:content,slug,' . $content->id,
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'open_time' => 'nullable|date_format:H:i',
            'close_time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        if (!empty($data['name'])) {
            $data['slug'] = Str::slug($data['name'], '-');
        }

        $data['slug'] = Str::slug($data['name'], '-');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imagePath = $file->store('assets/content', 'public'); // simpan ke storage/app/public/content
            $data['image'] = $imagePath;
        }

        $content->update($data);

        return redirect()->route('content.index')->with('success', 'Konten berhasil diupdate.');
        } catch (\Exception $e) {
        return back()
            ->withInput()
            ->with('error', 'Terjadi kesalahan saat mengubah konten: ' . $e->getMessage());
        }
    }
}
