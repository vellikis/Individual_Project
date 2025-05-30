<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //users listing with sorting
    public function index(Request $request)
    {
        $authUser = Auth::user();

        // sort options
        $allowedSorts = [
            'created_at' => 'users.created_at',
            'name'      => 'name',
            'email'     => 'email',
            'user_type' => 'user_type',
        ];

        // created at is default
        $sort      = $request->query('sort', 'created_at');
        $direction = strtolower($request->query('direction', 'desc')) === 'asc' ? 'asc' : 'desc';

        $orderColumn = $allowedSorts[$sort] ?? 'created_at';

        //if partner show only participants
        $baseQuery = $authUser->user_type === 'partner'
            ? User::where('user_type', 'participant')
            : User::query();

        // pagination
        $users = $baseQuery
            ->orderBy($orderColumn, $direction)
            ->paginate(10)
            ->appends([
                'sort'      => $sort,
                'direction' => $direction,
            ]);

        return view('users', compact('users', 'sort', 'direction'));
    }

    // User create
    public function create()
    {
        $projects = Project::all();
        return view('users.create', compact('projects'));
    }

    
    //store new user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:8|confirmed',
            'user_type'  => 'required|string|max:255',
            'projects'   => 'nullable|array',
            'projects.*' => 'exists:projects,id',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        if ($request->filled('projects')) {
            $user->projects()->attach($request->input('projects'));
        }

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * show specified user
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * speficifed user edit 
     */
    public function edit(User $user)
    {
        $user->load('projects');
        $projects = Project::all();
        return view('users.edit', compact('user', 'projects'));
    }

    /**
     * specified user update
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => "required|string|email|max:255|unique:users,email,{$user->id}",
            'user_type'  => 'required|string|max:255',
            'projects'   => 'nullable|array',
            'projects.*' => 'exists:projects,id',
        ]);

        $user->update($validated);
        $user->projects()->sync($request->input('projects', []));

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * specified user delete
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted.');
    }
}
