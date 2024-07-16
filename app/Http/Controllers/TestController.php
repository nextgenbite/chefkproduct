<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TestController extends Controller
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
        $title = ["CRUD", 'crud'];
        return view('admin.page.create', compact('title'));
    }
    public function index(Request $request)
    {
        $title = ["CRUD", 'crud'];;

        $data = Page::latest()->get();
        if ($request->ajax()) {


            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<label class="inline-flex items-center cursor-pointer">
  <input type="checkbox" value="" class="sr-only peer" checked>
  <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white  after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>

</label>';
                    } else {
                    }
                })
                ->rawColumns(['status'])
                // ->addColumn('action', function($row){

                //     $btn=   ' <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                //                             aria-labelledby="'. $row->id.'-dropdown-button">
                //                             <li>
                //                                 <a href="javascript:void(0)"
                //                                     class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                //                             </li>
                //                             <li>
                //                                 <a  data-modal-target="data-modal" data-modal-toggle="data-modal"
                //                                 data-id="'.$row->id.'" data-original-title="Edit"
                //                                     href="javascript:void(0)"
                //                                     class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white editData">Edit</a>

                //                             </li>
                //                         </ul>';

                //     //    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                //     //    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                //         return $btn;
                // })
                // ->rawColumns(['action'])
                ->make(true);
        }
        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'Sl'],
            ['data' => 'title', 'name' => 'title', 'title' => 'Title'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
            // [ 'data'=> 'user.name', 'name'=> 'user.name' ],
            // Add more columns as needed
        ];
        return view('admin.test.crud', compact('title', 'data', 'columns'));
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
            return response()->json(['message' => 'Brand Update successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => 'Brand Update Failed'], 404);
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
            return response()->json(['message' => 'Data successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => 'Data Get Failed'], 404);
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
