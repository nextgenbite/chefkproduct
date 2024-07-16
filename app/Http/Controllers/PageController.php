<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Traits\BaseTrait;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PageController extends Controller
{
    use BaseTrait;
    public $title = ["Page", 'page'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = $this->title;
        return view('admin.page.create', compact('title'));
    }
    public function index(Request $request)
    {
        $title = $this->title;

        $data = Page::latest()->get();
        
        if ($request->ajax()) {

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return $this->CrudStatus($row);
                })
                ->addColumn('action', function ($row) {
                    return $this->CrudAction($row);
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.page.index', compact('title', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
            'status' => $request->status ?: 0,
        ]);

        if ($data) {
            return response()->json(['message' => $this->title[0] . ' Create successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Create Failed'], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Page::findOrFail($id);
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $title = $this->title;
        $data = $page;
        return view('admin.page.edit', compact('data', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $req = $request->all();
        $req['slug'] =  Str::slug($request->title);
        $data = Page::findOrFail($id)->update($req);
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' Update successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Update Failed'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        $notification = array(
            'messege' => 'page is delete successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
