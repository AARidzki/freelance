<?php

namespace App\Http\Controllers;

use App\Models\Project;
// use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\PDF;
// use Barryvdh\DomPDF\PDF;
// use Barryvdh\DomPDF\Facade as PDF;
// use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class DashboardProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.projects.index', [
            'projects' => Project::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis' => 'required|max:255',
            'qty' => 'required|max:255',
            'keterangan' => 'required|max:255',
            'perbaikan' => 'required|max:255',
            'status' => 'required|max:255',
            'sebelum' => 'image|file|max:1024',
            'pengerjaan' => 'image|file|max:1024',
            'sesudah' => 'image|file|max:1024',
        ]);

        if($request->file('sebelum')) {
            $validatedData['sebelum'] = $request->file('sebelum')->store('sebelum-images');
        }

        if($request->file('pengerjaan')) {
            $validatedData['pengerjaan'] = $request->file('pengerjaan')->store('pengerjaan-images');
        }

        if($request->file('sesudah')) {
            $validatedData['sesudah'] = $request->file('sesudah')->store('sesudah-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        // $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Project::create($validatedData);

        return redirect('/dashboard/projects')->with('success', 'New project has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('dashboard.projects.edit', [
            'project' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $rules = [
            'jenis' => 'required|max:255',
            'qty' => 'required|max:255',
            'keterangan' => 'required|max:255',
            'perbaikan' => 'required|max:255',
            'status' => 'required|max:255',
            'sebelum' => 'image|file|max:1024',
            'pengerjaan' => 'image|file|max:1024',
            'sesudah' => 'image|file|max:1024',
        ];


        // if($request->id != $project->id) {
        //     $rules['id'] = 'required|unique:projects';
        // }

        $validatedData = $request->validate($rules);

        // if($request->file('sebelum')) {
        //     if($request->oldImage) {
        //         Storage::delete($request->oldImage);
        //     }
        //     $validatedData['sebelum'] = $request->file('sebelum')->store('sebelum-images');
        // }

        // if($request->file('pengerjaan')) {
        //     if($request->oldImage) {
        //         Storage::delete($request->oldImage);
        //     }
        //     $validatedData['pengerjaan'] = $request->file('pengerjaan')->store('pengerjaan-images');
        // }

        // if($request->file('sesudah')) {
        //     if($request->oldImage) {
        //         Storage::delete($request->oldImage);
        //     }
        //     $validatedData['sesudah'] = $request->file('sesudah')->store('sesudah-images');
        // }

        if($request->file('sebelum') || $request->file('pengerjaan') || $request->file('sesudah')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['sebelum'] = $request->file('sebelum')->store('sebelum-images');
            $validatedData['pengerjaan'] = $request->file('pengerjaan')->store('pengerjaan-images');
            $validatedData['sesudah'] = $request->file('sesudah')->store('sesudah-images');
        }

        // $validatedData['user_id'] = auth()->user()->id;
        // $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Project::where('id', $project->id)
            -> update($validatedData);

        return redirect('/dashboard/projects')->with('success', 'Project has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // if($project->sebelum) {
        //     Storage::delete($project->sebelum);
        // }
        // if($project->pengerjaan) {
        //     Storage::delete($project->pengerjaan);
        // }
        // if($project->sesudah) {
        //     Storage::delete($project->sesudah);
        // }

        if($project->sebelum || $project->pengerjaan || $project->sesudah) {
            Storage::delete($project->sebelum);
            Storage::delete($project->pengerjaan);
            Storage::delete($project->sesudah);
        }

        Project::destroy($project->id);

        return redirect('/dashboard/projects')->with('success', 'Project has been deleted!');
    }

    public function pdf()
    {

        set_time_limit(36000);

    	$projects = Project::all();
 
        $pdf = app('dompdf.wrapper')->loadView('/dashboard/projects/pdf', compact('projects'));
        // return $pdf->stream('laporan-project.pdf');
    	return $pdf->download('laporan-project.pdf');
    }
    
    
}

