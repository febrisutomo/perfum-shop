<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'items' => Item::with('category')->latest()->get(),
        ];
        return view('admin.item.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'brands' => Brand::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
        ];
        return view('admin.item.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->images);

        $validated = $request->validate([
            'name' => 'required|unique:items|max:255',
            'brand_id' => 'required|integer',
            'category_id' => 'required|integer',
            'summary' => 'required|string|max:500',
            'description' => 'required|string|max:1000',
            'ingredients' => 'required|string|max:1000',
            'cost_price' => 'required|numeric',
            'price' => 'required|numeric|gte:cost_price',
            'stock' => 'required|numeric',
            'is_active' => 'required|boolean',
            'images' => 'required',
            'images.*.path' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        // dd($validated);

        $validated['slug'] = Str::slug($request->name);

        $images = [];
        foreach ($request->images as $image) {
            $file = $image['path'];
            $name = $file->hashName();
            $file->move(public_path('images/product/'), $name);
            $images[] = [
                'uuid' => $image['uuid'],
                'path' => $name
            ];
        }

        $validated['images'] = $images;

        Item::create($validated);

        return to_route('admin.item.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {

        // dd($item->images);
        $data = [
            'item' => $item->load('category', 'brand'),
            'brands' => Brand::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
        ];
        return view('admin.item.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        // dd($request->is_active);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'brand_id' => 'required|integer',
            'category_id' => 'required|integer',
            'summary' => 'required|string|max:500',
            'description' => 'required|string|max:1000',
            'ingredients' => 'required|string|max:1000',
            'cost_price' => 'required|numeric',
            'price' => 'required|numeric|gte:cost_price',
            'stock' => 'required|numeric',
            'is_active' => 'required|boolean',
            'images' => 'required',
            'images.*.path' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        // dd($validated);

        // generate slug 
        $validated['slug'] = Str::slug($request->name);

        if ($item->slug != $validated['slug'] && Item::where('slug', Str::slug($request->name))->count() > 0) {
            $validated['slug'] .= '-' . str::lower(Str::random(3));
        }

        // upload images 
        $oldImages = collect($item->images);

        $notDeletedUUID = collect($request->images)->whereNull('path')->pluck('uuid');

        $notDeleted = $oldImages->whereIn('uuid', $notDeletedUUID);

        $deleted = $oldImages->whereNotIn('uuid', $notDeletedUUID)->pluck('path')->toArray();

        foreach ($deleted as $image) {
            if (File::exists('images/product/' . $image) && $image != 'default.jpg') {
                File::delete('images/product/' . $image);
            }
        }

        $newImages = collect($request->images)->whereNotNull('path');

        $images = [];

        foreach($notDeleted as $image) {
            $images[] = [
                'uuid' => $image['uuid'],
                'path' => $image['path'],
            ];
        }

        if ($newImages->count() > 0) {
            foreach ($newImages as $image) {
                $file = $image['path'];
                $name = $file->hashName();
                $file->move(public_path('images/product/'), $name);
                $images[] = [
                    'uuid' => $image['uuid'],
                    'path' => $name,
                ];
            }

        }

        $validated['images'] = $images;

        $item->update($validated);

        return to_route('admin.item.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        foreach ($item->images as $image) {
            if (File::exists('images/product/' . $image['path']) && $image['path'] != 'default.jpg') {
                File::delete('images/product/' . $image['path']);
            }
        }

        return to_route('admin.item.index')->with('success', 'Data berhasil dihapus!');
    }
}
