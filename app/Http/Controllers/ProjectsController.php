<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project; //Don't need to require type \app\Project::all(); MUST USE CAPS

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$projects = \app\Project::all(); 
        $projects = Project::all();

        //$projects = auth()=>useR()->projects; future

        //return view('projects.index', ['projects' => $projects]); either or
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(Request $request)
    {
        //
        $project = new Project();
        //return request()->all(); can use to test

        $project->title = request('title');
        $project->description = request('description');
        $project->save();

        return redirect('/projects');
    }*/

    public function store(Request $request)
    {
        Project::create(request(['title', 'description']));

        //use fillable 
        /*Project::create(request()->all()); */

        return redirect('/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $project = Project::findOrFail($id);

        return view('projects.edit', compact('project'));
    }

    /* alternative way 'CLEANER'
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }
    /*

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd(request()->all());

        $project = Project::findOrFail($id);
        $project->title = request('title');
        $project->description = request('description');

        $project->save();
        return redirect('/projects');
    }
    /*public function update(Project $project)
    {
        $project->update(request(['title', 'desciption']));
        
        return redirect('/projects');
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd('hello');
        Project::findOrFail($id)->delete();

        return redirect('/projects');
    }
}
