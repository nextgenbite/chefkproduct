<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\BaseTrait;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    use ImageUploadTrait, BaseTrait;

    private $title = ['Users', 'users'];
    private $imgLocation = "images/users";


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $this->title;

        $data = User::latest()->get();
        if ($request->ajax()) {

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return $this->CrudCheckbox($row);
                })
                ->addColumn('avatar', function ($row) {
                    return $this->CrudImage($row->thumbnail);
                })
                ->addColumn('status', function ($row) {
                    return $this->CrudStatus($row);
                })
                ->addColumn('action', function ($row) {
                    return $this->CrudAction($row);
                })
                ->rawColumns(['checkbox', 'avatar', 'action', 'status'])
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
            [
                'data' => 'avatar', 'name' => 'avatar', 'title' => 'Avatar',
                'orderable' => false,
                'searchable' => false
            ],
            ['data' => 'name', 'name' => 'name', 'name' => 'Name'],
            [
                'data' => 'status', 'name' => 'status', 'title' => 'Status', 'sClass' => 'text-center',
                'orderable' => false,
                'searchable' => false
            ],
            [
                'data' => 'action', 'name' => 'action', 'title' => 'Action', 'sClass' => 'text-center',
                'orderable' => false,
                'searchable' => false
            ],
            // [ 'data'=> 'user.name', 'name'=> 'user.name' ],
            // Add more columns as needed
        ];
        $roles = Role::where('guard_name', 'web')->get();
        $form = [
            [
                'type' => 'text',
                'name' => 'name',
                'label' =>  'Name',
                'class' => 'col-span-3',
            ],
            [
                'type' => 'email',
                'name' => 'email',
                'label' =>  'Email',
                'class' => 'col-span-3',
            ],
            [
                'type' => 'number',
                'name' => 'phone',
                'label' =>  'Phone',
                'class' => 'col-span-3',
            ],
            [
                'type' => 'select',
                'name' => 'role_id',
                'label' =>  'Role',
                'data' =>  $roles,
                'key' =>  'name',
                'class' => 'col-span-3',
            ],
            [
                'type' => 'textarea',
                'name' => 'address',
                'label' =>  'Address',
            ],
            [
                'type' => 'image',
                'name' => 'avatar',
                'label' =>  'Avatar',
            ],
          

        ];
        return view('admin.test.crud', compact('title', 'data', 'columns', 'form'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customers()
    {
        $data = User::role('customer')->get();
        return response()->json($data, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize('User.create');

        $avatar = "";
        if ($request->avatar) {
            $avatar = $this->uploadBase64Image($request->input('avatar'), $this->imgLocation);
        }
        $data = User::create([
            'name' => $request->icon,
            'phone' => $request->title,
            'avatar' => $avatar
        ]);
        if ($data) {
            return response()->json(['message' => 'Data Create successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => 'Data Create Failed'], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::with('roles')->findOrFail($id);
        if ($data) {
            return response()->json(['message' => 'Data successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => 'Data Get Failed'], 404);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = User::findOrFail($id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        // Handle image update
        if ($request->newavatar) {
            $this->deleteImage($data->avatar);
            $data->avatar = $this->uploadBase64Image($request->newavatar, $this->imgLocation);
        }
        $data->update();
        if ($data) {
            return response()->json(['message' => 'Data Update successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => 'Data Update Failed'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $this->deleteImage($data->avatar);
        $data->delete();

        if ($data) {
            return response()->json(['message' => 'Data Deleted successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => 'Data Delete Failed'], 500);
        }
    }
    public function multipleDelete(Request $request)
    {
        //    return  dd($request->selected_ids);
        $selectedItems = $request->input('selected_ids', []);

        // Delete selected items
        $data = User::whereIn('id', $selectedItems)->delete();
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' delete successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }
    public function statusUpdate(Request $request)
    {

        $page = User::findOrFail($request->id);
        $page->status = !$page->status;
        $data = $page->save();
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' update successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }
}
