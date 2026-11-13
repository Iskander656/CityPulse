<div class="mb-3">
    <label class="form-label">Full Name</label>
    <input type="text" name="name" class="form-control bg-dark text-light border-secondary"
        value="{{ old('name', $user->name ?? '') }}" required>
    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Email Address</label>
    <input type="email" name="email" class="form-control bg-dark text-light border-secondary"
        value="{{ old('email', $user->email ?? '') }}" required>
    @error('email')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Role</label>
    <select name="role_id" class="form-select bg-dark text-light border-secondary" required>
        <option value="">Select role</option>

        @foreach ($roles as $role)
            <option value="{{ $role->id }}" @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                {{ ucwords(str_replace('_', ' ', $role->name)) }}
            </option>
        @endforeach
    </select>
    @error('role_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Department</label>
    <select name="department_id" class="form-select bg-dark text-light border-secondary">
        <option value="">No department</option>

        @foreach ($departments as $department)
            <option value="{{ $department->id }}" @selected(old('department_id', $user->department_id ?? '') == $department->id)>
                {{ $department->name }}
            </option>
        @endforeach
    </select>
    @error('department_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    <small class="text-secondary">
        Required when the selected role is Department Officer.
    </small>
</div>

<div class="mb-3">
    <label class="form-label">
        Password {{ isset($user) ? '(leave blank to keep current password)' : '' }}
    </label>

    <input type="password" name="password" class="form-control bg-dark text-light border-secondary"
        {{ isset($user) ? '' : 'required' }}>

    @error('password')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Confirm Password</label>
    <input type="password" name="password_confirmation" class="form-control bg-dark text-light border-secondary"
        {{ isset($user) ? '' : 'required' }}>
</div>
