<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project;
        $techs = Technology::orderBy('label')->get();
        return view('admin.projects.create', compact('project', 'techs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validation($request->all());
        $project = new Project;
        $project->fill($data);
        $project->save();
        if(Arr::exists($data, "techs")) $project->technologies()->attach($data["techs"]);

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $techs = Technology::orderBy('label')->get();
        $project_tech = $project->technologies->pluck('id')->toArray();
        return view('admin.projects.edit', compact('project','techs','project_tech'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = $this->validation($request->all());
        $project->update($data);

        if(Arr::exists($data, "techs"))
            $project->technologies()->sync($data["techs"]);
        else
            $project->technologies()->detach();

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }

    private function validation($data) {
        return Validator::make(
            $data,
            [
                'name'=>'required|string|max:30',
                'type_id'=>'required|integer|between:1,3',
                'description'=>'required|string|max:750',
                'link'=>'nullable',
                'techs'=>'nullable|exists:technologies,id',
            ],
            [
                'name.required'=>'Il nome è obbligatorio',
                'description.required'=>'La descrizione è richiesta',
                'techs.exists'=>'Le tecnologie selezionate non sono valide'
            ]
        )->validate();
    }
}
