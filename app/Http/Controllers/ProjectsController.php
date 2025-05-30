<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // sort option
        $allowedSorts = [
            'created_at'   => 'projects.created_at',
            'title'        => 'projects.title',
            'department'   => 'projects.department',
            'status'       => 'projects.status',
            'partner_name' => 'projects.partner_name',
        ];

        // created at default
        $sort      = $request->query('sort', 'created_at');
        $direction = strtolower($request->query('direction', 'desc')) === 'asc' ? 'asc' : 'desc';

        // order column
        $orderColumn = $allowedSorts[$sort] ?? 'projects.created_at';

        // participants and partners see only linked projects
        // admins, visitors, and public visitors see all projects
        if (in_array($user->user_type, ['participant', 'partner'], true)) {
            $baseQuery = $user->projects()->getQuery();
        } else {
            $baseQuery = Project::query();
        }

        $baseQuery->select('projects.*');

        // ordering and pagination
        $projects = $baseQuery
            ->orderBy($orderColumn, $direction)
            ->paginate(10)
            ->appends([
                'sort'      => $sort,
                'direction' => $direction,
            ]);

        return view('projects.index', compact('projects', 'sort', 'direction'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'participants'  => 'nullable|string',
            'images.*'      => 'image|mimes:jpg,png,jpeg,gif|max:2048',
            'partner_name'  => 'required|string|max:255',
            'partner_link'  => 'required|url',
            'department'    => 'required|string|max:255',
            'status'        => 'required|string|max:255',
        ]);

        $project = Project::create($validated);

        // Attach project creator
        $project->users()->attach($request->user()->id);

        // Store images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('projects', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project created successfully!');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        //Participants can only update the description
        if ($request->user()->user_type === 'participant') {
            $validated = $request->validate([
                'description' => 'required|string',
            ]);

            $project->update($validated);

            return redirect()
                ->route('projects.index')
                ->with('success', 'Project description updated successfully!');
        }

        //Full validation for admins and partners
        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'required|string',
            'participants'    => 'nullable|string',
            'partner_name'    => 'required|string|max:255',
            'partner_link'    => 'required|url',
            'department'      => 'required|string|max:255',
            'status'          => 'required|string|max:255',
            'images.*'        => 'image|mimes:jpg,png,jpeg,gif|max:2048',
            'delete_images'   => 'nullable|array',
            'delete_images.*' => 'exists:project_images,id',
        ]);

        //Remove any checked images
        if ($request->filled('delete_images')) {
            $toDelete = ProjectImage::whereIn('id', $request->input('delete_images'))->get();
            foreach ($toDelete as $img) {
                Storage::delete('public/' . $img->image_path);
                $img->delete();
            }
        }

        //Store new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('projects', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                ]);
            }
        }

        //Update the project record
        $project->update($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        // delete all associated images
        foreach ($project->images as $img) {
            Storage::delete('public/' . $img->image_path);
            $img->delete();
        }

        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}
