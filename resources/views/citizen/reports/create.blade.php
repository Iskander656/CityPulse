@extends('layouts.app')

@section('title', 'Submit Report')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/citizen/reports/create.css') }}">
    @endpush

    <div class="citizen-report-create-page">
        <div class="citizen-report-create-container">

            <header class="citizen-report-create-header">
                <div class="citizen-report-create-heading">
                    <span class="citizen-report-create-eyebrow">CITIZEN PORTAL / REPORT CENTER</span>
                    <h1>Submit a Report</h1>
                    <p>Help improve your city. Tell us what happened and where it needs attention.</p>
                </div>
                <a href="{{ route('citizen.dashboard') }}" class="citizen-report-create-back">
                    <span aria-hidden="true">←</span>
                    Back to Dashboard
                </a>
            </header>

            @if ($errors->any())
                <div class="citizen-report-create-alert citizen-report-create-alert-error" role="alert">
                    <span class="citizen-report-create-alert-icon" aria-hidden="true">!</span>
                    <div>
                        <strong>Your report could not be submitted.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="citizen-report-create-alert citizen-report-create-alert-success" role="status">
                    <span class="citizen-report-create-alert-icon" aria-hidden="true">✓</span>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <form method="POST" action="{{ route('citizen.reports.store') }}" enctype="multipart/form-data"
                class="citizen-report-create-form">
                @csrf

                <div class="citizen-report-create-main">
                    <section class="citizen-report-create-card">
                        <div class="citizen-report-create-section-heading">
                            <span class="citizen-report-create-step">01</span>
                            <div>
                                <span class="citizen-report-create-section-label">THE ISSUE</span>
                                <h2>Issue Details</h2>
                                <p>Give your report a clear title and explain the problem.</p>
                            </div>
                        </div>

                        <div class="citizen-report-create-field">
                            <label for="report-title">Report title <span>*</span></label>
                            <input id="report-title" type="text" name="title" class="citizen-report-create-input"
                                value="{{ old('title') }}" placeholder="e.g. Damaged streetlight on Main Street" required>
                        </div>

                        <div class="citizen-report-create-field">
                            <label for="report-category">Category <span>*</span></label>
                            <select id="report-category" name="category_id" class="citizen-report-create-input" required>
                                <option value="">Select the issue category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="citizen-report-create-field citizen-report-create-field-last">
                            <label for="report-description">Description <span>*</span></label>
                            <textarea id="report-description" name="description" class="citizen-report-create-input citizen-report-create-textarea"
                                rows="6" placeholder="Describe what happened, how it affects the area, and any useful details..." required>{{ old('description') }}</textarea>
                            <span class="citizen-report-create-hint">Be specific. Clear information helps the city respond
                                faster.</span>
                        </div>
                    </section>

                    <section class="citizen-report-create-card">
                        <div class="citizen-report-create-section-heading">
                            <span class="citizen-report-create-step">02</span>
                            <div>
                                <span class="citizen-report-create-section-label">MAP LOCATION</span>
                                <h2>Issue Location</h2>
                                <p>Pinpoint where the problem is happening.</p>
                            </div>
                        </div>

                        <div class="citizen-report-create-location-select">
                            <span class="citizen-report-create-location-icon" aria-hidden="true">⌖</span>
                            <div class="citizen-report-create-location-copy">
                                <strong>Choose the exact location</strong>
                                <span id="location-summary" aria-live="polite">No location selected yet.</span>
                            </div>
                            <button type="button" id="open-location-picker" class="citizen-report-create-map-button">Choose
                                on map <span aria-hidden="true">↗</span></button>
                        </div>

                        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">

                        <div class="citizen-report-create-field citizen-report-create-address-field">
                            <label for="report-address">Address <span
                                    class="citizen-report-create-optional">(optional)</span></label>
                            <input id="report-address" type="text" name="address" class="citizen-report-create-input"
                                value="{{ old('address') }}" placeholder="Street, building, or nearby landmark">
                        </div>
                    </section>

                    <section class="citizen-report-create-card">
                        <div class="citizen-report-create-section-heading">
                            <span class="citizen-report-create-step">03</span>
                            <div>
                                <span class="citizen-report-create-section-label">VISUAL EVIDENCE</span>
                                <h2>Supporting Photos</h2>
                                <p>Add images that help explain the issue.</p>
                            </div>
                        </div>

                        <label for="report-images" class="citizen-report-create-upload">
                            <span class="citizen-report-create-upload-icon" aria-hidden="true">↑</span>
                            <strong>Choose photos to upload</strong>
                            <span>JPG, PNG or WEBP · Up to 5 images · 5 MB each</span>
                            <input id="report-images" type="file" name="images[]"
                                accept="image/jpeg,image/png,image/webp" multiple>
                        </label>
                    </section>
                </div>

                <aside class="citizen-report-create-sidebar">
                    <div class="citizen-report-create-tips-card">
                        <span class="citizen-report-create-section-label">BEFORE YOU SUBMIT</span>
                        <h2>A helpful report makes a difference.</h2>
                        <ul class="citizen-report-create-tips">
                            <li><span aria-hidden="true">✓</span> Use a clear, specific title.</li>
                            <li><span aria-hidden="true">✓</span> Include useful details.</li>
                            <li><span aria-hidden="true">✓</span> Select the correct map location.</li>
                            <li><span aria-hidden="true">✓</span> Add photos when possible.</li>
                        </ul>
                        <div class="citizen-report-create-sidebar-divider"></div>
                        <p>Your report will be sent to the CityPulse team for review.</p>
                    </div>

                    <div class="citizen-report-create-actions">
                        <button type="submit" class="citizen-report-create-submit">Submit Report <span
                                aria-hidden="true">→</span></button>
                        <a href="{{ route('citizen.dashboard') }}" class="citizen-report-create-cancel">Cancel and
                            return</a>
                    </div>
                </aside>
            </form>

            <footer class="citizen-report-create-footer">
                <span>CityPulse · Citizen Report Center</span>
                <span>Your voice helps improve the city.</span>
            </footer>
        </div>
    </div>

    <div id="location-picker" class="citizen-report-create-modal" aria-hidden="true">
        <div class="citizen-report-create-modal-header">
            <div class="citizen-report-create-modal-title">
                <strong>Select report location</strong>
                <span>Search for a place, click the map, or drag the marker.</span>
            </div>
            <button type="button" id="close-location-picker" class="citizen-report-create-modal-close"
                aria-label="Close map">&times;</button>
        </div>

        <div class="citizen-report-create-modal-toolbar">
            <div class="citizen-report-create-search-wrap">
                <input type="search" id="location-search" placeholder="Search street, building or area..."
                    autocomplete="off">
                <div id="location-search-results" class="citizen-report-create-search-results"></div>
            </div>
            <button type="button" id="picker-current-location" class="citizen-report-create-current-location">◎ Use my
                location</button>
        </div>

        <div class="citizen-report-create-map-wrap">
            <div id="cp-location-map"></div>
        </div>

        <div class="citizen-report-create-modal-footer">
            <span id="picker-status" aria-live="polite">Click the map to choose a location.</span>
            <div class="citizen-report-create-modal-actions">
                <button type="button" id="cancel-location-picker"
                    class="citizen-report-create-modal-cancel">Cancel</button>
                <button type="button" id="confirm-location-picker" class="citizen-report-create-modal-confirm"
                    disabled>Confirm location</button>
            </div>
        </div>
    </div>

@endsection
