@extends('layouts.app')
@section('title', 'Submit Report')
@section('content')
<div class="container-fluid cp-report-page py-5 px-3 px-lg-4">
    <div class="cp-report-shell mx-auto">
        <div class="cp-report-heading mb-4">
            <div>
                <span class="cp-eyebrow">CIVICPULSE / CITIZEN PORTAL</span>
                <h1 class="cp-report-title">Report an issue</h1>
                <p class="cp-report-subtitle">Help improve your city. Tell us what happened and where it needs attention.</p>
            </div>
            <a href="{{ route('citizen.dashboard') }}" class="cp-back-link">← Back to dashboard</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger cp-form-alert">
                <strong>Your report could not be submitted.</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success cp-form-alert">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('citizen.reports.store') }}" enctype="multipart/form-data" class="cp-report-form">
            @csrf
            <div class="cp-form-main">
                <section class="cp-form-card">
                    <div class="cp-section-heading">
                        <span class="cp-section-number">01</span>
                        <div>
                            <h2>Issue details</h2>
                            <p>Give your report a clear title and explain the problem.</p>
                        </div>
                    </div>

                    <div class="cp-field mb-4">
                        <label for="report-title" class="form-label">Report title <span>*</span></label>
                        <input id="report-title" type="text" name="title" class="form-control cp-input" value="{{ old('title') }}" placeholder="e.g. Damaged streetlight on Main Street" required>
                    </div>

                    <div class="cp-field mb-4">
                        <label for="report-category" class="form-label">Category <span>*</span></label>
                        <select id="report-category" name="category_id" class="form-select cp-input" required>
                            <option value="">Select the issue category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="cp-field">
                        <label for="report-description" class="form-label">Description <span>*</span></label>
                        <textarea id="report-description" name="description" class="form-control cp-input" rows="6" placeholder="Describe what happened, how it affects the area, and any useful details..." required>{{ old('description') }}</textarea>
                        <div class="cp-field-hint">Please be specific. Clear information helps the city respond faster.</div>
                    </div>
                </section>

                <section class="cp-form-card">
                    <div class="cp-section-heading">
                        <span class="cp-section-number">02</span>
                        <div>
                            <h2>Issue location</h2>
                            <p>Pinpoint where the problem is happening.</p>
                        </div>
                    </div>

                    <div class="cp-location-select-card">
                        <div class="cp-location-icon">⌖</div>
                        <div class="cp-location-select-copy">
                            <strong>Choose the exact location</strong>
                            <span id="location-summary" aria-live="polite">No location selected yet.</span>
                        </div>
                        <button type="button" id="open-location-picker" class="cp-map-button">Choose on map <span>↗</span></button>
                    </div>
                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">

                    <div class="cp-field mt-4">
                        <label for="report-address" class="form-label">Address <span class="cp-optional">(optional)</span></label>
                        <input id="report-address" type="text" name="address" class="form-control cp-input" value="{{ old('address') }}" placeholder="Street, building, or nearby landmark">
                    </div>
                </section>

                <section class="cp-form-card">
                    <div class="cp-section-heading">
                        <span class="cp-section-number">03</span>
                        <div>
                            <h2>Supporting photos</h2>
                            <p>Add images that help explain the issue.</p>
                        </div>
                    </div>
                    <label for="report-images" class="cp-upload-area">
                        <span class="cp-upload-icon">↑</span>
                        <strong>Choose photos to upload</strong>
                        <span>JPG, PNG or WEBP · Up to 5 images · 5 MB each</span>
                        <input id="report-images" type="file" name="images[]" accept="image/jpeg,image/png,image/webp" multiple>
                    </label>
                </section>
            </div>

            <aside class="cp-form-sidebar">
                <div class="cp-sidebar-card">
                    <span class="cp-sidebar-label">BEFORE YOU SUBMIT</span>
                    <h3>A helpful report makes a difference.</h3>
                    <ul class="cp-report-tips">
                        <li><span>✓</span> Use a clear, specific title.</li>
                        <li><span>✓</span> Include useful details.</li>
                        <li><span>✓</span> Select the correct map location.</li>
                        <li><span>✓</span> Add photos when possible.</li>
                    </ul>
                    <div class="cp-sidebar-divider"></div>
                    <p class="cp-privacy-note">Your report will be sent to the CityPulse team for review.</p>
                </div>
                <div class="cp-form-actions">
                    <button type="submit" class="cp-submit-button">Submit complaint <span>→</span></button>
                    <a href="{{ route('citizen.dashboard') }}" class="cp-cancel-link">Cancel and return</a>
                </div>
            </aside>
        </form>
    </div>
</div>

<div id="location-picker" class="cp-location-modal" aria-hidden="true">
    <div class="cp-location-header">
        <div class="cp-location-title">
            <strong>Select report location</strong>
            <span>Search for a place, click the map, or drag the marker.</span>
        </div>
        <button type="button" id="close-location-picker" class="cp-location-close" aria-label="Close map">&times;</button>
    </div>
    <div class="cp-location-toolbar">
        <div class="cp-location-search-wrap">
            <input type="search" id="location-search" placeholder="Search street, building or area..." autocomplete="off">
            <div id="location-search-results" class="cp-location-results"></div>
        </div>
        <button type="button" id="picker-current-location" class="btn btn-outline-info">◎ Use my location</button>
    </div>
    <div class="cp-location-map-wrap"><div id="cp-location-map"></div></div>
    <div class="cp-location-footer">
        <span id="picker-status" aria-live="polite">Click the map to choose a location.</span>
        <div class="d-flex gap-2">
            <button type="button" id="cancel-location-picker" class="btn btn-outline-light">Cancel</button>
            <button type="button" id="confirm-location-picker" class="btn btn-info" disabled>Confirm location</button>
        </div>
    </div>
</div>

<style>

</style>
@endsection