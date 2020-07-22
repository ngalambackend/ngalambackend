<?php

namespace App\Http\Controllers\BackOffice\Settings;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\UserManagement\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backoffice.admins.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson()
    {
        $admin  = Admin::latest()->get();

        return DataTables::of($admin)->addIndexColumn()
            ->editColumn('updated_at', function($admin) {
                return date('d M Y h:i:s', strtotime($admin->updated_at));
            })
            ->addColumn('action', function($admin) {
                return '<div class="button">
                            <button id="edit-admin" type="button" data-admin-id="'.$admin->id.'" class="btn btn-icon btn-sm btn-success"><i class="far fa-edit"></i></button>
                            <button id="delete-admin" data-admin-id="'.$admin->id.'" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </div>';
            })->rawColumns(['action'])->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|unique:admins,email|email'
        ]);

        $admin = new Admin();

        $admin->name        = $request->get('name');
        $admin->email       = $request->get('email');
        $admin->password    = Hash::make('password');
        $admin->save();

        return redirect()->back()->with('success', 'Admin has been created with default password: password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $admin_id)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:admins,email,'.$admin_id.',id'
        ]);

        $admin = Admin::findOrFail($admin_id);

        $admin->name    = $request->get('name');
        $admin->email   = $request->get('email');
        $admin->save();

        alert()->success($admin->name.' Has been changed', 'Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($admin_id)
    {
        Admin::findOrFail($admin_id)->delete();
        alert()->warning('Account has been deleted!', 'Deleted');
        return redirect()->back();
    }
}
