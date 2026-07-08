<!-- Pressed Components Template2 Form Sections - AJAX Response -->
<!-- This is loaded via AJAX and merged into submenu pages form -->
@php
    $pointTitleArray = [];

    if (is_array($pressedComponent->point_title ?? null)) {
        $pointTitleArray = $pressedComponent->point_title;
    } elseif (is_string($pressedComponent->point_title ?? '')) {
        $decoded = json_decode($pressedComponent->point_title, true);
        $pointTitleArray = is_array($decoded) ? $decoded : [];
    }
@endphp

<style>
    .dynamic-section {
        border: 1px solid #dee2e6;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 5px;
        background-color: #f8f9fa;
    }

    .remove-btn {
        float: right;
    }

    .add-more-btn {
        margin-top: 10px;
    }
</style>

<!-- Banner Section -->
<div class="section-header mt-4">
    <h4 class="mb-3 text-uppercase"><i class="bi bi-image fs-4"></i> Banner Section</h4>
</div>
<div class="p-4 border rounded shadow-sm bg-light mb-4">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-medium">Banner Image</label>
            <input class="form-control" type="file" name="pc_banner_image" accept="image/*"
                onchange="preview(event, 'pcBannerPreview')">
            @if ($pressedComponent && $pressedComponent->banner_image)
                <img id="pcBannerPreview" src="{{ asset('frontend/imgs/submenu/' . $pressedComponent->banner_image) }}"
                    width="120" class="mt-2 rounded shadow-sm">
            @else
                <img id="pcBannerPreview" style="display:none;" class="mt-2 rounded shadow-sm">
            @endif
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-medium">Banner Title</label>
            <input type="text" class="form-control" name="pc_banner_title"
                value="{{ $pressedComponent->banner_title ?? '' }}">
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label fw-medium">Description</label>
            <textarea class="form-control" name="pc_description" rows="3">{{ $pressedComponent->description ?? '' }}</textarea>
        </div>
    </div>
</div>

<!-- Capabilities Section -->
<div class="section-header">
    <h4 class="mb-3 text-uppercase"><i class="bi bi-gear fs-4"></i> Capabilities Section</h4>
</div>
<div class="p-4 border rounded shadow-sm bg-light mb-4">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-medium">Capabilities Title</label>
            <input type="text" class="form-control" name="pc_capabilities_title"
                value="{{ $pressedComponent->capabilities_title ?? '' }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-medium">Capabilities Subtitle</label>
            <input type="text" class="form-control" name="pc_capabilities_subtitle"
                value="{{ $pressedComponent->capabilities_subtitle ?? '' }}">
        </div>
    </div>

    <label class="form-label fw-medium">Capabilities Cards</label>
    <div id="pc-capabilities-cards-container">
        @php
            $capabilitiesCards = $pressedComponent->capabilities_cards ?? [['title' => '', 'description' => '']];
        @endphp
        @foreach ($capabilitiesCards as $index => $card)
            <div class="dynamic-section pc-capabilities-card" data-index="{{ $index }}">
                {{-- <button type="button" class="btn btn-danger btn-sm remove-btn remove-pc-capability-card"> --}}
                <button type="button" class="btn btn-danger btn-sm remove-btn" data-repeat-remove>
                    <i class="bi bi-trash"></i>
                </button>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control"
                            name="pc_capabilities_cards[{{ $index }}][title]" placeholder="Card Title"
                            value="{{ $card['title'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <textarea class="form-control" name="pc_capabilities_cards[{{ $index }}][description]"
                            placeholder="Card Description" rows="2">{{ $card['description'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- <button type="button" class="btn btn-success add-more-btn" id="add-pc-capability-card">
        <i class="bi bi-plus-circle"></i> Add More Card
    </button> --}}
    <button type="button" class="btn btn-success add-more-btn" data-repeat-add
        data-container="#pc-capabilities-cards-container" data-template="pc-capabilities-template">
        Add More Card
    </button>

</div>

<!-- Industries Section -->
<div class="section-header">
    <h4 class="mb-3 text-uppercase"><i class="bi bi-building fs-4"></i> Industries Section</h4>
</div>
<div class="p-4 border rounded shadow-sm bg-light mb-4">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-medium">Industries Title</label>
            <input type="text" class="form-control" name="pc_industries_title"
                value="{{ $pressedComponent->industries_title ?? '' }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-medium">Industries Subtitle</label>
            <input type="text" class="form-control" name="pc_industries_subtitle"
                value="{{ $pressedComponent->industries_subtitle ?? '' }}">
        </div>
    </div>

    <label class="form-label fw-medium">Industries Icons & Names</label>
    <div id="pc-industries-icons-container">
        @php
            $industriesIcons = $pressedComponent->industries_icons ?? [''];
            $industriesNames = is_array($pressedComponent->industries_name ?? [])
                ? $pressedComponent->industries_name
                : (is_string($pressedComponent->industries_name ?? '')
                    ? json_decode($pressedComponent->industries_name, true)
                    : []);
        @endphp
        @foreach ($industriesIcons as $index => $icon)
            <div class="dynamic-section pc-industries-icon" data-index="{{ $index }}">
                {{-- <button type="button" class="btn btn-danger btn-sm remove-btn remove-pc-industry-icon"> --}}
                    <button type="button"
        class="btn btn-danger btn-sm remove-btn"
        data-repeat-remove>
                    <i class="bi bi-trash"></i>
                </button>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Industry Name</label>
                        <input type="text" class="form-control" name="pc_industries_name[]"
                            placeholder="Industry Name" value="{{ $industriesNames[$index] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Industry Icon</label>
                        <input type="file" class="form-control" name="pc_industries_icons[]" accept="image/*"
                            onchange="preview(event, 'pcIndustryIcon{{ $index }}')">
                    </div>
                </div>
                @if ($icon)
                    <img id="pcIndustryIcon{{ $index }}" src="{{ asset('frontend/imgs/submenu/' . $icon) }}"
                        width="50" class="mt-2">
                    <input type="hidden" name="pc_existing_industries_icons[]" value="{{ $icon }}">
                @else
                    <img id="pcIndustryIcon{{ $index }}" style="display:none;" width="50"
                        class="mt-2">
                @endif
            </div>
        @endforeach
    </div>
    {{-- <button type="button" class="btn btn-success add-more-btn" id="add-pc-industry-icon"> --}}
    <button type="button" class="btn btn-success add-more-btn" data-repeat-add
        data-container="#pc-industries-icons-container" data-template="pc-industries-template">
        <i class="bi bi-plus-circle"></i> Add More Icon & Name
    </button>
</div>

<!-- Manufacturing Capability Section -->
<div class="section-header">
    <h4 class="mb-3 text-uppercase"><i class="bi bi-tools fs-4"></i> Manufacturing Capability</h4>
</div>
<div class="p-4 border rounded shadow-sm bg-light mb-4">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-medium">Title</label>
            <input type="text" class="form-control" name="pc_manufacturing_capability_title"
                value="{{ $pressedComponent->manufacturing_capability_title ?? '' }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-medium">Subtitle</label>
            <input type="text" class="form-control" name="pc_manufacturing_capability_subtitle"
                value="{{ $pressedComponent->manufacturing_capability_subtitle ?? '' }}">
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label fw-medium">Manufacturing Capability Images</label>

            <div id="pc-manufacturing-images-container">
                @php
                    $mcImages = $pressedComponent->manufacturing_capability_image ?? [];
                    if (!is_array($mcImages)) {
                        $mcImages = $mcImages ? (json_decode($mcImages, true) ?: [$mcImages]) : [];
                    }
                @endphp

                @foreach ($mcImages as $index => $img)
                    <div class="dynamic-section pc-mfg-image-item" data-index="{{ $index }}">
                        <button type="button" class="btn btn-danger btn-sm remove-btn" data-repeat-remove>✕</button>
                        <div class="mb-2">
                            <input class="form-control" type="file" name="pc_manufacturing_capability_image[]" accept="image/*"
                                onchange="preview(event, 'pcMfgCapPreview{{ $index }}')">
                            <input type="hidden" name="pc_manufacturing_capability_existing[]" value="{{ $img }}">
                        </div>
                        <img id="pcMfgCapPreview{{ $index }}" src="{{ asset('frontend/imgs/submenu/' . $img) }}" width="120" class="mt-2 rounded shadow-sm">
                    </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-success btn-sm mt-2" data-repeat-add data-container="#pc-manufacturing-images-container" data-template="pc-manufacturing-image-template">
                <i class="bi bi-plus-circle"></i> Add Image
            </button>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label fw-medium">Description</label>
            <textarea class="form-control" name="pc_manufacturing_capability_description" rows="3">{{ $pressedComponent->manufacturing_capability_description ?? '' }}</textarea>
        </div>
    </div>

    <label class="form-label fw-medium">Infrastructure Equipments</label>
    <div id="pc-infrastructure-equipments-container">
        @php
            $equipments = $pressedComponent->infrastructure_equipments ?? [
                ['title' => '', 'total_area' => '', 'production_floor' => ''],
            ];
            if (is_object($equipments) && !is_array($equipments)) {
                $equipments = [$equipments];
            }
        @endphp
        @foreach ($equipments as $index => $equipment)
            <div class="dynamic-section pc-infrastructure-equipment" data-index="{{ $index }}">
                {{-- <button type="button" class="btn btn-danger btn-sm remove-btn remove-pc-infrastructure-equipment"> --}}
                    <button type="button"
        class="btn btn-danger btn-sm remove-btn"
        data-repeat-remove>                    <i class="bi bi-trash"></i>
                </button>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control"
                            name="pc_infrastructure_equipments[{{ $index }}][title]" placeholder="Title"
                            value="{{ is_object($equipment) ? $equipment->title ?? '' : $equipment['title'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control"
                            name="pc_infrastructure_equipments[{{ $index }}][total_area]"
                            placeholder="Total Area"
                            value="{{ is_object($equipment) ? $equipment->total_area ?? '' : $equipment['total_area'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control"
                            name="pc_infrastructure_equipments[{{ $index }}][production_floor]"
                            placeholder="Production Floor"
                            value="{{ is_object($equipment) ? $equipment->production_floor ?? '' : $equipment['production_floor'] ?? '' }}">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- <button type="button" class="btn btn-success add-more-btn" id="add-pc-infrastructure-equipment"> --}}
    <button type="button" class="btn btn-success add-more-btn" data-repeat-add
        data-container="#pc-infrastructure-equipments-container" data-template="pc-infrastructure-template">
        <i class="bi bi-plus-circle"></i> Add More Equipment
    </button>
</div>

<!-- Core Processes Section -->
<div class="section-header">
    <h4 class="mb-3 text-uppercase"><i class="bi bi-diagram-3 fs-4"></i> Core Processes</h4>
</div>
<div class="p-4 border rounded shadow-sm bg-light mb-4">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-medium">Core Processes Title</label>
            <input type="text" class="form-control" name="pc_core_processes_title"
                value="{{ $pressedComponent->core_processes_title ?? '' }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-medium">Core Processes Subtitle</label>
            <input type="text" class="form-control" name="pc_core_processes_subtitle"
                value="{{ $pressedComponent->core_processes_subtitle ?? '' }}">
        </div>
    </div>
    <div class="form-group mb-3">
        <label class="form-label fw-medium">Core Processes Table</label>
        <textarea name="pc_core_processes_table" id="pc-core-processes-editor" class="summernote">{!! old('pc_core_processes_table', $pressedComponent->core_processes_table ?? '') !!}</textarea>
    </div>
</div>

<!-- Quality Inspection Section -->
<div class="section-header">
    <h4 class="mb-3 text-uppercase"><i class="bi bi-shield-check fs-4"></i> Quality Inspection</h4>
</div>
<div class="p-4 border rounded shadow-sm bg-light mb-4">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-medium">Quality Inspection Title</label>
            <input type="text" class="form-control" name="pc_quality_inspection_title"
                value="{{ $pressedComponent->quality_inspection_title ?? '' }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-medium">Quality Inspection Subtitle</label>
            <input type="text" class="form-control" name="pc_quality_inspection_subtitle"
                value="{{ $pressedComponent->quality_inspection_subtitle ?? '' }}">
        </div>
    </div>
    <div class="form-group mb-3">
        <label class="form-label fw-medium">Quality Inspection Table</label>
        <textarea name="pc_quality_inspection_table" id="pc-quality-inspection-editor" class="summernote">{!! old('pc_quality_inspection_table', $pressedComponent->quality_inspection_table ?? '') !!}</textarea>
    </div>
</div>

<!-- Technology Range Section -->
<div class="section-header">
    <h4 class="mb-3 text-uppercase"><i class="bi bi-cpu fs-4"></i> Technology Range</h4>
</div>
<div class="p-4 border rounded shadow-sm bg-light mb-4">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-medium">Technology Range Title</label>
            <input type="text" class="form-control" name="pc_technology_range_title"
                value="{{ $pressedComponent->technology_range_title ?? '' }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-medium">Technology Range Subtitle</label>
            <input type="text" class="form-control" name="pc_technology_range_subtitle"
                value="{{ $pressedComponent->technology_range_subtitle ?? '' }}">
        </div>
    </div>

    <label class="form-label fw-medium">Technology Range Cards</label>
    <div id="pc-technology-cards-container">
        @php
            $technologyCards = $pressedComponent->technology_range_cards ?? [
                ['title' => '', 'description' => '', 'image' => ''],
            ];
        @endphp
        @foreach ($technologyCards as $index => $card)
            <div class="dynamic-section pc-technology-card" data-index="{{ $index }}">
                {{-- <button type="button" class="btn btn-danger btn-sm remove-btn remove-pc-technology-card"> --}}
                    <button type="button"
        class="btn btn-danger btn-sm remove-btn"
        data-repeat-remove>
                    <i class="bi bi-trash"></i>
                </button>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control"
                            name="pc_technology_range_cards[{{ $index }}][title]" placeholder="Card Title"
                            value="{{ $card['title'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <textarea class="form-control" name="pc_technology_range_cards[{{ $index }}][description]"
                            placeholder="Description" rows="2">{{ $card['description'] ?? '' }}</textarea>
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="file" class="form-control" name="pc_technology_range_cards_images[]"
                            accept="image/*" onchange="preview(event, 'pcTechCardImg{{ $index }}')">
                        @if (isset($card['image']) && $card['image'])
                            <img id="pcTechCardImg{{ $index }}" src="{{ asset('frontend/imgs/submenu/' . $card['image']) }}"
                                width="50" class="mt-2">
                            <input type="hidden"
                                name="pc_technology_range_cards[{{ $index }}][existing_image]"
                                value="{{ $card['image'] }}">
                        @else
                            <img id="pcTechCardImg{{ $index }}" style="display:none;" width="50"
                                class="mt-2">
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- <button type="button" class="btn btn-success add-more-btn" id="add-pc-technology-card"> --}}
    <button type="button" class="btn btn-success add-more-btn" data-repeat-add
        data-container="#pc-technology-cards-container" data-template="pc-technology-template">
        <i class="bi bi-plus-circle"></i> Add More Card
    </button>
</div>

<!-- Points Section -->
<div class="section-header">
    <h4 class="mb-3 text-uppercase"><i class="bi bi-list-check fs-4"></i> Points Section</h4>
</div>
<div class="p-4 border rounded shadow-sm bg-light mb-4">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label class="form-label fw-medium">Points Section Title</label>
            <input type="text" class="form-control" name="pc_point_section_title"
                value="{{ $pressedComponent->point_section_title ?? '' }}">
        </div>
    </div>

    <label class="form-label fw-medium">Points</label>
    <div id="pc-points-container">
        @php
            $pointTitles = is_array($pressedComponent->point_title ?? [])
                ? $pressedComponent->point_title
                : (is_string($pressedComponent->point_title ?? '')
                    ? json_decode($pressedComponent->point_title, true)
                    : []);
            $points = is_array($pressedComponent->points ?? [])
                ? $pressedComponent->points
                : (is_string($pressedComponent->points ?? '')
                    ? json_decode($pressedComponent->points, true)
                    : []);
            // Merge both arrays
            $pointsArray = [];
            for ($i = 0; $i < max(count($pointTitles), count($points)); $i++) {
                $pointsArray[] = [
                    'title' => $pointTitles[$i] ?? '',
                    'description' => $points[$i] ?? '',
                ];
            }
        @endphp
        @foreach ($pointsArray as $index => $point)
            <div class="dynamic-section pc-point-item" data-index="{{ $index }}">
                {{-- <button type="button" class="btn btn-danger btn-sm remove-btn remove-pc-point"> --}}
                    <button type="button"
        class="btn btn-danger btn-sm remove-btn"
        data-repeat-remove>
                    <i class="bi bi-trash"></i>
                </button>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control" name="pc_points[{{ $index }}][title]"
                            placeholder="Point Title" value="{{ $point['title'] ?? '' }}">
                    </div>
                    <div class="col-md-8 mb-2">
                        <textarea class="form-control" name="pc_points[{{ $index }}][description]" placeholder="Point Description"
                            rows="2">{{ $point['description'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- <button type="button" class="btn btn-success add-more-btn" id="add-pc-point"> --}}
    <button type="button" class="btn btn-success add-more-btn"data-repeat-add data-container="#pc-points-container"
        data-template="pc-points-template">
        <i class="bi bi-plus-circle"></i> Add More Point
    </button>
</div>

{{-- hidden --}}
<template id="pc-capabilities-template">
    <div class="dynamic-section pc-capabilities-card">
        <button type="button" class="btn btn-danger btn-sm remove-btn" data-repeat-remove>✕</button>

        <div class="row">
            <div class="col-md-6 mb-2">
                <input type="text" name="pc_capabilities_cards[__INDEX__][title]" class="form-control"
                    placeholder="Card Title">
            </div>
            <div class="col-md-6 mb-2">
                <textarea name="pc_capabilities_cards[__INDEX__][description]" class="form-control" rows="2"
                    placeholder="Description"></textarea>
            </div>
        </div>
    </div>
</template>

<template id="pc-points-template">
    <div class="dynamic-section pc-point-item">
        <button type="button" class="btn btn-danger btn-sm remove-btn" data-repeat-remove>✕</button>

        <div class="row">
            <div class="col-md-4">
                <input type="text" name="pc_points[__INDEX__][title]" class="form-control"
                    placeholder="Point Title">
            </div>
            <div class="col-md-8">
                <textarea name="pc_points[__INDEX__][description]" class="form-control" rows="2"
                    placeholder="Point Description"></textarea>
            </div>
        </div>
    </div>
</template>

<template id="pc-industries-template">
    <div class="dynamic-section pc-industries-icon">
        <button type="button" class="btn btn-danger btn-sm remove-btn" data-repeat-remove>✕</button>

        <div class="row">
            <div class="col-md-6 mb-2">
                <label class="form-label">Industry Name</label>
                <input type="text" class="form-control" name="pc_industries_name[]" placeholder="Industry Name">
            </div>

            <div class="col-md-6 mb-2">
                <label class="form-label">Industry Icon</label>
                <input type="file" class="form-control" name="pc_industries_icons[]" accept="image/*">
            </div>
        </div>
    </div>
</template>

<template id="pc-infrastructure-template">
    <div class="dynamic-section pc-infrastructure-equipment">
        <button type="button" class="btn btn-danger btn-sm remove-btn" data-repeat-remove>✕</button>

        <div class="row">
            <div class="col-md-4 mb-2">
                <input type="text" class="form-control" name="pc_infrastructure_equipments[__INDEX__][title]"
                    placeholder="Title">
            </div>
            <div class="col-md-4 mb-2">
                <input type="text" class="form-control" name="pc_infrastructure_equipments[__INDEX__][total_area]"
                    placeholder="Total Area">
            </div>
            <div class="col-md-4 mb-2">
                <input type="text" class="form-control"
                    name="pc_infrastructure_equipments[__INDEX__][production_floor]" placeholder="Production Floor">
            </div>
        </div>
    </div>
</template>

<template id="pc-manufacturing-image-template">
    <div class="dynamic-section pc-mfg-image-item">
        <button type="button" class="btn btn-danger btn-sm remove-btn" data-repeat-remove>✕</button>
        <div class="mb-2">
            <input class="form-control" type="file" name="pc_manufacturing_capability_image[]" accept="image/*" onchange="preview(event, 'pcMfgCapPreview__INDEX__')">
        </div>
        <img id="pcMfgCapPreview__INDEX__" style="display:none;" width="120" class="mt-2 rounded shadow-sm">
    </div>
</template>

<template id="pc-technology-template">
    <div class="dynamic-section pc-technology-card">
        <button type="button" class="btn btn-danger btn-sm remove-btn" data-repeat-remove>✕</button>

        <div class="row">
            <div class="col-md-4 mb-2">
                <input type="text" class="form-control" name="pc_technology_range_cards[__INDEX__][title]"
                    placeholder="Card Title">
            </div>

            <div class="col-md-4 mb-2">
                <textarea class="form-control" name="pc_technology_range_cards[__INDEX__][description]" rows="2"
                    placeholder="Description"></textarea>
            </div>

            <div class="col-md-4 mb-2">
                <input type="file" class="form-control" name="pc_technology_range_cards_images[]"
                    accept="image/*">
            </div>
        </div>
    </div>
</template>

<script>
(function(){
    // Idempotent initializer that can be called after AJAX insertion
    function initPcManufacturingImageHandlers() {
        // Delegate add button click (works even when button is inserted later)
        if (!window._pcMfgAddDelegated) {
            document.addEventListener('click', function(e) {
                const addTarget = e.target.closest('#add-pc-manufacturing-image');
                if (addTarget) {
                    const container = document.getElementById('pc-manufacturing-images-container');
                    if (!container) return;
                    const template = document.getElementById('pc-manufacturing-image-template').innerHTML;
                    const uniq = Date.now() + Math.floor(Math.random() * 1000);
                    const previewId = 'pcMfgCapPreview' + uniq;
                    const html = template.replace(/__PREVIEW_ID__/g, previewId);
                    const tmp = document.createElement('div');
                    tmp.innerHTML = html.trim();
                    container.appendChild(tmp.firstElementChild);
                }
            });
            window._pcMfgAddDelegated = true;
        }

        // Delegate remove clicks (already delegated but mark to prevent duplicates)
        if (!window._pcMfgRemoveDelegated) {
            document.addEventListener('click', function(e) {
                const rem = e.target.closest('[data-remove-image]');
                if (rem) {
                    const item = rem.closest('.pc-mfg-image-item');
                    if (item) item.remove();
                }
            });
            window._pcMfgRemoveDelegated = true;
        }

        // Ensure preview helper exists
        if (typeof window.preview === 'undefined') {
            window.preview = function(event, previewId) {
                const input = event.target;
                const file = input.files && input.files[0];
                const img = document.getElementById(previewId);
                if (!img) return;
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        img.src = e.target.result;
                        img.style.display = 'block';
                    };
                    reader.readAsDataURL(file);

                    // If replacing an existing image, remove the hidden existing input so controller knows it's replaced
                    const existingInput = input.closest('.pc-mfg-image-item')?.querySelector('input[name="pc_manufacturing_capability_existing[]"]');
                    if (existingInput) existingInput.remove();
                } else {
                    img.style.display = 'none';
                    img.src = '';
                }
            };
        }
    }

    // Expose globally so the AJAX success callback can call it after inserting HTML
    window.initPcManufacturingImageHandlers = initPcManufacturingImageHandlers;

    // Run now in case this script is executed after insertion
    try { initPcManufacturingImageHandlers(); } catch (e) { /* ignore */ }
})();
</script>
