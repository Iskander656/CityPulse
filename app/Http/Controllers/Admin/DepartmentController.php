<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    public function index(): View
    {
        $departments = Department::withCount(['officers', 'reports'])
            ->orderBy('name')
            ->paginate(15);

        return view('admin.departments.index', compact('departments'));
    }

    public function create(): View
    {
        return view('admin.departments.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:departments,name'],
            'description' => ['nullable', 'string', 'max:1000'],
            'contact_email' => ['nullable', 'email', 'max:255'],
        ]);

        Department::create([
            ...$validated,
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.departments.index')
            ->with('success', 'Department created successfully.');
    }

    public function edit(Department $department): View
    {
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments', 'name')->ignore($department->id),
            ],
            'description' => ['nullable', 'string', 'max:1000'],
            'contact_email' => ['nullable', 'email', 'max:255'],
        ]);

        $department->update($validated);

        return redirect()
            ->route('admin.departments.index')
            ->with('success', 'Department updated successfully.');
    }

    public function toggleStatus(Department $department): RedirectResponse
    {
        $department->update([
            'is_active' => !$department->is_active,
        ]);

        return redirect()
            ->route('admin.departments.index')
            ->with('success', 'Department status updated successfully.');
    }
}