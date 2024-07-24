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
    public $title = ["Page", 'pages'];
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
                ->addColumn('checkbox', function ($row) {
                    return $this->CrudCheckbox($row);
                })
                ->addColumn('status', function ($row) {
                    return $this->CrudStatus($row);
                })
                ->addColumn('action', function ($row) {
                    return $this->CrudAction($row);
                })
                ->rawColumns(['checkbox', 'action', 'status'])
                ->make(true);
        }
        $columns = [
            [
                'data' => 'checkbox',
                'name' => 'checkbox',
                'title' =>  '<input type="checkbox" class="rounded-full" id="selectAll" />',
                'orderable' => false,
                'searchable' => false
            ],
            [
                'data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'Sl', 'orderable' => false,
                'searchable' => false
            ],
            ['data' => 'title', 'name' => 'title', 'title' => 'Title'],
            [
                'data' => 'status', 'name' => 'status', 'title' => 'Status',
                'orderable' => false,
                'searchable' => false
            ],
            [
                'data' => 'action', 'name' => 'action', 'title' => 'Action',
                'orderable' => false,
                'searchable' => false
            ],
            // [ 'data'=> 'user.name', 'name'=> 'user.name' ],
            // Add more columns as needed
        ];
        $form = [
            [
                'type' => 'text',
                'name' => 'title',
                'label' =>  'Title',
            ],
            [
                'type' => 'textarea',
                'name' => 'body',
                'label' =>  'Content',
            ],
            
        ];
        return view('admin.test.crud', compact('title', 'data', 'columns', 'form'));
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
    public function destroy($id)
    {
        $data = Page::findOrFail($id)->delete();
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' delete successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }
    public function multipleDelete(Request $request)
    {
          //    return  dd($request->selected_ids);
          $selectedItems = $request->input('selected_ids', []);

          // Delete selected items
          $data = Page::whereIn('id', $selectedItems)->delete();
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' delete successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }
    public function statusUpdate(Request $request)
    {

        $page = Page::findOrFail($request->id);
            $page->status= !$page->status;
            $data = $page->save();
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' update successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }
}
