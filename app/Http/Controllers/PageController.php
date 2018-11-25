<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //show all pages
        $pages = Page::all();
        return view('management.pages.index')->withPages($pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //redirect to create page
        return view('management.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $this->validate($request, [
            'title' => 'required|string|max:255|min:5|unique:pages,title',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:pages,slug',
            'body' => 'sometimes'
        ]);

        $page = new Page();
        $page->title = ucwords($request->title);
        $page->slug = $request->slug;
        $page->body = $request->body;
        if ($request->has('draft')) {
            $page->status = 0;
        } elseif ($request->has('publish')) {
            $page->status = 1;
        }
        $page->save();

        $request->session()->flash('flash_message', 'New Page Created Successfully.');
        return redirect()->route('pages.show', $page->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $page = Page::findOrFail($id);
        return view('management.pages.show')->withPage($page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $page = Page::findOrFail($id);
        return view('management.pages.edit')->withPage($page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        //
        $id = $page->id;

        $this->validate($request, [
            'title' => 'required|string|max:255|min:5|unique:pages,title,'.$id,
            'body' => 'sometimes'
        ]);

        $page->title = ucwords($request->title);
        // $page->slug = $request->slug;
        $page->body = $request->body;
        if ($request->has('draft')) {
            $page->status = 0;
        } elseif ($request->has('publish')) {
            $page->status = 1;
        }
        $page->save();

        $request->session()->flash('flash_message', 'Page Updated Successfully.');
        return redirect()->route('pages.show', $page->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //delete a page
        $page->delete();
        Session::flash('flash_message', 'Page deleted successfully.');
        return redirect('/pages');
    }
}
