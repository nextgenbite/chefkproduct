<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Traits\BaseTrait;
use Yajra\DataTables\Facades\DataTables;

class ColorController extends Controller
{
    use BaseTrait;
    public $title = ["Color", 'colors'];
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

        $data = Color::latest()->get();
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
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'code', 'code' => 'code', 'title' => 'Code',  'orderable' => false,
            'searchable' => false],
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
        $data = Color::create([
            'title' => $request->title,
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

        $data = Color::findOrFail($id);
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Color  $Color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $page)
    {
        $title = $this->title;
        $data = $page;
        return view('admin.page.edit', compact('data', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Color  $Color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $req = $request->all();
        $data = Color::findOrFail($id)->update($req);
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' Update successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Update Failed'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Color  $Color
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Color::findOrFail($id)->delete();
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
          $data = Color::whereIn('id', $selectedItems)->delete();
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' delete successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }
    public function statusUpdate(Request $request)
    {

        $color = Color::findOrFail($request->id);
            $color->status= !$color->status;
            $data = $color->save();
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' update successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }
}
