@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />
    <style>

        .page-wrapper {
            background: #f5f7fa;
            min-height: 100vh;
            padding: 20px;
        }

        .page-box {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 25px;
        }

        .form-section {
            background: #f9fafb;
            border-radius: 10px;
            padding: 20px;
            border: 1px solid #e0e0e0;
            margin-bottom: 25px;
        }

        .form-header {
            border-bottom: 2px solid #007bff;
            margin-bottom: 20px;
            padding-bottom: 8px;
        }

        .btn-primary {
            background: linear-gradient(90deg, #007bff, #0056b3);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #0056b3, #003d80);
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.07);
        }

        .card-header {
            background: #007bff;
            color: #fff;
            border-radius: 10px 10px 0 0;
        }

        .accordion-button:not(.collapsed) {
            background-color: #e7f1ff;
            color: #0c63e4;
        }

        .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, .25);
        }

        .img-preview {
            max-height: 80px;
            width: auto;
            display: none;
            margin-top: 8px;
        }

        .dynamic-item {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background: #fdfdfd;
        }
        /* All accordion header text */
.accordion-button {
    color: #17ac44; /* dark blue */
}

        
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-box">

            <!-- HEADER -->
            <div class="row mb-4 align-items-center">
                <div class="col-md-6">
                    <h3 class="page-title mb-0">
                        <i class="fas fa-file-alt me-2 text-primary"></i> Capabilities Menu Pages
                    </h3>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('capsubmenu.index') }}">Capabilities-submenu</a></li>
                        <li class="breadcrumb-item active">Capabilities Pages</li>
                    </ol>
                </div>
            </div>

            <!-- SUCCESS / ERROR ALERTS -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- CREATE / EDIT FORM (Accordion style) -->
            <div class="accordion mb-5" id="pageFormAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingPageForm">
                        <button class="accordion-button {{ isset($editPage) ? '' : 'collapsed' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapsePageForm">
                            <i class="fas fa-plus-circle me-2"></i>
                            {{ isset($editPage) ? 'Edit Page for ' . $editPage->menu->menu_name : 'Create New Page' }}
                        </button>
                    </h2>

                    <div id="collapsePageForm" class="accordion-collapse collapse {{ isset($editPage) ? 'show' : '' }}"
                        data-bs-parent="#pageFormAccordion">
                        <div class="accordion-body">
                            <div class="form-section">

                                <form
                                    action="{{ isset($editPage) ? route('capsubmenu.pages.update', ['menu' => $editPage->menu_id, 'page' => $editPage->id]) : route('capsubmenu.pages.store') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if (isset($editPage))
                                        @method('PUT')
                                    @endif

                                    <!-- Menu selection / display -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Linked Menu</label>
                                        @if (isset($editPage))
                                            <div class="alert alert-info py-2">
                                                <strong>{{ $editPage->menu->menu_name }}</strong>
                                            </div>
                                            <input type="hidden" name="menu_id" value="{{ $editPage->menu_id }}">
                                        @else
                                            <select name="menu_id" class="form-select" required>
                                                <option value="">-- Select Capabilities Menu --</option>
                                                @foreach ($menus as $menu)
                                                    <option value="{{ $menu->id }}"
                                                        {{ old('menu_id') == $menu->id ? 'selected' : '' }}>
                                                        {{ $menu->menu_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>

                                    <!-- Template Selector -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Page Template <span
                                                class="text-danger">*</span></label>
                                        <select name="template" id="templateSelect" class="form-select" required>
                                            <option value="">-- Choose Template --</option>
                                            <option value="template_1"
                                                {{ old('template', $editPage->template ?? '') == 'template_1' ? 'selected' : '' }}>
                                                Template 1 – Capabilities Layout
                                            </option>
                                            <option value="template_2"
                                                {{ old('template', $editPage->template ?? '') == 'template_2' ? 'selected' : '' }}>
                                                Template 2 – Tooling Layout
                                            </option>
                                            <option value="template_3"
                                                {{ old('template', $editPage->template ?? '') == 'template_3' ? 'selected' : '' }}>
                                                Template 3 – Automation Layout
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Slug -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">URL Slug</label>
                                        <input type="text" name="slug" class="form-control"
                                            value="{{ old('slug', $editPage->slug ?? '') }}"
                                            placeholder="e.g. capabilities-overview" required>
                                    </div>

                                    <!-- Common Fields – Banner & Intro -->
                                    <div class="accordion mb-4" id="commonFieldsAccordion">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseCommon">
                                                    <i class="fas fa-image me-2"></i> Banner & Introduction
                                                </button>
                                            </h2>
                                            <div id="collapseCommon" class="accordion-collapse collapse show">
                                                <div class="accordion-body">
                                                    <div class="row g-4">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Banner Title</label>
                                                            <input type="text" name="banner_title" class="form-control"
                                                                value="{{ old('banner_title', $editPage->banner_title ?? '') }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Banner Image</label>

                                                            <input type="file" name="banner_image" class="form-control"
                                                                accept="image/*"
                                                                onchange="previewBanner(this, 'bannerPreview')">

                                                            <!-- Preview Image -->
                                                            <div class="mt-3">
                                                                <img id="bannerPreview"
                                                                    class="img-preview img-fluid rounded shadow-sm"
                                                                    style="max-height: 300px; object-fit: cover; display: {{ $editPage && $editPage->banner_image ? 'block' : 'none' }};"
                                                                    src="{{ $editPage && $editPage->banner_image ? asset('storage/' . $editPage->banner_image) : '' }}"
                                                                    alt="Banner preview">
                                                            </div>

                                                            <!-- Optional: small text when no image -->
                                                            <small id="noBannerText" class="form-text text-muted"
                                                                style="display: {{ $editPage && $editPage->banner_image ? 'none' : 'block' }};">
                                                                No banner selected yet
                                                            </small>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Intro Title</label>
                                                            <input type="text" name="intro_title" class="form-control"
                                                                value="{{ old('intro_title', $editPage->intro_title ?? '') }}">
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Intro Description</label>
                                                            <textarea name="intro_description" class="form-control" rows="4">{{ old('intro_description', $editPage->intro_description ?? '') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <!-- TEMPLATE 1 FIELDS -->
                                    <div id="template1Fields" style="display: none;">
                                        <div class="accordion" id="template1Accordion">

                                            <!-- Parallax & Services -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed " type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseT1Parallax">
                                                        <i class="fas fa-image me-2"></i> Parallax & Press Services Heading
                                                    </button>
                                                </h2>
                                                <div id="collapseT1Parallax" class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                        <div class="row g-4">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Parallax Image</label>
                                                                <input type="file" name="parallax_image"
                                                                    class="form-control" accept="image/*"
                                                                    onchange="previewImage(event, 'parallaxPreview')">

                                                                <!-- Preview container -->
                                                                <div class="mt-3">
                                                                    <img id="parallaxPreview"
                                                                        class="img-preview img-fluid rounded shadow-sm"
                                                                        style="max-height: 250px; object-fit: cover; display: {{ $editPage && $editPage->parallax_image ? 'block' : 'none' }};"
                                                                        src="{{ $editPage && $editPage->parallax_image ? asset('storage/' . $editPage->parallax_image) : '' }}"
                                                                        alt="Parallax banner preview">

                                                                    <!-- Optional: placeholder when no image -->
                                                                    <div id="parallaxPlaceholder"
                                                                        class="text-center text-muted p-4 border rounded bg-light"
                                                                        style="display: {{ $editPage && $editPage->parallax_image ? 'none' : 'block' }}; max-height: 250px;">
                                                                        <i class="fas fa-image fa-3x mb-2"></i><br>
                                                                        No image selected<br>
                                                                        <small>Preview will appear here</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>Press Services tilte</label>
                                                                <input type="text" name="services_subtitle"
                                                                    class="form-control"
                                                                    value="{{ old('services_subtitle', $editPage->services_subtitle ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Press Sections (with nested repeatable features) -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapsePressSections">
                                                        <i class="fas fa-newspaper me-2"></i> Press Sections
                                                    </button>
                                                </h2>
                                                <div id="collapsePressSections" class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                        <div id="pressSectionsContainer" class="mb-3">

                                                            @if (old('press_sections', $editPage->press_sections ?? []))
                                                                @foreach (old('press_sections', $editPage->press_sections) as $sIndex => $section)
                                                                    <div
                                                                        class="dynamic-item press-section mb-4 border p-3 rounded shadow-sm">
                                                                        <div class="row g-3 align-items-end mb-3">
                                                                            <div class="col-md-10">
                                                                                <label class="form-label fw-bold">Section
                                                                                    Title</label>
                                                                                <input type="text"
                                                                                    name="press_sections[{{ $sIndex }}][title]"
                                                                                    class="form-control"
                                                                                    value="{{ $section['title'] ?? '' }}"
                                                                                    placeholder="e.g. Servo Hydraulic Presses"
                                                                                    required>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <button type="button"
                                                                                    class="btn btn-danger btn-sm remove-section mt-4">
                                                                                    <i class="fas fa-trash"></i> Remove
                                                                                    Section
                                                                                </button>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Nested Features Repeater -->
                                                                        <label class="form-label fw-bold mt-3">Features /
                                                                            Points</label>
                                                                        <div class="features-container mb-3"
                                                                            data-section-index="{{ $sIndex }}">

                                                                            @if (!empty($section['features']) && is_array($section['features']))
                                                                                @foreach ($section['features'] as $fIndex => $feature)
                                                                                    <div
                                                                                        class="feature-row row g-3 align-items-end mb-2 border-bottom pb-2">
                                                                                        <div class="col-md-5">
                                                                                            <input type="text"
                                                                                                name="press_sections[{{ $sIndex }}][features][{{ $fIndex }}][point_title]"
                                                                                                class="form-control"
                                                                                                value="{{ $feature['point_title'] ?? '' }}"
                                                                                                placeholder="e.g. Energy-Efficient Hydraulics"
                                                                                                required>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <textarea name="press_sections[{{ $sIndex }}][features][{{ $fIndex }}][description]"
                                                                                                class="form-control" rows="2" placeholder="Description...">{{ $feature['description'] ?? '' }}</textarea>
                                                                                        </div>
                                                                                        <div class="col-md-1">
                                                                                            <button type="button"
                                                                                                class="btn btn-danger btn-sm remove-feature mt-0">
                                                                                                <i
                                                                                                    class="fas fa-trash"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                        </div>

                                                                        <button type="button"
                                                                            class="btn btn-outline-success btn-sm add-feature"
                                                                            data-section-index="{{ $sIndex }}">
                                                                            <i class="fas fa-plus me-1"></i> Add Feature
                                                                        </button>
                                                                    </div>
                                                                @endforeach
                                                            @endif

                                                        </div>

                                                        <button type="button" class="btn btn-success"
                                                            id="addPressSection">
                                                            <i class="fas fa-plus me-1"></i> Add New Press Section
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Main Features (new repeater) -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseMainFeatures">
                                                        <i class="fas fa-star me-2"></i> Main Features
                                                    </button>
                                                </h2>
                                                <div id="collapseMainFeatures" class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                        <div id="mainFeaturesContainer" class="mb-3">
                                                            @if (old('main_features', $editPage->main_features ?? []))
                                                                @foreach (old('main_features', $editPage->main_features ?? []) as $index => $feature)
                                                                    <div
                                                                        class="dynamic-item feature-item mb-4 border p-3 rounded shadow-sm">
                                                                        <div class="row g-3 align-items-end">
                                                                            <!-- Feature Title -->
                                                                            <div class="col-md-5">
                                                                                <label class="form-label fw-bold">Feature
                                                                                    Title</label>
                                                                                <input type="text"
                                                                                    name="main_features[{{ $index }}][title]"
                                                                                    class="form-control"
                                                                                    value="{{ old("main_features.$index.title", $feature['title'] ?? '') }}"
                                                                                    placeholder="e.g. Advanced Suspension System">
                                                                            </div>

                                                                            <!-- Feature Image -->
                                                                            <div class="">
                                                                                <label
                                                                                    class="form-label fw-bold">Image</label>

                                                                                <input type="file"
                                                                                    name="main_features[{{ $index }}][image]"
                                                                                    class="form-control feature-image-input"
                                                                                    accept="image/*">

                                                                                <input type="hidden"
                                                                                    name="main_features[{{ $index }}][existing_image]"
                                                                                    value="{{ $feature['image'] ?? '' }}">

                                                                                @if (!empty($feature['image']))
                                                                                    <img src="{{ asset('storage/' . $feature['image']) }}"
                                                                                        class="img-thumbnail mt-2 feature-image-preview"
                                                                                        style="max-height:80px;">
                                                                                @else
                                                                                    <img class="img-thumbnail mt-2 feature-image-preview d-none"
                                                                                        style="max-height:80px;">
                                                                                @endif
                                                                            </div>


                                                                            <!-- Remove Feature Button -->
                                                                            <div class="col-md-2">
                                                                                <button type="button"
                                                                                    class="btn btn-danger btn-sm remove-feature mt-4">
                                                                                    <i class="fas fa-trash"></i> Remove Entire Features
                                                                                </button>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Points Section -->
                                                                        <div class="mt-4">
                                                                            <label
                                                                                class="form-label fw-bold">Points</label>
                                                                            <div class="points-container mb-3"
                                                                                data-feature-index="{{ $index }}">
                                                                                @foreach ($feature['points'] ?? [] as $pIndex => $point)
                                                                                    <div
                                                                                        class="point-row row g-3 align-items-end mb-3 border-bottom pb-3">
                                                                                        <div class="col-md-4">
                                                                                            <input type="text"
                                                                                                name="main_features[{{ $index }}][points][{{ $pIndex }}][point_title]"
                                                                                                class="form-control"
                                                                                                placeholder="Point Title"
                                                                                                value="{{ old("main_features.$index.points.$pIndex.point_title", $point['point_title'] ?? '') }}">
                                                                                        </div>
                                                                                        <div class="col-md-7">
                                                                                            <textarea name="main_features[{{ $index }}][points][{{ $pIndex }}][description]" class="form-control"
                                                                                                rows="2" placeholder="Description...">{{ old("main_features.$index.points.$pIndex.description", $point['description'] ?? '') }}</textarea>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-1 d-flex align-items-end">
                                                                                            <button type="button"
                                                                                                class="btn btn-danger btn-sm remove-point">
                                                                                                <i
                                                                                                    class="fas fa-trash"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>

                                                                            <button type="button"
                                                                                class="btn btn-outline-primary btn-sm add-point"
                                                                                data-feature-index="{{ $index }}">
                                                                                <i class="fas fa-plus me-1"></i> Add Point
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>

                                                        <button type="button" class="btn btn-success btn-sm"
                                                            id="addMainFeature">
                                                            <i class="fas fa-plus me-1"></i> Add New Feature
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Bottom Section Items (new repeater) -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseBottomItems">
                                                        <i class="fas fa-list-ul me-2"></i> Bottom Section Items
                                                    </button>
                                                </h2>
                                                <div id="collapseBottomItems" class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                        <div id="bottomItemsContainer" class="mb-3">
                                                            @if (old('bottom_section_items', $editPage->bottom_section_items ?? []))
                                                                @foreach (old('bottom_section_items', $editPage->bottom_section_items) as $index => $item)
                                                                    <div
                                                                        class="dynamic-item bottom-item mb-4 border p-3 rounded">
                                                                        <div class="row g-3">
                                                                            <div class="col-md-4">
                                                                                <label class="form-label">Title</label>
                                                                                <input type="text"
                                                                                    name="bottom_section_items[{{ $index }}][title]"
                                                                                    class="form-control"
                                                                                    value="{{ $item['title'] ?? '' }}">
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <label class="form-label">Image</label>
                                                                                <input type="file"
                                                                                    name="bottom_section_items[{{ $index }}][image]"
                                                                                    class="form-control" accept="image/*">
                                                                                <input type="hidden"
                                                                                    name="bottom_section_items[{{ $index }}][existing_image]"
                                                                                    value="{{ $item['image'] ?? '' }}">
                                                                                @if (!empty($item['image']))
                                                                                    <div class="mt-2">
                                                                                        <img src="{{ asset('storage/' . $item['image']) }}"
                                                                                            alt="Current Image"
                                                                                            class="img-thumbnail"
                                                                                            style="height: 50px;">
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <label
                                                                                    class="form-label">Description</label>
                                                                                <textarea name="bottom_section_items[{{ $index }}][description]" class="form-control" rows="3">{{ $item['description'] ?? '' }}</textarea>
                                                                            </div>
                                                                            <div class="col-md-1 d-flex align-items-end">
                                                                                <button type="button"
                                                                                    class="btn btn-danger btn-sm remove-dynamic"><i
                                                                                        class="fas fa-trash"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <button type="button" class="btn btn-success btn-sm"
                                                            id="addBottomItem">
                                                            <i class="fas fa-plus me-1"></i> Add Item
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- TEMPLATE 2 FIELDS -->
                                    <div id="template2Fields" style="display: none;">

                                        <!-- Feature List (Repeater) -->
                                        <div class="accordion-item mb-3">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFeatureList">
                                                    <i class="fas fa-list me-2"></i> Feature List
                                                </button>
                                            </h2>
                                            <div id="collapseFeatureList" class="accordion-collapse collapse">
                                                <div class="accordion-body">
                                                    <div id="featureListContainer" class="mb-3">
                                                        @if (old('feature_list', $editPage->feature_list ?? []))
                                                            @foreach (old('feature_list', $editPage->feature_list) as $index => $item)
                                                                <div
                                                                    class="dynamic-item feature-list-item mb-4 border p-3 rounded">
                                                                    <div class="row g-3">
                                                                        <div class="col-md-4">
                                                                            <label class="form-label">Title</label>
                                                                            <input type="text"
                                                                                name="feature_list[{{ $index }}][title]"
                                                                                class="form-control"
                                                                                value="{{ $item['title'] ?? '' }}">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="form-label">Image</label>
                                                                            <input type="file"
                                                                                name="feature_list[{{ $index }}][image]"
                                                                                class="form-control" accept="image/*">
                                                                            <input type="hidden"
                                                                                name="feature_list[{{ $index }}][existing_image]"
                                                                                value="{{ $item['image'] ?? '' }}">
                                                                            @if (!empty($item['image']))
                                                                                <div class="mt-2">
                                                                                    <img src="{{ asset('storage/' . $item['image']) }}"
                                                                                        alt="Current Image"
                                                                                        class="img-thumbnail"
                                                                                        style="height: 50px;">
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <label class="form-label">Items (one per
                                                                                line)</label>
                                                                            <textarea name="feature_list[{{ $index }}][items]" class="form-control" rows="3">{{ is_array($item['items'] ?? []) ? implode("\n", $item['items'] ?? []) : $item['items'] ?? '' }}</textarea>
                                                                        </div>
                                                                        <div class="col-md-1 d-flex align-items-end">
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm remove-dynamic"><i
                                                                                    class="fas fa-trash"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        id="addFeatureList">
                                                        <i class="fas fa-plus me-1"></i> Add Feature List
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Feature Rows (Repeater) -->
                                      <div class="accordion-item mb-3">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseFeatureRows">
            <i class="fas fa-align-justify me-2"></i> Feature Rows
        </button>
    </h2>
    <div id="collapseFeatureRows" class="accordion-collapse collapse">
        <div class="accordion-body">
            <div id="featureRowsContainer" class="mb-3">
                @if (old('feature_rows', $editPage->feature_rows ?? []))
                    @foreach (old('feature_rows', $editPage->feature_rows ?? []) as $index => $row)
                        <div class="dynamic-item feature-row-item mb-4 border p-3 rounded shadow-sm">
                            <div class="row g-3 align-items-end mb-3">
                                <div class="col-md-5">
                                    <label class="form-label fw-bold">Row Title</label>
                                    <input type="text"
                                           name="feature_rows[{{ $index }}][title]"
                                           class="form-control"
                                           value="{{ old("feature_rows.$index.title", $row['title'] ?? '') }}"
                                           placeholder="e.g. Performance Highlights">
                                </div>
                                <div class="">
                                    <label class="form-label fw-bold">Image</label>
                                    <input type="file"
                                           name="feature_rows[{{ $index }}][image]"
                                           class="form-control" accept="image/*">
                                    <input type="hidden"
                                           name="feature_rows[{{ $index }}][existing_image]"
                                           value="{{ $row['image'] ?? '' }}">
                                    @if (!empty($row['image']))
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $row['image']) }}"
                                                 alt="Current" class="img-thumbnail" style="max-height: 60px;">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm remove-feature-row mt-4">
                                        <i class="fas fa-trash"></i> Remove Row
                                    </button>
                                </div>
                            </div>

                            <!-- Points Section -->
                            <label class="form-label fw-bold mt-2">Points / Features</label>
                            <div class="points-container mb-3" data-row-index="{{ $index }}">
                                @foreach ($row['points'] ?? [] as $pIndex => $point)
                                    <div class="point-row row g-3 align-items-end mb-3 border-bottom pb-3">
                                        <div class="col-md-4">
                                            <input type="text"
                                                   name="feature_rows[{{ $index }}][points][{{ $pIndex }}][point_title]"
                                                   class="form-control"
                                                   placeholder="Point Title"
                                                   value="{{ old("feature_rows.$index.points.$pIndex.point_title", $point['point_title'] ?? '') }}">
                                        </div>
                                        <div class="col-md-7">
                                            <textarea name="feature_rows[{{ $index }}][points][{{ $pIndex }}][description]"
                                                      class="form-control" rows="2"
                                                      placeholder="Description...">{{ old("feature_rows.$index.points.$pIndex.description", $point['description'] ?? '') }}</textarea>
                                        </div>
                                        <div class="col-md-1 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger btn-sm remove-point">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" class="btn btn-outline-primary btn-sm add-point"
                                    data-row-index="{{ $index }}">
                                <i class="fas fa-plus me-1"></i> Add Point
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>

            <button type="button" class="btn btn-success btn-sm" id="addFeatureRow">
                <i class="fas fa-plus me-1"></i> Add Feature Row
            </button>
        </div>
    </div>
</div>

                                        <!-- Process Section -->
                                        <div class="card p-3 mb-3 bg-light">
                                            <h5 class="card-title">Process Section</h5>
                                            <div class="mb-3">
                                                <label class="form-label">Process Title</label>
                                                <input type="text" name="process_title" class="form-control"
                                                    value="{{ old('process_title', $editPage->process_title ?? '') }}">
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseProcessSteps">
                                                        <i class="fas fa-cogs me-2"></i> Process Steps
                                                    </button>
                                                </h2>
                                                <div id="collapseProcessSteps" class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                        <div id="processStepsContainer" class="mb-3">
                                                            @if (old('process_steps', $editPage->process_steps ?? []))
                                                                @foreach (old('process_steps', $editPage->process_steps) as $index => $step)
                                                                    <div
                                                                        class="dynamic-item process-step-item mb-4 border p-3 rounded">
                                                                        <div class="row g-3">
                                                                            <div class="col-md-5">
                                                                                <label class="form-label">Step
                                                                                    Title</label>
                                                                                <input type="text"
                                                                                    name="process_steps[{{ $index }}][title]"
                                                                                    class="form-control"
                                                                                    value="{{ $step['title'] ?? '' }}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label">Items (one per
                                                                                    line)</label>
                                                                                <textarea name="process_steps[{{ $index }}][items]" class="form-control" rows="3">{{ is_array($step['items'] ?? []) ? implode("\n", $step['items'] ?? []) : $step['items'] ?? '' }}</textarea>
                                                                            </div>
                                                                            <div class="col-md-1 d-flex align-items-end">
                                                                                <button type="button"
                                                                                    class="btn btn-danger btn-sm remove-dynamic"><i
                                                                                        class="fas fa-trash"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <button type="button" class="btn btn-success btn-sm"
                                                            id="addProcessStep">
                                                            <i class="fas fa-plus me-1"></i> Add Step
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Strength / Materials Section -->
                                        <div class="card p-3 mb-3 bg-light">
                                            <h5 class="card-title">Strength / Materials Section</h5>
                                            <div class="mb-3">
                                                <label class="form-label">Section Title</label>
                                                <input type="text" name="strength_materials_title"
                                                    class="form-control"
                                                    value="{{ old('strength_materials_title', $editPage->strength_materials_title ?? '') }}">
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseStrengthGrid">
                                                        <i class="fas fa-th me-2"></i> Grid Items
                                                    </button>
                                                </h2>
                                                <div id="collapseStrengthGrid" class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                        <div id="strengthGridContainer" class="mb-3">
                                                            @if (old('strength_materials_grid', $editPage->strength_materials_grid ?? []))
                                                                @foreach (old('strength_materials_grid', $editPage->strength_materials_grid) as $index => $grid)
                                                                    <div
                                                                        class="dynamic-item strength-grid-item mb-4 border p-3 rounded">
                                                                        <div class="row g-3">
                                                                            <div class="col-md-4">
                                                                                <label class="form-label">Title</label>
                                                                                <input type="text"
                                                                                    name="strength_materials_grid[{{ $index }}][title]"
                                                                                    class="form-control"
                                                                                    value="{{ $grid['title'] ?? '' }}">
                                                                            </div>
                                                                            <div class="col-md-7">
                                                                                <label
                                                                                    class="form-label">Description</label>
                                                                                <textarea name="strength_materials_grid[{{ $index }}][description]" class="form-control" rows="2">{{ $grid['description'] ?? '' }}</textarea>
                                                                            </div>
                                                                            <div class="col-md-1 d-flex align-items-end">
                                                                                <button type="button"
                                                                                    class="btn btn-danger btn-sm remove-dynamic"><i
                                                                                        class="fas fa-trash"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <button type="button" class="btn btn-success btn-sm"
                                                            id="addStrengthGrid">
                                                            <i class="fas fa-plus me-1"></i> Add Item
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="text-end mt-5 pt-3 border-top">
                                        <button type="submit" class="btn btn-primary px-5">
                                            {{ isset($editPage) ? 'Update Page' : 'Create Page' }}
                                        </button>
                                        @if (isset($editPage))
                                            <a href="{{ route('capsubmenu.pages.index', ['menu' => $preselectedMenuId]) }}"
                                                class="btn btn-secondary ms-3">Cancel</a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- LIST OF EXISTING PAGES -->
            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-list me-2"></i> Existing Pages</span>
                    <small>Total: {{ $pages->count() }}</small>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Menu</th>
                                    <th>Slug</th>
                                    <th>Template</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pages as $page)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $page->menu->menu_name }}</td>
                                        <td><code>{{ $page->slug }}</code></td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $page->template === 'template_1' ? 'primary' : 'success' }}">
                                                {{ ucfirst(str_replace('_', ' ', $page->template)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('capsubmenu.pages.index', ['menu' => $page->menu_id, 'edit' => $page->id]) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form
                                                    action="{{ route('capsubmenu.pages.destroy', ['menu' => $page->menu_id, 'page' => $page->id]) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Delete this page?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>

                                                <!-- Preview link -->
                                                <a href="{{ route('capabilities.show', $page->slug) }}"
                                                    class="btn btn-sm btn-info" target="_blank">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="fas fa-file-alt fa-3x opacity-25"></i>
                                            <p class="mt-3">No pages created yet.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Image Preview Script -->
    <script>
        function preview(event, id) {
            const file = event.target.files[0];
            const img = document.getElementById(id);
            if (file) {
                img.src = URL.createObjectURL(file);
                img.style.display = 'block';
            } else {
                img.style.display = 'none';
            }
        }

        // Template visibility
        function toggleTemplateFields() {
            const template = document.getElementById('templateSelect')?.value;
            document.getElementById('template1Fields').style.display = (template === 'template_1') ? 'block' : 'none';
            document.getElementById('template2Fields').style.display = (template === 'template_2' || template ===
                'template_3') ? 'block' : 'none';
        }

        // (Legacy addPressSection removed)

        // (Legacy remove-dynamic listener removed - using global one at bottom)

        // Init on load
        document.addEventListener('DOMContentLoaded', () => {
            toggleTemplateFields();
            document.getElementById('templateSelect')?.addEventListener('change', toggleTemplateFields);
        });


        // Add Press Section
        $(document).ready(function() {

            let sectionCounter = $('#pressSectionsContainer .press-section').length;

            // Add new section
            $('#addPressSection').on('click', function() {
                sectionCounter++;
                const html = `
            <div class="dynamic-item press-section mb-4 border p-3 rounded shadow-sm">
                <div class="row g-3 align-items-end mb-3">
                    <div class="col-md-10">
                        <label class="form-label fw-bold">Section Title</label>
                        <input type="text" name="press_sections[${sectionCounter}][title]"
                               class="form-control" placeholder="e.g. Servo Electric Presses" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm remove-section mt-4">
                            <i class="fas fa-trash"></i> Remove Section
                        </button>
                    </div>
                </div>

                <label class="form-label fw-bold mt-3">Features / Points</label>
                <div class="features-container mb-3" data-section-index="${sectionCounter}">
                    <!-- first empty row optional -->
                </div>

                <button type="button" class="btn btn-outline-success btn-sm add-feature"
                        data-section-index="${sectionCounter}">
                    <i class="fas fa-plus me-1"></i> Add Feature
                </button>
            </div>`;

                $('#pressSectionsContainer').append(html);
            });

            // Remove section
            $(document).on('click', '.remove-section', function() {
                $(this).closest('.press-section').remove();
            });

            // Add feature inside section
            $(document).on('click', '.add-feature', function() {
                const sectionIndex = $(this).data('section-index');
                const $container = $(this).siblings('.features-container');
                const featureCount = $container.find('.feature-row').length;

                const rowHtml = `
            <div class="feature-row row g-3 align-items-end mb-2 border-bottom pb-2">
                <div class="col-md-5">
                    <input type="text" name="press_sections[${sectionIndex}][features][${featureCount}][point_title]"
                           class="form-control" placeholder="e.g. High-Speed, High-Accuracy Motion" required>
                </div>
                <div class="col-md-6">
                    <textarea name="press_sections[${sectionIndex}][features][${featureCount}][description]"
                              class="form-control" rows="2" placeholder="Description..."></textarea>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm remove-feature">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>`;

                $container.append(rowHtml);
            });

            // Remove feature
            $(document).on('click', '.remove-feature', function() {
                $(this).closest('.feature-row').remove();
            });

        });
        // Add Main Feature
        $(document).ready(function() {

            // Better counter: count existing .feature-item blocks
            let featureCounter = $('#mainFeaturesContainer .feature-item').length;

            /* ===============================
               ADD MAIN FEATURE
            =============================== */
            $('#addMainFeature').on('click', function() {
                const html = `
        <div class="dynamic-item feature-item mb-4 border p-3 rounded shadow-sm">
            <div class="row g-3 align-items-end mb-3">
                <div class="col-md-5">
                    <label class="form-label fw-bold">Feature Title</label>
                    <input type="text" name="main_features[${featureCounter}][title]"
                           class="form-control" placeholder="e.g. Modular Frame Architecture">
                </div>
                <div class="col-md-5">
                    <label class="form-label fw-bold">Image</label>
                    <input type="file" name="main_features[${featureCounter}][image]"
                           class="form-control" accept="image/*">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-sm remove-feature mt-4">
                        <i class="fas fa-trash"></i> Remove
                    </button>
                </div>
            </div>

            <label class="form-label fw-bold mt-2">Points</label>
            <div class="points-container mb-3" data-feature-index="${featureCounter}"></div>

            <button type="button" class="btn btn-outline-success btn-sm add-point"
                    data-feature-index="${featureCounter}">
                <i class="fas fa-plus me-1"></i> Add Point
            </button>
        </div>`;

                $('#mainFeaturesContainer').append(html);
                featureCounter++;
            });

            /* ===============================
               REMOVE MAIN FEATURE
            =============================== */
            $(document).on('click', '.remove-feature', function() {
                $(this).closest('.feature-item').remove();
            });

            /* ===============================
               ADD POINT  (works for both existing + new features)
            =============================== */
            $('#mainFeaturesContainer').on('click', '.add-point', function() {
                const featureIndex = $(this).data('feature-index');
                const $container = $(this).siblings('.points-container');
                const pointCount = $container.find('.point-row').length;

                const rowHtml = `
        <div class="point-row row g-3 align-items-end mb-2 border-bottom pb-2">
            <div class="col-md-4">
                <input type="text"
                       name="main_features[${featureIndex}][points][${pointCount}][point_title]"
                       class="form-control"
                       placeholder="e.g. High-Rigidity Frames">
            </div>
            <div class="col-md-7">
                <textarea name="main_features[${featureIndex}][points][${pointCount}][description]"
                          class="form-control" rows="2"
                          placeholder="Description..."></textarea>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm remove-point">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>`;

                $container.append(rowHtml);
            });

            /* ===============================
               REMOVE POINT
            =============================== */
            $(document).on('click', '.remove-point', function() {
                $(this).closest('.point-row').remove();
            });

        });

        // Add Bottom Item
        document.getElementById('addBottomItem')?.addEventListener('click', function() {
            const container = document.getElementById('bottomItemsContainer');
            const index = container.children.length;
            const html = `
                <div class="dynamic-item bottom-item mb-4 border p-3 rounded">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Title</label>
                            <input type="text" name="bottom_section_items[${index}][title]" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Image</label>
                            <input type="file" name="bottom_section_items[${index}][image]" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Description</label>
                            <textarea name="bottom_section_items[${index}][description]" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-sm remove-dynamic"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', html);
        });

        // Helper for simple text repeaters
        function addSimpleItem(containerId, name, label, placeholder) {
            const container = document.getElementById(containerId);
            const index = container.children.length;
            const html = `
            <div class="dynamic-item mb-4 border p-3 rounded">
                <div class="row g-3 align-items-end">
                    <div class="col-11">
                        <label class="form-label">${label}</label>
                        <input type="text" name="${name}[${index}]" class="form-control" placeholder="${placeholder}">
                    </div>
                    <div class="col-1">
                        <button type="button" class="btn btn-danger btn-sm remove-dynamic mt-4">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>`;
            container.insertAdjacentHTML('beforeend', html);
            container.insertAdjacentHTML('beforeend', html);
        }

        // -------------------------------------------------------------------------
        // TEMPLATE 2 SCRIPTS
        // -------------------------------------------------------------------------

        // Add Feature List
        document.getElementById('addFeatureList')?.addEventListener('click', function() {
            const container = document.getElementById('featureListContainer');
            const index = container.children.length;
            const html = `
                <div class="dynamic-item feature-list-item mb-4 border p-3 rounded">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Title</label>
                            <input type="text" name="feature_list[${index}][title]" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Image</label>
                            <input type="file" name="feature_list[${index}][image]" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Items (one per line)</label>
                            <textarea name="feature_list[${index}][items]" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-sm remove-dynamic"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', html);
        });

        // Add Feature Row
  document.addEventListener('DOMContentLoaded', function () {

    let rowCounter = document.querySelectorAll('#featureRowsContainer .feature-row-item').length;

    // Add new Feature Row
    document.getElementById('addFeatureRow')?.addEventListener('click', function () {
        const html = `
            <div class="dynamic-item feature-row-item mb-4 border p-3 rounded shadow-sm">
                <div class="row g-3 align-items-end mb-3">
                    <div class="col-md-5">
                        <label class="form-label fw-bold">Row Title</label>
                        <input type="text" name="feature_rows[${rowCounter}][title]" class="form-control"
                               placeholder="e.g. Performance Highlights">
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-bold">Image</label>
                        <input type="file" name="feature_rows[${rowCounter}][image]" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm remove-feature-row mt-4">
                            <i class="fas fa-trash"></i> Remove Row
                        </button>
                    </div>
                </div>

                <label class="form-label fw-bold mt-2">Points / Features</label>
                <div class="points-container mb-3" data-row-index="${rowCounter}"></div>

                <button type="button" class="btn btn-outline-primary btn-sm add-point"
                        data-row-index="${rowCounter}">
                    <i class="fas fa-plus me-1"></i> Add Point
                </button>
            </div>`;

        document.getElementById('featureRowsContainer').insertAdjacentHTML('beforeend', html);
        rowCounter++;
    });

    // Remove entire Feature Row
    document.addEventListener('click', function (e) {
        if (e.target.closest('.remove-feature-row')) {
            e.target.closest('.feature-row-item').remove();
        }
    });

    // Add new Point to a row
// Add point – Feature Rows only
$('#featureRowsContainer').on('click', '.add-point', function() {
    const rowIndex   = $(this).data('row-index');           // note: hyphen → .data() handles it
    const $container = $(this).siblings('.points-container');
    const pointCount = $container.find('.point-row').length;

    const pointHtml = `
        <div class="point-row row g-3 align-items-end mb-3 border-bottom pb-3">
            <div class="col-md-4">
                <input type="text"
                       name="feature_rows[${rowIndex}][points][${pointCount}][point_title]"
                       class="form-control"
                       placeholder="Point Title">
            </div>
            <div class="col-md-7">
                <textarea name="feature_rows[${rowIndex}][points][${pointCount}][description]"
                          class="form-control" rows="2"
                          placeholder="Description..."></textarea>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm remove-point">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>`;

    $container.append(pointHtml);
});

    // Remove individual Point
    document.addEventListener('click', function (e) {
        if (e.target.closest('.remove-point')) {
            e.target.closest('.point-row').remove();
        }
    });
});

        // Add Process Step
        document.getElementById('addProcessStep')?.addEventListener('click', function() {
            const container = document.getElementById('processStepsContainer');
            const index = container.children.length;
            const html = `
                <div class="dynamic-item process-step-item mb-4 border p-3 rounded">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label">Step Title</label>
                            <input type="text" name="process_steps[${index}][title]" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Items (one per line)</label>
                            <textarea name="process_steps[${index}][items]" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-sm remove-dynamic"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', html);
        });

        // Add Strength Grid Item
        document.getElementById('addStrengthGrid')?.addEventListener('click', function() {
            const container = document.getElementById('strengthGridContainer');
            const index = container.children.length;
            const html = `
                <div class="dynamic-item strength-grid-item mb-4 border p-3 rounded">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Title</label>
                            <input type="text" name="strength_materials_grid[${index}][title]" class="form-control">
                        </div>
                        <div class="col-md-7">
                            <label class="form-label">Description</label>
                            <textarea name="strength_materials_grid[${index}][description]" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-sm remove-dynamic"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', html);
        });

        // Remove any dynamic item
        document.addEventListener('click', e => {
            if (e.target.closest('.remove-dynamic')) {
                e.target.closest('.dynamic-item')?.remove();
            }
        });
    </script>





@endsection
