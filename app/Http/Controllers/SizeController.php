<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Traits\BaseTrait;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    use BaseTrait;
    public $title = ["Size", 'sizes'];
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
        return view('admin.Size.create', compact('title'));
    }
    public function index(Request $request)
    {
        $title = $this->title;

        $data = Size::latest()->get();
        if ($request->ajax()) {

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return $this->CrudCheckbox($row);
                })
                ->addColumn('action', function ($row) {
                    return $this->CrudAction($row);
                })
                ->rawColumns(['checkbox', 'action'])
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
                'name' => 'name',
                'label' =>  'Name',
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
        $data = Size::create([
            'name' => $request->name,
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
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Size::findOrFail($id);
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        $title = $this->title;
        $data = $size;
        return view('admin.Size.edit', compact('data', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $req = $request->all();
        $data = Size::findOrFail($id)->update($req);
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' Update successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Update Failed'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Size::findOrFail($id)->delete();
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
          $data = Size::whereIn('id', $selectedItems)->delete();
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' delete successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }
    public function statusUpdate(Request $request)
    {

        $size = Size::findOrFail($request->id);
            $size->status= !$size->status;
            $data = $size->save();
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' update successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }
}
