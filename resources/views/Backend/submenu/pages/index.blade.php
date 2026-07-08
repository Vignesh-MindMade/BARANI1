@extends('layouts.app')

@section('wrapper')

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
            box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .125);
        }

        .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, .25);
        }
    </style>

    <div class="page-wrapper">
        <div class="page-box">

            <!-- PAGE HEADER -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h3 class="page-title"><i class="fas fa-file-alt me-2 text-primary"></i> Submenu Page Manager</h3>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Submenu Pages</li>
                    </ol>
                </div>
            </div>

            <!-- SUCCESS MESSAGE -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif


            <!-- CREATE / EDIT FORM -->
            <div class="accordion mb-4" id="createPageWrap">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingCreatePage">
                        <button class="accordion-button {{ isset($editPage) ? '' : 'collapsed' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseCreatePage">
                            <i class="fas fa-plus-circle me-2"></i>
                            {{ isset($editPage) ? 'Edit Page' : 'Create New Page' }}
                        </button>
                    </h2>

                    <div id="collapseCreatePage" class="accordion-collapse collapse {{ isset($editPage) ? 'show' : '' }}"
                        data-bs-parent="#createPageWrap">

                        <div class="accordion-body">
                            <div class="form-section">

                                <div class="form-header">
                                    <h5 class="text-primary mb-0">
                                        {{ isset($editPage) ? 'Edit Page' : 'Create New Page' }}
                                    </h5>
                                </div>

                                <form
                                    action="{{ isset($editPage)
                                        ? route('groupsubmenu.pages.update', [$selectedSubmenu->id, $editPage->id])
                                        : route('groupsubmenu.pages.store', $selectedSubmenu->id) }}"
                                    method="POST" enctype="multipart/form-data">

                                    @csrf
                                    @if (isset($editPage))
                                        @method('PUT')
                                    @endif

                                    <!-- TEMPLATE SELECT -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Template</label>
                                        <select id="page_template_select" name="template" class="form-select" required>
                                            <option value="" disabled
                                                {{ old('template', $editPage->template ?? '')  ? 'selected' : '' }}>
                                                Select Template
                                            </option>
                                            <option value="template1"
                                                {{ old('template', $editPage->template ?? '') == 'template1' ? 'selected' : '' }}>
                                                Template 1</option>
                                            <option value="template2"
                                                {{ old('template', $editPage->template ?? '') == 'template2' ? 'selected' : '' }}>
                                                Template 2</option>
                                        </select>
                                        <small class="text-muted">Choose frontend template for this page.</small>
                                    </div>

                             <!-- BROCHURE UPLOAD -->
<div class="mb-3">
    <label class="form-label fw-bold">Brochure (PDF)</label>
    <input type="file" class="form-control" name="brochure" accept=".pdf">

    @if (isset($editPage) && $editPage->brochure)
        <div class="mt-2">
            <small class="text-muted">Current: {{ $editPage->brochure }}</small>

            <a href="{{ asset('frontend/imgs/submenu/' . $editPage->brochure) }}" 
               target="_blank" class="btn btn-sm btn-info ms-2">
                <i class="fas fa-eye"></i> View
            </a>

            <!-- REMOVE OPTION -->
            <div class="form-check mt-2">
                <input type="checkbox" name="remove_brochure" value="1" class="form-check-input" id="removeBrochure">
                <label class="form-check-label text-danger" for="removeBrochure">
                    Remove existing brochure
                </label>
            </div>
        </div>
    @endif
</div>
                                    <!-- SECTION 1 — SUBMENU SELECTION -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSubmenu">
                                            <button class="accordion-button {{ isset($editPage) ? '' : 'collapsed' }}"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseSubmenu"
                                                aria-expanded="{{ isset($editPage) ? 'true' : 'true' }}">
                                                <i class="fas fa-list-alt me-2"></i> Choosen Submenu
                                            </button>
                                        </h2>
                                        <div id="collapseSubmenu" class="accordion-collapse collapse show"
                                            data-bs-parent="#submenuPageAccordion">
                                            <div class="accordion-body">
                                                @if (isset($editPage))
                                                    <div class="alert alert-info small py-2 px-3">
                                                        <strong>Linked Submenu:</strong>
                                                        {{ $selectedSubmenu->submenu_name }}
                                                    </div>
                                                    <input type="hidden" name="submenu_id"
                                                        value="{{ $selectedSubmenu->id }}">
                                                @else
                                                    <select name="submenu_id" class="form-select" required>
                                                        <option value="">-- Choose Submenu --</option>
                                                        @foreach ($allSubmenus as $s)
                                                            <option value="{{ $s->id }}"
                                                                {{ old('submenu_id') == $s->id || (isset($selectedSubmenu) && $s->id == $selectedSubmenu->id) ? 'selected' : '' }}>
                                                                {{ $s->submenu_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- AJAX CONTAINER FOR TEMPLATE2 PRESSED COMPONENTS -->
                                    <div id="template2-ajax-container" style="display: none;"></div>

                                    <!-- INNER ACCORDION START -->
                                    <div class="accordion" id="submenuPageAccordion">



                                        <!-- SECTION 2 — BANNER INFO -->
                                        <div class="accordion-item" data-templates="index,template1">
                                            <h2 class="accordion-header" id="headingBanner">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseBanner">
                                                    <i class="fas fa-image me-2"></i> Banner Information
                                                </button>
                                            </h2>
                                            <div id="collapseBanner"
                                                class="accordion-collapse collapse {{ isset($editPage) ? 'show' : '' }}"
                                                data-bs-parent="#submenuPageAccordion">
                                                <div class="accordion-body">
                                                    <div class="row g-4">
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-bold">Banner Title</label>
                                                            <input type="text" class="form-control" name="banner_title"
                                                                value="{{ old('banner_title', $editPage->banner_title ?? '') }}"
                                                                placeholder="Enter banner title">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-bold">Banner Image</label>
                                                            <input type="file" class="form-control" name="banner_image"
                                                                accept="image/*" onchange="preview(event, 'bannerPreview')">
                                                            <img id="bannerPreview"
                                                                src="{{ isset($editPage) && $editPage->banner_image ? asset('storage/submenu_pages/' . $editPage->banner_image) : '' }}"
                                                                class="mt-2 img-thumbnail"
                                                                style="height:80px; width:auto; {{ isset($editPage) && $editPage->banner_image ? '' : 'display:none;' }}">
                                                            @if (isset($editPage) && $editPage->banner_image)
                                                                <small class="text-muted d-block mt-1">Current
                                                                    image</small>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <!-- Template selection moved to top -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- SECTION 3 — DIVISION CONTENT -->
                                        <div class="accordion-item" data-templates="index,template1">
                                            <h2 class="accordion-header" id="headingDivision">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseDivision">
                                                    <i class="fas fa-pencil-alt me-2"></i> Division Content
                                                </button>
                                            </h2>
                                            <div id="collapseDivision"
                                                class="accordion-collapse collapse {{ isset($editPage) ? 'show' : '' }}"
                                                data-bs-parent="#submenuPageAccordion">
                                                <div class="accordion-body">
                                                    <div class="row g-4">
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-bold">Division Title</label>
                                                            <input type="text" class="form-control"
                                                                name="division_title"
                                                                value="{{ old('division_title', $editPage->division_title ?? '') }}">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label fw-bold">Division Description</label>
                                                            <textarea class="form-control" rows="6" name="division_desc">{{ old('division_desc', $editPage->division_desc ?? '') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- SECTION 4 — WHY CHOOSE US -->
                                        <div class="accordion-item" data-templates="index,template1">
                                            <h2 class="accordion-header" id="headingChooseUs">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseChooseUs">
                                                    <i class="fas fa-star me-2"></i> Why Choose Us Points
                                                </button>
                                            </h2>
                                            <div id="collapseChooseUs"
                                                class="accordion-collapse collapse {{ isset($editPage) ? 'show' : '' }}"
                                                data-bs-parent="#submenuPageAccordion">
                                                <div class="accordion-body">
                                                    <label class="form-label fw-bold">Points (one per line)</label>
                                                    <textarea class="form-control" rows="6" name="chooseus_points"
                                                        placeholder="• Expert team with 10+ years experience&#10;• 100% client satisfaction&#10;• On-time delivery">{{ old('chooseus_points', $editPage->chooseus_points ?? '') }}</textarea>
                                                    <small class="text-muted">Use bullet points or plain text, one per
                                                        line</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- SECTION 5 — VIDEO -->
                                        <div class="accordion-item" data-templates="index,template1">
                                            <h2 class="accordion-header" id="headingVideo">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseVideo">
                                                    <i class="fas fa-video me-2"></i> Video (Optional)
                                                </button>
                                            </h2>
                                            <div id="collapseVideo"
                                                class="accordion-collapse collapse {{ isset($editPage) ? 'show' : '' }}"
                                                data-bs-parent="#submenuPageAccordion">
                                                <div class="accordion-body">
                                                    <label class="form-label fw-bold">YouTube / Direct Video URL</label>
                                                    <input type="url" class="form-control" name="chooseus_video"
                                                        placeholder="https://www.youtube.com/embed/xyz or https://example.com/video.mp4"
                                                        value="{{ old('chooseus_video', $editPage->chooseus_video ?? '') }}">
                                                    <small class="text-muted">Supports YouTube embed links or direct .mp4 URLs</small>

                                                    <label class="form-label fw-bold mt-3">Upload Video (mp4/webm)</label>
                                                    <input type="file" class="form-control" name="chooseus_video_file" accept="video/mp4,video/webm">
                                                    <small class="text-muted">If you upload a file, it will override the URL.</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- SECTION 6 — PROCESS TITLE + CARDS INSIDE -->
                                        <div class="accordion-item" data-templates="index,template1">
                                            <h2 class="accordion-header" id="headingProcessTitle">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseProcessTitle">
                                                    <i class="fas fa-cogs me-2"></i> Process Section Title
                                                </button>
                                            </h2>

                                            <div id="collapseProcessTitle"
                                                class="accordion-collapse collapse {{ isset($editPage) ? 'show' : '' }}"
                                                data-bs-parent="#submenuPageAccordion">

                                                <div class="accordion-body">

                                                    <!-- TITLE INPUT -->
                                                    <label class="form-label fw-bold">Process Title</label>
                                                    <input type="text" class="form-control mb-4"
                                                        name="view_process_title" placeholder="e.g., Our Working Process"
                                                        value="{{ old('view_process_title', $editPage->view_process_title ?? '') }}">

                                                    <!-- NESTED CARDS WRAPPER -->
                                                    <div style="margin-left:30px;">

                                                        @for ($i = 1; $i <= 4; $i++)
                                                            @php
                                                                $icon = "view_process_card{$i}_icon";
                                                                $title = "view_process_card{$i}_title";
                                                                $desc = "view_process_card{$i}_desc";
                                                                $currentIcon = $editPage->$icon ?? null;
                                                            @endphp

                                                            <div class="accordion-item mt-3">
                                                                <h2 class="accordion-header"
                                                                    id="headingCard{{ $i }}">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapseCard{{ $i }}">
                                                                        <i class="fas fa-box me-2"></i> Process Card
                                                                        {{ $i }}
                                                                    </button>
                                                                </h2>

                                                                <div id="collapseCard{{ $i }}"
                                                                    class="accordion-collapse collapse {{ isset($editPage) ? 'show' : '' }}"
                                                                    data-bs-parent="#collapseProcessTitle">

                                                                    <div class="accordion-body">

                                                                        <div class="row g-4">
                                                                            <!-- ICON -->
                                                                            <div class="col-md-4">
                                                                                <label class="form-label fw-bold">Card
                                                                                    Icon</label>
                                                                                <input type="file" class="form-control"
                                                                                    name="{{ $icon }}"
                                                                                    accept="image/*"
                                                                                    onchange="preview(event, 'cardPreview{{ $i }}')">

                                                                                <img id="cardPreview{{ $i }}"
                                                                                    src="{{ $currentIcon ? asset('frontend/imgs/submenu/' . $currentIcon) : '' }}"
                                                                                    class="img-thumbnail mt-2"
                                                                                    style="height:70px; {{ $currentIcon ? '' : 'display:none;' }}">

                                                                                @if ($currentIcon)
                                                                                    <small
                                                                                        class="text-muted d-block">Current
                                                                                        icon</small>
                                                                                @endif
                                                                            </div>

                                                                            <!-- TITLE + DESC -->
                                                                            <div class="col-md-8">
                                                                                <label class="form-label fw-bold">Card
                                                                                    Title</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="{{ $title }}"
                                                                                    placeholder="Step {{ $i }} Title"
                                                                                    value="{{ old($title, $editPage->$title ?? '') }}">

                                                                                <label
                                                                                    class="form-label fw-bold mt-3">Description</label>
                                                                                <textarea class="form-control" rows="3" name="{{ $desc }}" placeholder="Describe this step...">{{ old($desc, $editPage->$desc ?? '') }}</textarea>
                                                                            </div>
                                                                        </div>

                                                                    </div> <!-- accordion-body -->
                                                                </div> <!-- collapseCard -->
                                                            </div> <!-- accordion-item -->
                                                        @endfor

                                                    </div> <!-- margin-left wrapper -->
                                                </div>
                                            </div>
                                        </div>


                                        {{-- Press const Start --}}
                                        @php
                                            $section = $editPage?->sections?->first();
                                        @endphp

                                        <div class="accordion-item" data-templates="template1">
                                            <h2 class="accordion-header" id="headingPC">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsePC">
                                                    <i class="fas fa-tools me-2"></i> Press Construction Section
                                                </button>
                                            </h2>

                                            <div id="collapsePC"
                                                class="accordion-collapse collapse {{ isset($editPage) ? 'show' : '' }}">
                                                <div class="accordion-body">

                                                    <label class="form-label fw-bold">Section Title</label>
                                                    <input type="text" name="press_construction_title"
                                                        class="form-control"
                                                        value="{{ $section->press_construction_title ?? '' }}">

                                                    <label class="form-label fw-bold mt-3">Points (one per line)</label>
                                                    <textarea class="form-control" name="press_construction_points" rows="5">{{ $section->press_construction_points ?? '' }}</textarea>

                                                    <hr class="my-4">

                                                    <h5 class="fw-bold mb-3">Construction Images (Add More)</h5>

                                                    <div id="pressConstructionRepeatable">
                                                        @if ($section && $section->items->count())
                                                            @foreach ($section->items as $index => $item)
                                                                <div class="pc-item row g-3 mb-3">

                                                                    <!-- Hidden IDs -->
                                                                    <input type="hidden" name="pc_item_id[]"
                                                                        value="{{ $item->id }}">
                                                                    <input type="hidden" name="pc_old_image[]"
                                                                        value="{{ $item->image }}">

                                                                    <div class="col-md-5">
                                                                        <label class="form-label">Image Title</label>
                                                                        <input type="text" name="image_title[]"
                                                                            class="form-control"
                                                                            value="{{ $item->image_title }}">
                                                                    </div>

                                                                    <div class="col-md-5">
                                                                        <label class="form-label">Image</label>
                                                                        <input type="file"
                                                                            name="press_construction_image[]"
                                                                            class="form-control"
                                                                            onchange="preview(event, 'pcPrev{{ $index }}')">

                                                                        <img id="pcPrev{{ $index }}"
                                                                            src="{{ $item->image ? asset('frontend/imgs/submenu/' . $item->image) : '' }}"
                                                                            class="img-thumbnail mt-2"
                                                                            style="height:70px; {{ $item->image ? '' : 'display:none;' }}">
                                                                    </div>

                                                                    <div class="col-md-2 d-flex align-items-end">
                                                                        <button type="button"
                                                                            class="btn btn-danger remove-pc w-100">Remove</button>
                                                                    </div>

                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>

                                                    <button type="button" class="btn btn-success mt-3"
                                                        id="addPC">Add More</button>

                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            document.getElementById('addPC').addEventListener('click', function() {
                                                let container = document.getElementById('pressConstructionRepeatable');
                                                let index = container.querySelectorAll('.pc-item').length;

                                                let html = `
        <div class="pc-item row g-3 mb-3">

            <input type="hidden" name="pc_item_id[]" value="">
            <input type="hidden" name="pc_old_image[]" value="">

            <div class="col-md-5">
                <label class="form-label">Image Title</label>
                <input type="text" name="image_title[]" class="form-control">
            </div>

            <div class="col-md-5">
                <label class="form-label">Image</label>
                <input type="file" name="press_construction_image[]" class="form-control"
                       onchange="preview(event, 'pcPrevNew${index}')">

                <img id="pcPrevNew${index}" class="img-thumbnail mt-2"
                     style="height:70px; display:none;">
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-pc w-100">Remove</button>
            </div>

        </div>
    `;

                                                container.insertAdjacentHTML('beforeend', html);
                                            });

                                            document.addEventListener('click', function(e) {
                                                if (e.target.classList.contains('remove-pc')) {
                                                    e.target.closest('.pc-item').remove();
                                                }
                                            });
                                        </script>

                                        {{-- Manufacturing Facility --}}
                                        @php
                                            $mf = $editPage?->manufacturingFacility;
                                        @endphp

                                        <div class="accordion-item" data-templates="template1">
                                            <h2 class="accordion-header" id="headingMF">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseMF">
                                                    <i class="fas fa-industry me-2"></i> Manufacturing Facility
                                                </button>
                                            </h2>

                                            <div id="collapseMF"
                                                class="accordion-collapse collapse {{ isset($editPage) ? 'show' : '' }}">
                                                <div class="accordion-body">

                                                    <!-- MAIN TITLE -->
                                                    <label class="form-label fw-bold">Section Title</label>
                                                    <input type="text" name="facility_title" class="form-control"
                                                        value="{{ $mf->facility_title ?? '' }}"
                                                        placeholder="Manufacturing Facility">

                                                    <!-- BACKGROUND VIDEO -->
                                                    <label class="form-label fw-bold mt-3">Background Video URL</label>
                                                    <input type="text" name="facility_bg_video" class="form-control"
                                                        value="{{ $mf->facility_bg_video ?? '' }}"
                                                        placeholder="https://example.com/video.mp4">

                                                    <label class="form-label fw-bold mt-3">Upload Background Video (mp4/webm)</label>
                                                    <input type="file" name="facility_bg_video_file" class="form-control" accept="video/mp4,video/webm">
                                                    <small class="text-muted">If you upload a file, it will override the URL.</small>

                                                    <!-- FOOTNOTE -->
                                                    <label class="form-label fw-bold mt-3">Bottom Testimonial /
                                                        Footnote</label>
                                                    <textarea name="facility_testimonial" class="form-control" rows="3" placeholder="* For 95% of process...">{{ $mf->facility_testimonial ?? '' }}</textarea>

                                                    <hr class="my-4">

                                                    <!-- CARD ACCORDION -->
                                                    <div class="accordion" id="facilityCardAccordion"
                                                        style="margin-left:30px;">

                                                        @for ($i = 1; $i <= 4; $i++)
                                                            @php
                                                                $title = "card{$i}_title";
                                                                $points = "card{$i}_points";
                                                            @endphp

                                                            <div class="accordion-item mt-3">
                                                                <h2 class="accordion-header"
                                                                    id="mfCardHead{{ $i }}">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#mfCard{{ $i }}">
                                                                        <i class="fas fa-box me-2"></i> Facility Card
                                                                        {{ $i }}
                                                                    </button>
                                                                </h2>

                                                                <div id="mfCard{{ $i }}"
                                                                    class="accordion-collapse collapse"
                                                                    data-bs-parent="#facilityCardAccordion">
                                                                    <div class="accordion-body">

                                                                        <!-- Title -->
                                                                        <label class="form-label fw-bold">Card
                                                                            Title</label>
                                                                        <input type="text" name="{{ $title }}"
                                                                            class="form-control mb-3"
                                                                            value="{{ $mf->$title ?? '' }}"
                                                                            placeholder="Eg: Sub Assembly & Assembly">

                                                                        <!-- Points -->
                                                                        <label class="form-label fw-bold">Points (one per
                                                                            line)</label>
                                                                        <textarea name="{{ $points }}" class="form-control" rows="5" placeholder="• Point 1
• Point 2">{{ $mf->$points ?? '' }}</textarea>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endfor

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        {{-- Press tandards --}}
                                        @php
                                            // press standards list (may contain 0, 1 or many)
                                            $pressStandards = $editPage?->pressStandards ?? collect();
                                        @endphp

                                        <div class="accordion-item" data-templates="template1">
                                            <h2 class="accordion-header" id="headingPS">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsePS">
                                                    <i class="fas fa-certificate me-2"></i> Press Standards
                                                </button>
                                            </h2>

                                            <div id="collapsePS"
                                                class="accordion-collapse collapse {{ isset($editPage) ? 'show' : '' }}">
                                                <div class="accordion-body">

                                                    <!-- MAIN TITLE -->
                                                    <label class="form-label fw-bold">Main Title</label>
                                                    <input type="text" name="press_main_title"
                                                        class="form-control mb-4"
                                                        value="{{ $pressStandards->first()->press_main_title ?? '' }}"
                                                        placeholder="Press Standards">

                                                    <hr>

                                                    <!-- REPEATABLE WRAPPER -->
                                                    <h5 class="fw-bold mb-3">Press Standard Items</h5>

                                                    <div id="pressStandardsWrapper">

                                                        @if ($pressStandards->count() > 0)
                                                            @foreach ($pressStandards as $index => $ps)
                                                                <div class="ps-item border rounded p-3 mb-3">

                                                                    <!-- Hidden ID (CRITICAL) -->
                                                                    <input type="hidden" name="press_standard_id[]"
                                                                        value="{{ $ps->id }}">

                                                                    <div class="row g-3">

                                                                        <!-- Logo -->
                                                                        <div class="col-md-4">
                                                                            <label class="form-label fw-bold">Detail
                                                                                Logo</label>
                                                                            <input type="file"
                                                                                name="press_detail_logo[]"
                                                                                class="form-control" accept="image/*"
                                                                                onchange="preview(event, 'psLogoPrev{{ $index }}')">

                                                                            <img id="psLogoPrev{{ $index }}"
                                                                                src="{{ $ps->press_detail_logo ? asset('frontend/imgs/submenu/' . $ps->press_detail_logo) : '' }}"
                                                                                class="img-thumbnail mt-2"
                                                                                style="height:70px; width:auto; {{ $ps->press_detail_logo ? '' : 'display:none;' }}">
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label class="form-label fw-bold">Detail
                                                                                Title</label>
                                                                            <input type="text" class="form-control"
                                                                                name="press_detail_title[]"
                                                                                value="{{ $ps->press_detail_title }}"
                                                                                placeholder="E.g., ISO 9001 Certified">
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <label
                                                                                class="form-label fw-bold">Description</label>
                                                                            <textarea class="form-control" rows="3" name="press_detail_desc[]" placeholder="Brief description...">{{ $ps->press_detail_desc }}</textarea>
                                                                        </div>

                                                                        <div class="col-md-1 d-flex align-items-end">
                                                                            <button type="button"
                                                                                class="btn btn-danger w-100 remove-ps">
                                                                                Remove
                                                                            </button>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                            @endforeach
                                                        @endif

                                                    </div>

                                                    <!-- ADD BUTTON -->
                                                    <button type="button" id="addPressStandard"
                                                        class="btn btn-success mt-3">
                                                        Add New Item
                                                    </button>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- JS FOR ADD/REMOVE -->
                                        <script>
                                            document.getElementById('addPressStandard').addEventListener('click', function() {

                                                let wrapper = document.getElementById('pressStandardsWrapper');
                                                let index = wrapper.querySelectorAll('.ps-item').length;

                                                let html = `
        <div class="ps-item border rounded p-3 mb-3">

            <!-- Hidden ID for new row -->
            <input type="hidden" name="press_standard_id[]" value="">

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Detail Logo</label>
                    <input type="file" name="press_detail_logo[]" class="form-control"
                           accept="image/*"
                           onchange="preview(event, 'psLogoPrevNew${index}')">

                    <img id="psLogoPrevNew${index}" class="img-thumbnail mt-2"
                         style="height:70px; display:none;">
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Detail Title</label>
                    <input type="text" class="form-control"
                           name="press_detail_title[]"
                           placeholder="E.g., ISO Certified">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-bold">Description</label>
                    <textarea class="form-control" name="press_detail_desc[]" rows="3"
                              placeholder="Brief description..."></textarea>
                </div>

                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger w-100 remove-ps">
                        Remove
                    </button>
                </div>
            </div>

        </div>
    `;

                                                wrapper.insertAdjacentHTML('beforeend', html);
                                            });

                                            document.addEventListener('click', function(e) {
                                                if (e.target.classList.contains('remove-ps')) {
                                                    e.target.closest('.ps-item').remove();
                                                }
                                            });
                                        </script>
                                        {{-- end of press standards --}}

                                        {{-- DESIGN STRENGTH SECTION --}}
                                        @php
                                            $designStrength = $editPage?->designStrength ?? collect();
                                        @endphp

                                        <div class="accordion-item" data-templates="template1">
                                            <h2 class="accordion-header" id="headingDS">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseDS">
                                                    <i class="fas fa-drafting-compass me-2"></i> Design Strength
                                                </button>
                                            </h2>

                                            <div id="collapseDS"
                                                class="accordion-collapse collapse {{ isset($editPage) ? 'show' : '' }}">
                                                <div class="accordion-body">

                                                    <!-- Section Title -->
                                                    <label class="form-label fw-bold">Design Section Title</label>
                                                    <input type="text" class="form-control mb-3" name="design_title"
                                                        value="{{ $designStrength->first()->design_title ?? '' }}"
                                                        placeholder="Design & Analysis Capabilities">

                                                    <!-- Description -->
                                                    <label class="form-label fw-bold">Design Description</label>
                                                    <textarea name="design_text" class="form-control mb-4" rows="4" placeholder="Our engineering team uses...">{{ $designStrength->first()->design_text ?? '' }}</textarea>

                                                    <hr class="my-4">

                                                    <!-- Repeatable Logos -->
                                                    <h5 class="fw-bold mb-3">Software Logos (Repeatable)</h5>

                                                    <div id="designStrengthWrapper">

                                                        @foreach ($designStrength as $index => $ds)
                                                            <div class="ds-item border rounded p-3 mb-3">

                                                                <!-- Hidden fields -->
                                                                <input type="hidden" name="design_strength_id[]"
                                                                    value="{{ $ds->id }}">
                                                                <input type="hidden" name="design_old_logo[]"
                                                                    value="{{ $ds->design_softwares_logo }}">

                                                                <div class="row g-3">

                                                                    <div class="col-md-5">
                                                                        <label class="form-label fw-bold">Software
                                                                            Logo</label>
                                                                        <input type="file"
                                                                            name="design_softwares_logo[]"
                                                                            class="form-control" accept="image/*"
                                                                            onchange="preview(event, 'dsLogoPrev{{ $index }}')">

                                                                        <img id="dsLogoPrev{{ $index }}"
                                                                            src="{{ $ds->design_softwares_logo ? asset('frontend/imgs/submenu/' . $ds->design_softwares_logo) : '' }}"
                                                                            class="img-thumbnail mt-2"
                                                                            style="height:70px; width:auto; {{ $ds->design_softwares_logo ? '' : 'display:none;' }}">
                                                                    </div>

                                                                    <div class="col-md-1 d-flex align-items-end">
                                                                        <button type="button"
                                                                            class="btn btn-danger w-100 remove-ds">
                                                                            Remove
                                                                        </button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        @endforeach

                                                    </div>

                                                    <button type="button" id="addDesignStrength"
                                                        class="btn btn-success mt-3">
                                                        Add New Logo
                                                    </button>

                                                </div>
                                            </div>
                                        </div>

                                        {{-- JS --}}
                                        <script>
                                            document.getElementById('addDesignStrength').addEventListener('click', function() {

                                                let wrap = document.getElementById('designStrengthWrapper');
                                                let index = wrap.querySelectorAll('.ds-item').length;

                                                let html = `
        <div class="ds-item border rounded p-3 mb-3">

            <!-- New Row: no ID -->
            <input type="hidden" name="design_strength_id[]" value="">
            <input type="hidden" name="design_old_logo[]" value="">

            <div class="row g-3">

                <div class="col-md-5">
                    <label class="form-label fw-bold">Software Logo</label>
                    <input type="file"
                           name="design_softwares_logo[]"
                           class="form-control"
                           accept="image/*"
                           onchange="preview(event, 'dsLogoPrevNew${index}')">

                    <img id="dsLogoPrevNew${index}"
                         class="img-thumbnail mt-2"
                         style="height:70px; display:none;">
                </div>

                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger w-100 remove-ds">
                        Remove
                    </button>
                </div>

            </div>
        </div>
    `;

                                                wrap.insertAdjacentHTML('beforeend', html);
                                            });

                                            document.addEventListener('click', function(e) {
                                                if (e.target.classList.contains('remove-ds')) {
                                                    e.target.closest('.ds-item').remove();
                                                }
                                            });
                                        </script>
                                        {{-- END DESIGN STRENGTH --}}


                                    </div> <!-- END submenuPageAccordion -->

                                    <div class="text-end mt-4 pt-3 border-top">
                                        <button type="submit" class="btn btn-primary px-5 py-2">
                                            {{ isset($editPage) ? 'Update Page' : 'Create Page' }}
                                        </button>

                                        @if (isset($editPage))
                                            <a href="{{ route('groupsubmenu.pages.index', $selectedSubmenu->id) }}"
                                                class="btn btn-secondary px-4 py-2 ms-2">Cancel</a>
                                        @endif
                                    </div>

                                </form>

                            </div> <!-- form-section -->
                        </div> <!-- accordion-body -->

                    </div> <!-- collapseCreatePage -->
                </div> <!-- accordion-item -->
            </div> <!-- createPageWrap -->


            <!-- PAGE LIST -->
            <!-- PAGE LIST -->
            <div class="card mt-5 shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white py-3 d-flex align-items-center">
                    <h6 class="mb-0 fw-semibold">
                        <i class="fas fa-layer-group me-2"></i>
                        Pages under: <strong>{{ $selectedSubmenu->submenu_name }}</strong>

                    </h6>
                </div>

                <div class="card-body p-0">

                    @forelse($pages as $p)
                        <div class="page-row d-flex align-items-center justify-content-between py-4 px-4 border-bottom">

                            <!-- LEFT SIDE - TITLES -->
                            <div class="flex-grow-1">
                                <h5 class="fw-bold text-dark mb-1">
                                    {{ $selectedSubmenu->submenu_name }}
                                </h5>

                                {{-- <div class="text-muted small">
                                    {{ $p->division_title ?: 'Untitled Page' }}
                                </div> --}}
                            </div>
<!--to cehck whic template act to render frontend page-->
<!--<small class="text-danger">-->
<!--    template = "{{ $p->template }}"-->
<!--</small>-->

                            <!-- ACTION BUTTONS -->
                            <div class="d-flex align-items-center gap-5">

                                <a href="{{ route('groupsubmenu.pages.index', [$selectedSubmenu->id, 'edit' => $p->id]) }}"
                                    class="btn btn-warning btn-sm px-3 py-2">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('groupsubmenu.pages.destroy', [$selectedSubmenu->id, $p->id]) }}"
                                    method="POST" onsubmit="return confirm('Delete this page?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm px-3 py-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>

                                @if ($p->template === 'template2')
                                    <a href="{{ route('frontend.groupsubmenu.page.view', $p->id) }}" target="_blank"
                                        class="btn btn-success btn-sm px-3 py-2">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                @else
                                    <a href="{{ route('frontend.groupsubmenu.view', $selectedSubmenu->id) }}"
                                        target="_blank" class="btn btn-success btn-sm px-3 py-2">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                @endif

                            </div>

                        </div>

                    @empty
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-file-alt fa-3x opacity-25"></i>
                            <p class="mt-3">No pages created yet.</p>
                        </div>
                    @endforelse

                </div>
            </div>



            <!-- Fixed & Unified Image Preview Script -->
            <script>
                function preview(event, id) {
                    const file = event.target.files[0];
                    const img = document.getElementById(id);
                    if (file) {
                        img.src = URL.createObjectURL(file);
                        img.style.display = 'block';
                    }
                }

                // Toggle card details
                document.querySelectorAll('.toggle-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const target = document.querySelector(this.dataset.target);
                        const icon = this.querySelector('i');
                        if (target.style.display === 'none' || !target.style.display) {
                            target.style.display = 'block';
                            icon.classList.replace('fa-chevron-down', 'fa-chevron-up');
                        } else {
                            target.style.display = 'none';
                            icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
                        }
                    });
                });

                // Template-based section toggler
                function applyTemplateVisibility(template) {
                    document.querySelectorAll('[data-templates]').forEach(el => {
                        const templates = (el.getAttribute('data-templates') || '').split(',').map(t => t.trim()).filter(
                            Boolean);
                        if (templates.length === 0) {
                            // If no templates declared, show by default
                            el.style.display = '';
                            return;
                        }
                        if (templates.includes(template)) {
                            el.style.display = '';
                        } else {
                            el.style.display = 'none';
                        }
                    });
                }

document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('page_template_select');
    if (!select) return;

    // 🔥 INITIAL LOAD (this is what you were missing)
    if (select.value) {
        handleTemplateSelection(select.value);
    }

    // 🔁 CHANGE HANDLER
    select.addEventListener('change', function () {
        handleTemplateSelection(this.value);
    });
});


            </script>

        @endsection

        @section('style')
            <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
        @endsection

        @section('script')
            <!-- Summernote JS (jQuery and Bootstrap already in parent layout) -->
            <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>


            <script>
                function handleTemplateSelection(template) {
    applyTemplateVisibility(template);

    const container = document.getElementById('template2-ajax-container');

    if (template === 'template2') {
        container.style.display = 'block';

        // Prevent duplicate loads
        if (container.dataset.loaded === '1') return;

        const editPageId = '{{ isset($editPage) ? $editPage->id : 0 }}';
        const token = document.querySelector('meta[name="csrf-token"]')?.content;

      const TEMPLATE2_URL = @json(route('pressed-components.template2-form'));

fetch(`${TEMPLATE2_URL}?page_id=${editPageId}&_=${Date.now()}`, {
            headers: {
                'X-CSRF-TOKEN': token || '',
                'Accept': 'text/html'
            }
        })
        .then(res => {
            if (!res.ok) throw new Error('Failed to load template2');
            return res.text();
        })
        .then(html => {
            container.innerHTML = html;
            container.dataset.loaded = '1';
            initTemplate2();
        })
        .catch(err => {
            container.innerHTML =
                `<div class="alert alert-danger">${err.message}</div>`;
        });

    } else {
        container.style.display = 'none';
        container.innerHTML = '';
        container.dataset.loaded = '0';
    }
}

                function initTemplate2() {
                     // 1. Reset counters based on DOM
    window.pcCapabilityIndex =
        document.querySelectorAll('.pc-capabilities-card').length;
    window.pcIndustryIconIndex =
        document.querySelectorAll('.pc-industries-icon').length;
    window.pcInfrastructureEquipmentIndex =
        document.querySelectorAll('.pc-infrastructure-equipment').length;
    window.pcTechnologyCardIndex =
        document.querySelectorAll('.pc-technology-card').length;
    window.pcPointIndex =
        document.querySelectorAll('.pc-point-item').length;

    // 2. Bind handlers (delegated, once)
    bindTemplate2Handlers();

    // 3. Re-init editors
    // if ($.fn.summernote) {
    //     $('.summernote').summernote({ height: 400 });
    // }
                    // Summernote - reinitialize on each load
                    if ($.fn.summernote) {
                        $('#pc-core-processes-editor, #pc-quality-inspection-editor').summernote({
                            height: 400,
                            toolbar: [
                                ['style', ['style']],
                                ['font', ['bold', 'underline', 'clear']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['table', ['table']],
                                ['insert', ['link', 'picture']],
                                ['view', ['fullscreen', 'codeview', 'help']]
                            ]
                        });
                    }

                    // Call handler binder from the loaded form-sections
               
                }
               function bindTemplate2Handlers() {

    // ADD MORE (universal)
    $(document).off('click', '[data-repeat-add]')
        .on('click', '[data-repeat-add]', function () {

            const containerSelector = this.dataset.container;
            const templateId = this.dataset.template;

            const container = document.querySelector(containerSelector);
            const template = document.getElementById(templateId);

            if (!container || !template) {
                console.error('Repeat config missing', this);
                return;
            }

            const index = container.children.length;

            let html = template.innerHTML.replaceAll('__INDEX__', index);
            container.insertAdjacentHTML('beforeend', html);
        });

    // REMOVE (universal)
    $(document).off('click', '[data-repeat-remove]')
        .on('click', '[data-repeat-remove]', function () {
            this.closest('.dynamic-section')?.remove();
        });
}


    // CAPABILITIES
    $(document).off('click', '#add-pc-capability-card')
        .on('click', '#add-pc-capability-card', function () {
            $('#pc-capabilities-cards-container').append(`
                <div class="dynamic-section pc-capabilities-card">
                    <button type="button"
                        class="btn btn-danger btn-sm remove-pc-capability-card">✕</button>
                    <input type="text"
                        name="pc_capabilities_cards[${pcCapabilityIndex}][title]">
                </div>
            `);
            pcCapabilityIndex++;
        });

    $(document).off('click', '.remove-pc-capability-card')
        .on('click', '.remove-pc-capability-card', function () {
            $(this).closest('.pc-capabilities-card').remove();
        });

    // Repeat same pattern for industries, tech cards, points, etc.


            </script>
            
        @endsection
