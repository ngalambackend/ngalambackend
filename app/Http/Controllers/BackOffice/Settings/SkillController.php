<?php

namespace App\Http\Controllers\BackOffice\Settings;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Settings\Skill;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backoffice.settings.skills.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson()
    {
        $skill  = Skill::latest()->get();

        return DataTables::of($skill)->addIndexColumn()
            ->editColumn('updated_at', function($skill) {
                return date('d M Y h:i:s', strtotime($skill->updated_at));
            })
            ->addColumn('action', function($skill) {
                return '<div class="button">
                            <button id="edit-skill" type="button" data-skill-id="'.$skill->id.'" class="btn btn-icon btn-sm btn-success"><i class="far fa-edit"></i></button>
                            <button id="delete-skill" data-skill-id="'.$skill->id.'" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i></button>
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
        ]);

        $skill = new Skill;

        $skill->name        = $request->get('name');
        $skill->slug        = str::slug($request->get('name'));
        $skill->save();

        return redirect()->back()->with('success', 'Skill has been created with slug: '.$skill->slug);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $skill_id)
    {
        $request->validate([
            'name'      => 'required',
        ]);

        $skill = Skill::findOrFail($skill_id);

        $skill->name    = $request->get('name');
        $skill->slug    = str::slug($request->get('name'));
        $skill->save();

        alert()->success($skill->name.' Has been changed', 'Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($skill_id)
    {
        Skill::findOrFail($skill_id)->delete();
        alert()->warning('Skill has been deleted!', 'Deleted');
        return redirect()->back();
    }
}
