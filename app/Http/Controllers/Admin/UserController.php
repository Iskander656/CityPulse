<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::with(['role', 'department'])
            ->when($request->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request->role, function ($query, $role) {
                $query->whereHas('role', function ($query) use ($role) {
                    $query->where('name', $role);
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        $roles = Role::orderBy('name')->get();
        $departments = Department::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.users.create', compact('roles', 'departments'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'exists:roles,id'],
            'department_id' => ['nullable', 'exists:departments,id'],
        ]);

        $role = Role::findOrFail($validated['role_id']);

        if ($role->name === 'department_officer' && empty($validated['department_id'])) {
            return back()
                ->withErrors(['department_id' => 'A department is required for department officers.'])
                ->withInput();
        }

        $user = new User([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        $user->role()->associate($role);

        $user->department()->associate(
            $role->name === 'department_officer'
                ? $validated['department_id']
                : null
        );

        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User account created successfully.');
    }

    public function edit(User $user): View
    {
        $roles = Role::orderBy('name')->get();
        $departments = Department::where('is_active', true)
            ->orderBy('name')
            ->get();

        $user->load(['role', 'department']);

        return view('admin.users.edit', compact(
            'user',
            'roles',
            'departments'
        ));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'exists:roles,id'],
            'department_id' => ['nullable', 'exists:departments,id'],
        ]);

        $role = Role::findOrFail($validated['role_id']);

        // Prevent administrators from accidentally removing their own access.
        if ($user->id === auth()->id() && $user->role->id !== $role->id) {
            return back()
                ->withErrors(['role_id' => 'You cannot change your own administrator role.'])
                ->withInput();
        }

        if ($role->name === 'department_officer' && empty($validated['department_id'])) {
            return back()
                ->withErrors(['department_id' => 'A department is required for department officers.'])
                ->withInput();
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = $validated['password'];
        }

        $user->role()->associate($role);

        $user->department()->associate(
            $role->name === 'department_officer'
                ? $validated['department_id']
                : null
        );

        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User account updated successfully.');
    }
}