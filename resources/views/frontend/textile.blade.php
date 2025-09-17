@extends('layouts-front.app')
@section('content')


<style>
/* Zoom effect for modal images (40%) */
#modalProductImages img {
    transition: transform 0.3s ease, border-color 0.3s ease;
    cursor: zoom-in;
}

#modalProductImages img:hover {
    transform: scale(1.4); /* 40% zoom */
    border-color: #ff6b35;
    z-index: 2;
}

</style>
<div class="rts-banner-area rts-section-gap rts-breadcrumb-area project-bread position-relative" style="background-image: url({{ asset('uploads/profiles/1754636825_banner_image_6895a219e32e6.png') }});">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-area-inner">
                    <span class="water-text">Textile</span>
                    <h1 class="title">Textile</h1>
                    <div class="nav-area-navigation">
                        <a href="{{ url('/') }}">home</a>
                        <a class="current" href="#">Textile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-gap1 dark-bg">
    <div class="container mt-10">
        @foreach ($ProductTextiles as $Textile)
        <div class="rts-title-between-area-four mt-2 mb-3">
            <h6>{{ $Textile->catagory_name }}</h6>
        </div>

        <div class="row">
            @foreach ($Textiles->where('product_textile_id', $Textile->id) as $text)
            <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
                <div class="single-project-area-one">
                    <a href="#" class="thumbnail">
                        <img src="{{ asset($text->product_thumbnail) }}" alt="{{ $text->product_name }}" onerror="this.src='{{ asset('images/fallback.jpg') }}'" />
                    </a>
                    <div class="inner-content">
                        <h5 class="title">{{ $text->product_name }}</h5>
                        <p class="disc">{{ Str::limit($text->product_description, 50) }}</p>
                        @php
                            $imagesArray = is_array($text->images) ? $text->images : (json_decode($text->images, true) ?? []);
                            $pointsArray = is_array($text->points) ? $text->points : (json_decode($text->points, true) ?? []);
                            // Use product_brouchure if that's the column name in your database
                            $brochurePath = !empty($text->product_brouchure) ? asset($text->product_brouchure) : '';
                        @endphp

                      <button
                        type="button"
                        class="rts-btn btn-primary view-details-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#productModal"
                        data-id="{{ $text->id }}"
                        data-name="{{ e($text->product_name) }}"
                        data-description="{{ e($text->product_description) }}"
                        data-thumbnail="{{ asset($text->product_thumbnail) }}"
                        data-images='@json($imagesArray)'
                        data-points='@json($pointsArray)'
                        data-brochure="{{ $brochurePath }}"
                    >
                        View Details
                    </button>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="modalProductName"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="image-gallery me-3">
                    <div id="modalProductImages" class="d-flex flex-wrap"></div>
                </div>
                <div class="features-text">
                    <h5 class="text-primary text-uppercase" >Salient Features</h5>
                    <ul id="modalProductPoints" class="text-white"></ul>
                </div>
            </div>
            <div class="modal-footer">
                <div id="brochureContainer">
                    <a id="downloadBrochureBtntextile" href="#" class="rts-btn btn-primary" style="display: none;" download>Download Brochure</a>
                    <span id="noBrochureMessage" class="text-white" style="display: none;">No brochure available</span>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<style>
    body {
        background: #000;
        color: #fff;
    }

    .rts-banner-area {
        background-size: cover;
        background-position: center;
        padding: 100px 0 80px;
        position: relative;
    }
    .rts-banner-area::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        z-index: 1;
    }

    .breadcrumb-area-inner {
        position: relative;
        z-index: 2;
    }

    .water-text {
        font-size: 120px;
        font-weight: bold;
        color: rgba(255, 255, 255, 0.1);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
        pointer-events: none;
    }

    .breadcrumb-area-inner h1 {
        font-size: 48px;
        font-weight: bold;
        margin: 20px 0;
        position: relative;
        z-index: 2;
        color: #fff;
    }

    .nav-area-navigation {
        position: relative;
        z-index: 2;
    }

    .nav-area-navigation a {
        color: #fff;
        text-decoration: none;
        margin: 0 10px;
        text-transform: capitalize;
    }

    .nav-area-navigation a.current {
        color: #ff6b35;
    }

    .section-gap1 {
        padding: 80px 0;
        background: #000;
    }

    .dark-bg {
        background: #000 !important;
    }

    .rts-title-between-area-four {
        margin-bottom: 30px;
    }

.rts-title-between-area-four h6 {
    font-size: 24px;
    color: #F48635;
    font-weight: 600;
    margin: 0;
    text-transform: uppercase;
    font-weight: bolder;
}

    .single-project-area-one {
        background: #111;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease;
        height: 90%;
        border: 1px solid #333;
    }

    .single-project-area-one:hover {
        transform: translateY(-5px);
        border-color: #ff6b35;
    }

    .thumbnail {
        display: block;
        width: 100%;
        height: 250px;
        overflow: hidden;
    }

    .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .thumbnail:hover img {
        transform: scale(1.05);
    }

    .inner-content {
        padding: 20px;
    }

    .inner-content h5.title {
        color: #fff;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .inner-content p.disc {
        color: #ccc;
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 15px;
    }

    .rts-btn {
        background: #ff6b35;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .rts-btn:hover {
        background: #e55a2b;
        color: #fff;
        transform: translateY(-2px);
    }

    /* Modal Styles */
    .modal-content {
        background-color: #111 !important;
        color: #fff !important;
        border: 1px solid #333;
    }

    .modal-header {
        border-bottom: 1px solid #333;
        background: #000;
    }

    .modal-header .modal-title {
        color: #fff;
        font-size: 24px;
        font-weight: 600;
    }

    .modal-body {
        display: flex;
        gap: 30px;
        align-items: flex-start;
        background: #111;
        padding: 30px;
    }

    .image-gallery {
        flex: 1;
        max-width: 50%;
    }

    .image-gallery img {
        width: 100%;
        max-width: 300px;
        margin: 5px;
        border-radius: 8px;
        object-fit: cover;
        border: 2px solid #333;
        transition: border-color 0.3s ease;
    }

    .image-gallery img:hover {
        border-color: #ff6b35;
    }

    .features-text {
        flex: 1;
    }

    .features-text h5 {
        color: #ff6b35 !important;
        font-size: 20px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .features-text ul {
        list-style: none;
        padding: 0;
    }

    .features-text ul li {
        color: #ccc !important;
        margin-bottom: 12px;
        padding-left: 20px;
        position: relative;
        line-height: 1.5;
    }

    .features-text ul li:before {
        content: "●";
        color: #ff6b35;
        position: absolute;
        left: 0;
        font-weight: bold;
    }

    .modal-footer {
        border-top: 1px solid #333;
        background: #000;
    }

    .btn-close {
        filter: invert(1);
    }

    .btn-secondary {
        background: #666;
        border-color: #666;
    }

    .btn-secondary:hover {
        background: #555;
        border-color: #555;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .modal-body {
            flex-direction: column;
        }

        .image-gallery {
            max-width: 100%;
        }

        .water-text {
            font-size: 60px;
        }

        .breadcrumb-area-inner h1 {
            font-size: 32px;
        }
    }

    @media (max-width: 576px) {
        .water-text {
            font-size: 40px;
        }

        .breadcrumb-area-inner h1 {
            font-size: 24px;
        }

        .single-project-area-one {
            margin-bottom: 20px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productName = document.getElementById('modalProductName');
        const productImages = document.getElementById('modalProductImages');
        const productPoints = document.getElementById('modalProductPoints');
        const downloadBrochureBtn = document.getElementById('downloadBrochureBtntextile');
        const noBrochureMessage = document.getElementById('noBrochureMessage');

        // Event listener for all view buttons
        document.querySelectorAll('.view-details-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                try {
                    // Retrieve data attributes
                    const name = this.dataset.name || 'Unnamed Product';
                    const description = this.dataset.description || 'No description available';
                    let images = [];
                    try {
                        images = JSON.parse(this.dataset.images || '[]');
                    } catch (e) {
                        console.error('Error parsing images JSON:', e);
                    }
                    let points = [];
                    try {
                        points = JSON.parse(this.dataset.points || '[]');
                    } catch (e) {
                        console.error('Error parsing points JSON:', e);
                    }
                    const brochure = this.dataset.brochure || '';
                    const thumbnail = this.dataset.thumbnail || '{{ asset('images/fallback.jpg') }}';

                    // Debugging: Log data to console to verify
                    console.log('Product Name:', name);
                    console.log('Description:', description);
                    console.log('Images:', images);
                    console.log('Points:', points);
                    console.log('Brochure:', brochure);
                    console.log('Thumbnail:', thumbnail);

                    // Set product name
                    productName.textContent = name;

                    // Clear previous content
                    productImages.innerHTML = '';
                    productPoints.innerHTML = '';

                    // Populate images
                    if (Array.isArray(images) && images.length > 0) {
                        images.forEach(img => {
                            if (img && img.trim()) {
                                const imgElem = document.createElement('img');
                                imgElem.src = img.startsWith('http') ? img : `{{ asset('') }}${img}`;
                                imgElem.alt = name;
                                imgElem.onerror = () => {
                                    imgElem.src = thumbnail;
                                };
                                productImages.appendChild(imgElem);
                            }
                        });
                    } else {
                        const imgElem = document.createElement('img');
                        imgElem.src = thumbnail;
                        imgElem.alt = name;
                        imgElem.onerror = () => {
                            imgElem.src = '{{ asset('images/fallback.jpg') }}';
                        };
                        productImages.appendChild(imgElem);
                    }

                    // Populate points
                    if (Array.isArray(points) && points.length > 0) {
                        points.forEach(point => {
                            if (point && point.trim()) {
                                const li = document.createElement('li');
                                li.textContent = point;
                                productPoints.appendChild(li);
                            }
                        });
                    } else {
                        const li = document.createElement('li');
                        li.textContent = 'Product features will be updated soon.';
                        li.style.fontStyle = 'italic';
                        productPoints.appendChild(li);
                    }

                    // Handle brochure
                    if (brochure && brochure.trim() && brochure !== '{{ asset('') }}' && brochure !== 'null') {
                        console.log('Setting brochure link:', brochure); // Debug brochure path
                        downloadBrochureBtn.href = brochure;
                        downloadBrochureBtn.setAttribute('download', `${name}_brochure.pdf`);
                        downloadBrochureBtn.style.display = 'inline-block';
                        noBrochureMessage.style.display = 'none';
                    } else {
                        console.log('No valid brochure path, showing no brochure message');
                        downloadBrochureBtn.style.display = 'none';
                        noBrochureMessage.style.display = 'inline-block';
                    }
                } catch (error) {
                    console.error('Error populating modal:', error);
                    productName.textContent = 'Error loading product details';
                    productImages.innerHTML = '<p class="text-danger">Unable to load images.</p>';
                    productPoints.innerHTML = '<li class="text-danger">Unable to load features.</li>';
                    downloadBrochureBtn.style.display = 'none';
                    noBrochureMessage.style.display = 'inline-block';
                }
            });
        });

        // Ensure modal is properly initialized
        const productModal = new bootstrap.Modal(document.getElementById('productModal'), {
            keyboard: true,
            backdrop: 'static'
        });

        // Reset modal content when it is closed
        document.getElementById('productModal').addEventListener('hidden.bs.modal', function () {
            productName.textContent = '';
            productImages.innerHTML = '';
            productPoints.innerHTML = '';
            downloadBrochureBtn.style.display = 'none';
            noBrochureMessage.style.display = 'none';
        });
    });
</script>
@endsection
