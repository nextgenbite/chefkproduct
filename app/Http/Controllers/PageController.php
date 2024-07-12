<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PageController extends Controller
{
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
        $title =$this->title;
        return view('admin.page.create', compact('title'));
    }
    public function index(Request $request)
    {
        $title =$this->title;

        $data = Page::latest()->get();
        if ($request->ajax()) {
  
  
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn=   '<button id="'. $row->id.'-dropdown-button"
                                            data-dropdown-toggle="'. $row->id.'-dropdown"
                                            class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div id="'. $row->id.'-dropdown"
                                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="'. $row->id.'-dropdown-button">
                                                <li>
                                                    <a href="javascript:void(0)"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                                                </li>
                                                <li>
                                                    <a  data-modal-target="data-modal" data-modal-toggle="data-modal"
                                                    data-id="'.$row->id.'" data-original-title="Edit"
                                                        href="javascript:void(0)"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white editData">Edit</a>

                                                </li>
                                            </ul>
                                            <div class="py-1">
                                                <a href="javascript:void(0)"
                                                
                                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                                            </div>
                                        </div>';
   
                        //    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
   
                        //    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.page.index', compact('title','data'));
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
            'title'=> $request->title,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
            'status'=> $request->status ?: 0,
        ]);
    
        if ($data) {
            return response()->json(['message' => 'Brand Update successfully', 'data'=> $data] ,200);
        } else {
            return response()->json(['message'=> 'Brand Update Failed'] ,404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $title =$this->title;
        $data =$page;
        return view('admin.page.edit', compact('data','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $req = $request->all();
        $req['slug'] =  Str::slug($request->title);
        $page->update($req);
        $notification = array(
            'messege' => 'page is update successfully!',
            'alert-type' => 'success'
        );
        return redirect('/admin/page')->with($notification);
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
