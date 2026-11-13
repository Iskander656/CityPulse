@extends('layouts.app')

@section('title', 'Submit Report')

@section('content')

    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-lg-9">

                <div class="card bg-dark text-light border-secondary">

                    <div class="card-body p-4">

                        <h2 class="mb-4">Submit a City Report</h2>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Your report could not be submitted.</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('citizen.reports.store') }}" enctype="multipart/form-data">

                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Report Title</label>

                                <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category</label>

                                <select name="category_id" class="form-select" required>

                                    <option value="">Select category</option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>

                                <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Latitude</label>

                                    <input type="number" step="any" name="latitude" class="form-control"
                                        value="{{ old('latitude') }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Longitude</label>

                                    <input type="number" step="any" name="longitude" class="form-control"
                                        value="{{ old('longitude') }}" required>
                                </div>

                            </div>

                            <div class="mb-3">
                                <label class="form-label">Address</label>

                                <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Attachments</label>

                                <input type="file" name="images[]" class="form-control"
                                    accept="image/jpeg,image/png,image/webp" multiple>

                                <small class="text-secondary">
                                    Maximum 5 images, 5 MB each.
                                </small>
                            </div>

                            <button type="submit" class="btn btn-danger">
                                Submit Report
                            </button>

                            <a href="{{ route('citizen.dashboard') }}" class="btn btn-outline-light">
                                Cancel
                            </a>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
