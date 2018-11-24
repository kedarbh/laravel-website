<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Nullable;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //list all the availabe packages to the admin
        $packages = Package::all();
        return view('management.packages.index')->withPackages($packages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return create view
        return view('management.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($features);
        $this->validate($request, [
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|max:255|unique:packages',
            'content' => 'sometimes',
            'feature' => 'required|array',
            'feature.*' => 'required|string|distinct|max:255',
            'price' => 'sometimes|integer',
            'featured_image' => 'image|nullable|max:2048'
        ]);

        if ($request->hasFile('featured_image')) {
            //file name with extension
            // $orignalName = $request->file('featured_image')->getClientOriginalName();
            // $filename = pathinfo($orignalName, PATHINFO_FILENAME);
            // rename image with package slug
            $filename = $request->slug;
            //extract extension of uploaded file
            $ext = $request->file('featured_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$ext;
            $path = $request->file('featured_image')->storeAs('public/featured_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        //get the status of package
        $status;

        if ($request->has('draft')) {
            $status = 0;
        } elseif ($request->has('publish')) {
            $status = 1;
        }

        //list features in array
        // $arr = [];
        // $features = $request->feature;
        // foreach ($features as $feature) {
        //     array_push($arr, $feature);
        // }

        $package = new Package();
        $package->title = ucwords($request->title);
        $package->slug = $request->slug;
        $package->content = $request->content;
        $package->feature = json_encode($request->feature);
        $package->price = $request->price;
        $package->image = $fileNameToStore;
        $package->status = $status;
        $package->save();
        // dd($package->feature);

        $request->session()->flash('flash_message', $package->title.' Package saved successfully');
        return redirect()->route('packages.show', $package->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $package = Package::findOrFail($id);
        return view('management.packages.show')->withPackage($package);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $package = Package::findOrFail($id);
        return view('management.packages.edit')->withPackage($package);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        //
    }
}
