@extends('layouts.app')
@section('style')
    <link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/custome_backend/dashboard.css') }}" />

   
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
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Header Section -->
            <div class="banner-manager-container py-4 px-4">
                <div class="row align-items-center mb-4">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h2 class="text-center">Pressed Components Page Management</h2>
                            <div class="col-md-8">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-md-end mb-0">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('subpage.view') }}" class="text-decoration-none">
                                                <i class="fas fa-home me-1"></i> Dashboard
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Pressed Components Management
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- Form Section -->
                <div class="page-box animate-fade-in">
                    <form method="POST" action="{{ route('pressed_components.update', $pressedComponent->id ?? 0) }}"
                        enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <!-- Banner Section -->
                        <div class="section-header">
                            <h4 class="mb-3 text-uppercase"><i class="bi bi-image fs-4"></i> Banner Section</h4>
                        </div>
                        <div class="p-4 border rounded shadow-sm bg-light mb-4" data-templates="template2">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Banner Image</label>
                                    <input class="form-control" type="file" name="banner_image" accept="image/*">
                                    @if ($pressedComponent && $pressedComponent->banner_image)
                                        <img src="{{ asset('images/' . $pressedComponent->banner_image) }}" width="120"
                                            class="mt-2 rounded shadow-sm">
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Banner Title</label>
                                    <input type="text" class="form-control" name="banner_title"
                                        value="{{ $pressedComponent->banner_title ?? '' }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-medium">Description</label>
                                    <textarea class="form-control" name="description" rows="3">{{ $pressedComponent->description ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Capabilities Section -->
                        <div class="section-header">
                            <h4 class="mb-3 text-uppercase"><i class="bi bi-gear fs-4"></i> Capabilities Section</h4>
                        </div>
                        <div class="p-4 border rounded shadow-sm bg-light mb-4" data-templates="template2">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Capabilities Title</label>
                                    <input type="text" class="form-control" name="capabilities_title"
                                        value="{{ $pressedComponent->capabilities_title ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Capabilities Subtitle</label>
                                    <input type="text" class="form-control" name="capabilities_subtitle"
                                        value="{{ $pressedComponent->capabilities_subtitle ?? '' }}">
                                </div>
                            </div>

                            <!-- Dynamic Capabilities Cards -->
                            <label class="form-label fw-medium">Capabilities Cards</label>
                            <div id="capabilities-cards-container">
                                @php
                                    $capabilitiesCards = $pressedComponent->capabilities_cards ?? [
                                        ['title' => '', 'description' => ''],
                                    ];
                                @endphp
                                @foreach ($capabilitiesCards as $index => $card)
                                    <div class="dynamic-section capabilities-card" data-index="{{ $index }}">
                                        <button type="button"
                                            class="btn btn-danger btn-sm remove-btn remove-capability-card">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <input type="text" class="form-control"
                                                    name="capabilities_cards[{{ $index }}][title]"
                                                    placeholder="Card Title" value="{{ $card['title'] ?? '' }}">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <textarea class="form-control" name="capabilities_cards[{{ $index }}][description]"
                                                    placeholder="Card Description" rows="2">{{ $card['description'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-success add-more-btn" id="add-capability-card">
                                <i class="bi bi-plus-circle"></i> Add More Card
                            </button>
                        </div>

                        <!-- Industries Section -->
                        <div class="section-header">
                            <h4 class="mb-3 text-uppercase"><i class="bi bi-building fs-4"></i> Industries Section</h4>
                        </div>
                        <div class="p-4 border rounded shadow-sm bg-light mb-4" data-templates="template2">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Industries Title</label>
                                    <input type="text" class="form-control" name="industries_title"
                                        value="{{ $pressedComponent->industries_title ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Industries Subtitle</label>
                                    <input type="text" class="form-control" name="industries_subtitle"
                                        value="{{ $pressedComponent->industries_subtitle ?? '' }}">
                                </div>
                            </div>

                            <!-- Dynamic Industries Icons and Names -->
                            <label class="form-label fw-medium">Industries Icons & Names</label>
                            <div id="industries-icons-container">
                                @php
                                    $industriesIcons = $pressedComponent->industries_icons ?? [''];
                                    $industriesNames = is_string($pressedComponent->industries_name ?? '')
                                        ? json_decode($pressedComponent->industries_name, true) ?? []
                                        : [];
                                @endphp
                                @foreach ($industriesIcons as $index => $icon)
                                    <div class="dynamic-section industries-icon" data-index="{{ $index }}">
                                        <button type="button"
                                            class="btn btn-danger btn-sm remove-btn remove-industry-icon">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <label class="form-label">Industry Name</label>
                                                <input type="text" class="form-control" name="industries_name[]"
                                                    placeholder="Industry Name"
                                                    value="{{ $industriesNames[$index] ?? '' }}">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label class="form-label">Industry Icon</label>
                                                <input type="file" class="form-control" name="industries_icons[]"
                                                    accept="image/*">
                                            </div>
                                        </div>
                                        @if ($icon)
                                            <img src="{{ asset('images/' . $icon) }}" width="50" class="mt-2">
                                            <input type="hidden" name="existing_industries_icons[]"
                                                value="{{ $icon }}">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-success add-more-btn" id="add-industry-icon">
                                <i class="bi bi-plus-circle"></i> Add More Icon & Name
                            </button>
                        </div>

                        <!-- Manufacturing Capability Section -->
                        <div class="section-header">
                            <h4 class="mb-3 text-uppercase"><i class="bi bi-tools fs-4"></i> Manufacturing Capability</h4>
                        </div>
                        <div class="p-4 border rounded shadow-sm bg-light mb-4" data-templates="template2">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Title</label>
                                    <input type="text" class="form-control" name="manufacturing_capability_title"
                                        value="{{ $pressedComponent->manufacturing_capability_title ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Subtitle</label>
                                    <input type="text" class="form-control" name="manufacturing_capability_subtitle"
                                        value="{{ $pressedComponent->manufacturing_capability_subtitle ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Manufacturing Capability Image</label>
                                    <input class="form-control" type="file" name="manufacturing_capability_image"
                                        accept="image/*">
                                    @if ($pressedComponent && $pressedComponent->manufacturing_capability_image)
                                        <img src="{{ asset('images/' . $pressedComponent->manufacturing_capability_image) }}"
                                            width="120" class="mt-2 rounded shadow-sm">
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-medium">Description</label>
                                    <textarea class="form-control" name="manufacturing_capability_description" rows="3">{{ $pressedComponent->manufacturing_capability_description ?? '' }}</textarea>
                                </div>
                            </div>

                            <!-- Dynamic Infrastructure Equipments -->
                            <label class="form-label fw-medium">Infrastructure Equipments</label>
                            <div id="infrastructure-equipments-container">
                                @php
                                    $equipments = $pressedComponent->infrastructure_equipments ?? [
                                        ['title' => '', 'total_area' => '', 'production_floor' => ''],
                                    ];
                                    if (is_object($equipments) && !is_array($equipments)) {
                                        $equipments = [$equipments];
                                    }
                                @endphp
                                @foreach ($equipments as $index => $equipment)
                                    <div class="dynamic-section infrastructure-equipment"
                                        data-index="{{ $index }}">
                                        <button type="button"
                                            class="btn btn-danger btn-sm remove-btn remove-infrastructure-equipment">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <input type="text" class="form-control"
                                                    name="infrastructure_equipments[{{ $index }}][title]"
                                                    placeholder="Title"
                                                    value="{{ is_object($equipment) ? $equipment->title ?? '' : $equipment['title'] ?? '' }}">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <input type="text" class="form-control"
                                                    name="infrastructure_equipments[{{ $index }}][total_area]"
                                                    placeholder="Total Area"
                                                    value="{{ is_object($equipment) ? $equipment->total_area ?? '' : $equipment['total_area'] ?? '' }}">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <input type="text" class="form-control"
                                                    name="infrastructure_equipments[{{ $index }}][production_floor]"
                                                    placeholder="Production Floor"
                                                    value="{{ is_object($equipment) ? $equipment->production_floor ?? '' : $equipment['production_floor'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-success add-more-btn"
                                id="add-infrastructure-equipment">
                                <i class="bi bi-plus-circle"></i> Add More Equipment
                            </button>
                        </div>

                        <!-- Core Processes Section -->
                        <div class="section-header">
                            <h4 class="mb-3 text-uppercase"><i class="bi bi-diagram-3 fs-4"></i> Core Processes</h4>
                        </div>
                        <div class="p-4 border rounded shadow-sm bg-light mb-4" data-templates="template2">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Core Processes Title</label>
                                    <input type="text" class="form-control" name="core_processes_title"
                                        value="{{ $pressedComponent->core_processes_title ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Core Processes Subtitle</label>
                                    <input type="text" class="form-control" name="core_processes_subtitle"
                                        value="{{ $pressedComponent->core_processes_subtitle ?? '' }}">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label fw-medium">Core Processes Table</label>
                                <textarea name="core_processes_table" id="core-processes-editor" class="summernote">{!! old('core_processes_table', $pressedComponent->core_processes_table ?? '') !!}</textarea>
                            </div>
                        </div>

                        <!-- Quality Inspection Section -->
                        <div class="section-header">
                            <h4 class="mb-3 text-uppercase"><i class="bi bi-shield-check fs-4"></i> Quality Inspection
                            </h4>
                        </div>
                        <div class="p-4 border rounded shadow-sm bg-light mb-4" data-templates="template2">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Quality Inspection Title</label>
                                    <input type="text" class="form-control" name="quality_inspection_title"
                                        value="{{ $pressedComponent->quality_inspection_title ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Quality Inspection Subtitle</label>
                                    <input type="text" class="form-control" name="quality_inspection_subtitle"
                                        value="{{ $pressedComponent->quality_inspection_subtitle ?? '' }}">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label fw-medium">Quality Inspection Table</label>
                                <textarea name="quality_inspection_table" id="quality-inspection-editor" class="summernote">{!! old('quality_inspection_table', $pressedComponent->quality_inspection_table ?? '') !!}</textarea>
                            </div>
                        </div>

                        <!-- Technology Range Section -->
                        <div class="section-header">
                            <h4 class="mb-3 text-uppercase"><i class="bi bi-cpu fs-4"></i> Technology Range</h4>
                        </div>
                        <div class="p-4 border rounded shadow-sm bg-light mb-4" data-templates="template2">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Technology Range Title</label>
                                    <input type="text" class="form-control" name="technology_range_title"
                                        value="{{ $pressedComponent->technology_range_title ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Technology Range Subtitle</label>
                                    <input type="text" class="form-control" name="technology_range_subtitle"
                                        value="{{ $pressedComponent->technology_range_subtitle ?? '' }}">
                                </div>
                            </div>

                            <!-- Dynamic Technology Range Cards -->
                            <label class="form-label fw-medium">Technology Range Cards</label>
                            <div id="technology-cards-container">
                                @php
                                    $technologyCards = $pressedComponent->technology_range_cards ?? [
                                        ['title' => '', 'description' => '', 'image' => ''],
                                    ];
                                @endphp
                                @foreach ($technologyCards as $index => $card)
                                    <div class="dynamic-section technology-card" data-index="{{ $index }}">
                                        <button type="button"
                                            class="btn btn-danger btn-sm remove-btn remove-technology-card">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <input type="text" class="form-control"
                                                    name="technology_range_cards[{{ $index }}][title]"
                                                    placeholder="Card Title" value="{{ $card['title'] ?? '' }}">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <textarea class="form-control" name="technology_range_cards[{{ $index }}][description]"
                                                    placeholder="Description" rows="2">{{ $card['description'] ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <input type="file" class="form-control"
                                                    name="technology_range_cards_images[]" accept="image/*">
                                                @if (isset($card['image']) && $card['image'])
                                                    <img src="{{ asset('images/' . $card['image']) }}" width="50"
                                                        class="mt-2">
                                                    <input type="hidden"
                                                        name="technology_range_cards[{{ $index }}][existing_image]"
                                                        value="{{ $card['image'] }}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-success add-more-btn" id="add-technology-card">
                                <i class="bi bi-plus-circle"></i> Add More Card
                            </button>
                        </div>

                        <!-- Points Section -->
                        <div class="section-header">
                            <h4 class="mb-3 text-uppercase"><i class="bi bi-list-check fs-4"></i> Points Section</h4>
                        </div>
                        <div class="p-4 border rounded shadow-sm bg-light mb-4" data-templates="template2">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-medium">Points Section Title</label>
                                    <input type="text" class="form-control" name="point_section_title"
                                        value="{{ $pressedComponent->point_section_title ?? '' }}">
                                </div>
                            </div>

                            <!-- Dynamic Points -->
                            <label class="form-label fw-medium">Points</label>
                            <div id="points-container">
                                @php
                                    $pointsArray = is_string($pressedComponent->point_title ?? '')
                                        ? json_decode($pressedComponent->point_title, true) ?? []
                                        : [];
                                @endphp
                                @foreach ($pointsArray as $index => $point)
                                    <div class="dynamic-section point-item" data-index="{{ $index }}">
                                        <button type="button" class="btn btn-danger btn-sm remove-btn remove-point">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <input type="text" class="form-control" name="point_title[]"
                                                    placeholder="Point Title" value="{{ $point['title'] ?? '' }}">
                                            </div>
                                            <div class="col-md-8 mb-2">
                                                <textarea class="form-control" name="points[]" placeholder="Point Description" rows="2">{{ $point['description'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-success add-more-btn" id="add-point">
                                <i class="bi bi-plus-circle"></i> Add More Point
                            </button>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-5 py-2">
                                <i class="bi bi-save"></i> Update Content
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Load jQuery FIRST -->
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}

    <!-- Then Bootstrap -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}



    <!-- Then SweetAlert -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script> --}}

    <script>
        $(document).ready(function() {
            // Initialize Summernote editors
            $('.summernote').summernote({
                height: 600,
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

            let capabilityIndex = {{ count($pressedComponent->capabilities_cards ?? []) }};
            let industryIconIndex = {{ count($pressedComponent->industries_icons ?? []) }};
            let infrastructureEquipmentIndex =
                {{ is_array($pressedComponent->infrastructure_equipments ?? []) ? count($pressedComponent->infrastructure_equipments) : 1 }};
            let technologyCardIndex = {{ count($pressedComponent->technology_range_cards ?? []) }};
            let pointIndex =
                {{ count(is_string($pressedComponent->point_title ?? '') ? json_decode($pressedComponent->point_title, true) ?? [] : []) }};

            // Add Capability Card
            $('#add-capability-card').click(function() {
                const html = `
                    <div class="dynamic-section capabilities-card" data-index="${capabilityIndex}">
                        <button type="button" class="btn btn-danger btn-sm remove-btn remove-capability-card">
                            <i class="bi bi-trash"></i>
                        </button>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <input type="text" class="form-control" 
                                       name="capabilities_cards[${capabilityIndex}][title]" 
                                       placeholder="Card Title">
                            </div>
                            <div class="col-md-6 mb-2">
                                <textarea class="form-control" 
                                          name="capabilities_cards[${capabilityIndex}][description]" 
                                          placeholder="Card Description" 
                                          rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                `;
                $('#capabilities-cards-container').append(html);
                capabilityIndex++;
            });

            // Remove Capability Card
            $(document).on('click', '.remove-capability-card', function() {
                $(this).closest('.capabilities-card').remove();
            });

            // Add Industry Icon
            $('#add-industry-icon').click(function() {
                const html = `
                    <div class="dynamic-section industries-icon" data-index="${industryIconIndex}">
                        <button type="button" class="btn btn-danger btn-sm remove-btn remove-industry-icon">
                            <i class="bi bi-trash"></i>
                        </button>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Industry Name</label>
                                <input type="text" class="form-control" name="industries_name[]"
                                    placeholder="Industry Name">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Industry Icon</label>
                                <input type="file" class="form-control" 
                                       name="industries_icons[]" 
                                       accept="image/*">
                            </div>
                        </div>
                    </div>
                `;
                $('#industries-icons-container').append(html);
                industryIconIndex++;
            });

            // Remove Industry Icon
            $(document).on('click', '.remove-industry-icon', function() {
                $(this).closest('.industries-icon').remove();
            });

            // Add Infrastructure Equipment
            $('#add-infrastructure-equipment').click(function() {
                const html = `
                    <div class="dynamic-section infrastructure-equipment" data-index="${infrastructureEquipmentIndex}">
                        <button type="button" class="btn btn-danger btn-sm remove-btn remove-infrastructure-equipment">
                            <i class="bi bi-trash"></i>
                        </button>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <input type="text" class="form-control" 
                                       name="infrastructure_equipments[${infrastructureEquipmentIndex}][title]" 
                                       placeholder="Title">
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" class="form-control" 
                                       name="infrastructure_equipments[${infrastructureEquipmentIndex}][total_area]" 
                                       placeholder="Total Area">
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" class="form-control" 
                                       name="infrastructure_equipments[${infrastructureEquipmentIndex}][production_floor]" 
                                       placeholder="Production Floor">
                            </div>
                        </div>
                    </div>
                `;
                $('#infrastructure-equipments-container').append(html);
                infrastructureEquipmentIndex++;
            });

            // Remove Infrastructure Equipment
            $(document).on('click', '.remove-infrastructure-equipment', function() {
                $(this).closest('.infrastructure-equipment').remove();
            });

            // Add Technology Card
            $('#add-technology-card').click(function() {
                const html = `
                    <div class="dynamic-section technology-card" data-index="${technologyCardIndex}">
                        <button type="button" class="btn btn-danger btn-sm remove-btn remove-technology-card">
                            <i class="bi bi-trash"></i>
                        </button>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <input type="text" class="form-control" 
                                       name="technology_range_cards[${technologyCardIndex}][title]" 
                                       placeholder="Card Title">
                            </div>
                            <div class="col-md-4 mb-2">
                                <textarea class="form-control" 
                                          name="technology_range_cards[${technologyCardIndex}][description]" 
                                          placeholder="Description" 
                                          rows="2"></textarea>
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="file" class="form-control" 
                                       name="technology_range_cards_images[]" 
                                       accept="image/*">
                            </div>
                        </div>
                    </div>
                `;
                $('#technology-cards-container').append(html);
                technologyCardIndex++;
            });

            // Remove Technology Card
            $(document).on('click', '.remove-technology-card', function() {
                $(this).closest('.technology-card').remove();
            });

            // Add Point
            $('#add-point').click(function() {
                const html = `
                    <div class="dynamic-section point-item" data-index="${pointIndex}">
                        <button type="button" class="btn btn-danger btn-sm remove-btn remove-point">
                            <i class="bi bi-trash"></i>
                        </button>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <input type="text" class="form-control" 
                                       name="point_title[]" 
                                       placeholder="Point Title">
                            </div>
                            <div class="col-md-8 mb-2">
                                <textarea class="form-control" 
                                          name="points[]" 
                                          placeholder="Point Description" 
                                          rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                `;
                $('#points-container').append(html);
                pointIndex++;
            });

            // Remove Point
            $(document).on('click', '.remove-point', function() {
                $(this).closest('.point-item').remove();
            });

            // Form Validation
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: 'Please fill all required fields',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        });
    </script>
    
@endsection
