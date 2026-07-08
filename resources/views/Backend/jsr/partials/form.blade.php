<form method="POST" action="{{ $action }}" enctype="multipart/form-data"
    class="needs-validation mb-5 p-4 border rounded shadow-sm bg-light" novalidate>
    @csrf
    @if($method == 'PUT')
        @method('PUT')
    @endif

    <!-- Banner Section -->
    <div class="form-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0"><i class="bi bi-image me-2"></i>Banner Management</h5>
            <button type="button" class="btn btn-sm smart-btn smart-btn-success" onclick="addBannerItem()">
                <i class="bi bi-plus-circle"></i> Add Banner
            </button>
        </div>

        <div id="banner-container">

              <div class="mb-3 mt-3">
            <label class="form-label fw-medium">Menu-Name</label>
            <input class="form-control" name="menu_name" rows="3"
                placeholder="Enter menu name" value="{{ isset($item) ? $item->menu_name : 'JS' }}">
        </div>
            @if(isset($item) && $item && isset($item->banner) && is_array($item->banner))
                @foreach($item->banner as $index => $banner)
                    <div class="dynamic-item banner-item mb-3">
                        <button type="button" class="btn btn-sm btn-danger remove-item-btn" onclick="removeItem(this)">
                            <i class="bi bi-x"></i>
                        </button>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-medium">Banner Type</label>
                                <select class="form-select" name="banner[{{ $index }}][type]">
                                    <option value="image" {{ $banner['type'] == 'image' ? 'selected' : '' }}>Image</option>
                                    <option value="video" {{ $banner['type'] == 'video' ? 'selected' : '' }}>Video</option>
                                </select>
                            </div>
                            <div class="col-md-8 mb-3">
                                <label class="form-label fw-medium">Banner File</label>
                                <input class="form-control" type="file" name="banner[{{ $index }}][file]"
                                    accept="image/*,video/*">
                                <input type="hidden" name="banner[{{ $index }}][path]" value="{{ $banner['path'] ?? '' }}">
                                @if(isset($banner['path']) && $banner['path'])
                                    <div class="mt-2">
                                        @if($banner['type'] == 'image')
                                            <img src="{{ asset('uploads/jsr/' . $banner['path']) }}" width="120"
                                                class="rounded shadow-sm">
                                        @else
                                            <video width="120" class="rounded shadow-sm" controls>
                                                <source src="{{ asset('uploads/jsr/' . $banner['path']) }}" type="video/mp4">
                                            </video>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="mb-3 mt-3">
            <label class="form-label fw-medium">Banner Text</label>
            <textarea class="form-control" name="banner_text" rows="3"
                placeholder="Enter banner text">{{ isset($item) ? $item->banner_text : '' }}</textarea>
        </div>
    </div>

    <!-- About College Section -->
    <div class="form-section">
        <h5 class="mb-3"><i class="bi bi-info-circle me-2"></i>About College</h5>

        <div class="mb-3">
            <label class="form-label fw-medium">About College Description</label>
            <textarea class="form-control" name="about_college_description" rows="4"
                placeholder="Enter about college description">{{ isset($item) ? $item->about_college_description : '' }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">About College Link</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
                <input type="url" class="form-control" name="about_college_link"
                    value="{{ isset($item) ? $item->about_college_link : '' }}" placeholder="https://example.com">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Count</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calculator"></i></span>
                <input type="number" class="form-control" name="count" value="{{ isset($item) ? $item->count : '' }}"
                    placeholder="Enter count">
            </div>
        </div>
    </div>

    <!-- JSREC Description -->
    <div class="form-section">
        <h5 class="mb-3"><i class="bi bi-file-text me-2"></i>JSREC Description</h5>

        <div class="mb-3">
            <label class="form-label fw-medium">Description</label>
            <textarea class="form-control" name="jsrec_description" rows="4"
                placeholder="Enter JSREC description">{{ isset($item) ? $item->jsrec_description : '' }}</textarea>
        </div>
    </div>

    <!-- Dark Text & Light Text -->
    <div class="form-section">
        <h5 class="mb-3"><i class="bi bi-fonts me-2"></i>Text Content</h5>

        <!-- Dark Text Fields -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <label class="form-label fw-medium mb-0">Dark Text Items</label>
                <button type="button" class="btn btn-sm smart-btn smart-btn-success" onclick="addDarkTextItem()">
                    <i class="bi bi-plus-circle"></i> Add Dark Text
                </button>
            </div>
            <div id="dark-text-container">
                @if(isset($item) && $item && $item->dark_text && is_array($item->dark_text))
                    @foreach($item->dark_text as $index => $text)
                        <div class="dynamic-item mb-2">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-type"></i></span>
                                <input type="text" class="form-control" name="dark_text[]" value="{{ $text }}"
                                    placeholder="Enter dark text">
                                <button type="button" class="btn btn-danger" onclick="removeItem(this)">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Light Text Fields -->
        <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <label class="form-label fw-medium mb-0">Light Text Items</label>
                <button type="button" class="btn btn-sm smart-btn smart-btn-success" onclick="addLightTextItem()">
                    <i class="bi bi-plus-circle"></i> Add Light Text
                </button>
            </div>
            <div id="light-text-container">
                @if(isset($item) && $item && $item->light_text && is_array($item->light_text))
                    @foreach($item->light_text as $index => $text)
                        <div class="dynamic-item mb-2">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-type"></i></span>
                                <input type="text" class="form-control" name="light_text[]" value="{{ $text }}"
                                    placeholder="Enter light text">
                                <button type="button" class="btn btn-danger" onclick="removeItem(this)">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- Our Specialize Section -->
    <div class="form-section">
        <h5 class="mb-3"><i class="bi bi-star me-2"></i>Our Specialize</h5>

        <div class="mb-3">
            <label class="form-label fw-medium">Title</label>
            <input type="text" class="form-control" name="our_specialize_title"
                value="{{ isset($item) ? $item->our_specialize_title : '' }}" placeholder="Enter title">
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Subtitle</label>
            <input type="text" class="form-control" name="our_specialize_subtitle"
                value="{{ isset($item) ? $item->our_specialize_subtitle : '' }}" placeholder="Enter subtitle">
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="form-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0"><i class="bi bi-chat-quote me-2"></i>Testimonials</h5>
            <button type="button" class="btn btn-sm smart-btn smart-btn-success" onclick="addTestimonialItem()">
                <i class="bi bi-plus-circle"></i> Add Testimonial
            </button>
        </div>
{{-- Testimonial Background Image --}}
<div class="mb-4">
    <label class="form-label fw-medium">
        <i class="bi bi-image me-1"></i> Testimonial Background Image
    </label>

    <input type="file"
           class="form-control"
           name="testimoniol_bg_image"
           accept="image/*"
           onchange="previewTestimonialBg(this)">

    {{-- Preview --}}
    <div class="mt-3">
        <div class="border rounded p-2 text-center bg-light">
            <img id="testimonialBgPreview"
                 src="{{ isset($item) && $item->testimoniol_bg_image
                        ? asset('uploads/jsr/'.$item->testimoniol_bg_image)
                        : '' }}"
                 style="max-height:200px; width:auto; display:{{ isset($item) && $item->testimoniol_bg_image ? 'inline-block' : 'none' }};"
                 class="img-fluid rounded"
                 alt="Testimonial Background Preview">
        </div>
    </div>

    @if(isset($item) && $item->testimoniol_bg_image)
        <input type="hidden" name="old_testimoniol_bg_image"
               value="{{ $item->testimoniol_bg_image }}">
    @endif
</div>
        <div id="testimonial-container">
            @if(isset($item) && $item && $item->testimoniol && is_array($item->testimoniol) && count($item->testimoniol) > 0)
                {{-- Show existing testimonials --}}
                @foreach($item->testimoniol as $index => $testimonial)
                    <div class="dynamic-item testimonial-item mb-3 p-3 border rounded bg-white">
                        <button type="button" class="btn btn-sm btn-danger remove-item-btn" 
                                onclick="removeItem(this)">
                            <i class="bi bi-x"></i>
                        </button>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-medium">Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" 
                                           name="testimoniol[{{ $index }}][name]" 
                                           value="{{ $testimonial['name'] ?? '' }}"
                                           placeholder="Enter name">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-medium">Stars Rating (1-5)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-star-fill"></i></span>
                                    <select class="form-select" name="testimoniol[{{ $index }}][stars]">
                                        <option value="1" {{ (isset($testimonial['stars']) && $testimonial['stars'] == 1) ? 'selected' : '' }}>⭐ 1 Star</option>
                                        <option value="2" {{ (isset($testimonial['stars']) && $testimonial['stars'] == 2) ? 'selected' : '' }}>⭐⭐ 2 Stars</option>
                                        <option value="3" {{ (isset($testimonial['stars']) && $testimonial['stars'] == 3) ? 'selected' : '' }}>⭐⭐⭐ 3 Stars</option>
                                        <option value="4" {{ (isset($testimonial['stars']) && $testimonial['stars'] == 4) ? 'selected' : '' }}>⭐⭐⭐⭐ 4 Stars</option>
                                        <option value="5" {{ (isset($testimonial['stars']) && $testimonial['stars'] == 5) ? 'selected' : '' }}>⭐⭐⭐⭐⭐ 5 Stars</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="form-label fw-medium">Description / Message</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-chat-text"></i></span>
                                    <textarea class="form-control" name="testimoniol[{{ $index }}][description]" 
                                              rows="3" placeholder="Enter testimonial description or message">{{ $testimonial['description'] ?? $testimonial['message'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                {{-- Show first empty testimonial card by default --}}
                <div class="dynamic-item testimonial-item mb-3 p-3 border rounded bg-white">
                    <button type="button" class="btn btn-sm btn-danger remove-item-btn" 
                            onclick="removeItem(this)">
                        <i class="bi bi-x"></i>
                    </button>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" 
                                       name="testimoniol[0][name]" 
                                       placeholder="Enter name">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Stars Rating (1-5)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-star-fill"></i></span>
                                <select class="form-select" name="testimoniol[0][stars]">
                                    <option value="1">⭐ 1 Star</option>
                                    <option value="2">⭐⭐ 2 Stars</option>
                                    <option value="3">⭐⭐⭐ 3 Stars</option>
                                    <option value="4">⭐⭐⭐⭐ 4 Stars</option>
                                    <option value="5" selected>⭐⭐⭐⭐⭐ 5 Stars</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label fw-medium">Description / Message</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-chat-text"></i></span>
                                <textarea class="form-control" name="testimoniol[0][description]" 
                                          rows="3" placeholder="Enter testimonial description or message"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Our Highlights Section -->
    <div class="form-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0"><i class="bi bi-lightbulb me-2"></i>Our Highlights</h5>
            <button type="button" class="btn btn-sm smart-btn smart-btn-success" onclick="addHighlightItem()">
                <i class="bi bi-plus-circle"></i> Add Highlight
            </button>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Highlights Title</label>
            <input type="text" class="form-control" name="our_highlights"
                value="{{ isset($item) ? $item->our_highlights : '' }}" placeholder="Enter highlights title">
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Highlights Subtitle</label>
            <input type="text" class="form-control" name="our_highlights_subtitle"
                value="{{ isset($item) ? $item->our_highlights_subtitle : '' }}" placeholder="Enter highlights subtitle">
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Highlight Items</label>
            <div id="highlights-container">
                @if(isset($item) && $item && isset($item->our_highlights_items) && is_array($item->our_highlights_items))
                    @foreach($item->our_highlights_items as $index => $highlight)
                        <div class="dynamic-item highlight-item mb-3">
                            <button type="button" class="btn btn-sm btn-danger remove-item-btn"
                                onclick="removeItem(this)">
                                <i class="bi bi-x"></i>
                            </button>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Image</label>
                                    <input class="form-control" type="file"
                                        name="our_highlights_items[{{ $index }}][image]" accept="image/*">
                                    <input type="hidden" name="our_highlights_items[{{ $index }}][old_image]"
                                        value="{{ $highlight['image'] ?? '' }}">
                                    @if(isset($highlight['image']) && $highlight['image'])
                                        <img src="{{ asset('uploads/jsr/' . $highlight['image']) }}" width="80"
                                            class="mt-2 rounded">
                                    @endif
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control"
                                        name="our_highlights_items[{{ $index }}][title]"
                                        value="{{ $highlight['title'] ?? '' }}" placeholder="Enter title">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="our_highlights_items[{{ $index }}][description]" rows="2"
                                        placeholder="Enter description">{{ $highlight['description'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- Program Categories Section -->
    <div class="form-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0"><i class="bi bi-grid-3x3-gap me-2"></i>Program Categories</h5>
            <button type="button" class="btn btn-sm smart-btn smart-btn-success" onclick="addProgramCategory()">
                <i class="bi bi-plus-circle"></i> Add Category
            </button>
        </div>

        <div id="program-categories-container">
            @if(isset($item) && $item && isset($item->program_categories) && is_array($item->program_categories))
                @foreach($item->program_categories as $catIndex => $category)
                    <div class="program-category-block mb-4 p-4 border rounded bg-white position-relative">
                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2" 
                                onclick="removeItem(this)" style="z-index: 10;">
                            <i class="bi bi-x"></i> Remove Category
                        </button>

                        <div class="mb-3">
                            <label class="form-label fw-medium">Category Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-bookmark"></i></span>
                                <input type="text" class="form-control category-name" 
                                       name="program_categories[{{ $catIndex }}][category_name]" 
                                       value="{{ $category['category_name'] ?? '' }}" 
                                       placeholder="Enter category name (e.g., Engineering Programs)">
                            </div>
                        </div>

                        <div class="programs-section">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <label class="form-label fw-medium mb-0">Programs</label>
                                <button type="button" class="btn btn-sm btn-info" 
                                        onclick="addProgram(this, {{ $catIndex }})">
                                    <i class="bi bi-plus"></i> Add Program
                                </button>
                            </div>

                            <div class="programs-container">
                                @if(isset($category['programs']) && is_array($category['programs']))
                                    @foreach($category['programs'] as $progIndex => $program)
                                        <div class="program-item dynamic-item mb-3 p-3 border rounded">
                                            <button type="button" class="btn btn-sm btn-danger remove-item-btn" 
                                                    onclick="removeItem(this)">
                                                <i class="bi bi-x"></i>
                                            </button>
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <label class="form-label">Program Title</label>
                                                    <input type="text" class="form-control" 
                                                           name="program_categories[{{ $catIndex }}][programs][{{ $progIndex }}][title]" 
                                                           value="{{ $program['title'] ?? '' }}" 
                                                           placeholder="Enter program title">
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label class="form-label">Program Icon</label>
                                                    <input type="file" class="form-control" 
                                                           name="program_categories[{{ $catIndex }}][programs][{{ $progIndex }}][icon]" 
                                                           accept="image/*">
                                                    <input type="hidden" 
                                                           name="program_categories[{{ $catIndex }}][programs][{{ $progIndex }}][old_icon]" 
                                                           value="{{ $program['icon'] ?? '' }}">
                                                    @if(isset($program['icon']) && $program['icon'])
                                                        <img src="{{ asset('uploads/jsr/program_icons/' . $program['icon']) }}" 
                                                             width="50" class="mt-2 rounded">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Submit Button -->
    <div class="text-center mt-4">
        <button type="submit" class="smart-btn smart-btn-primary px-5">
            <i class="bi bi-save"></i> {{ $method == 'PUT' ? 'Update' : 'Create' }} JSR Content
        </button>
    </div>
</form>