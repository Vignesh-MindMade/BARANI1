{{-- resources/views/blogs/index.blade.php --}}

@extends('layouts_front.app')

@section('contentFront')
<section class="page-header" style="background: #888; padding: 80px 0; text-align: center;">
    <h1 style="color: white;">Our Blogs</h1>
    <nav style="color: white;">
        <a href="{{ url('/') }}">Home</a> | <span>Blog</span>
    </nav>
</section>

<section class="blog-section" style="padding: 60px 0;">
    <div class="container">
        <div class="section-header" style="text-align: center; margin-bottom: 40px;">
            <p style="text-transform: uppercase; letter-spacing: 2px; font-size: 12px; color: #666;">Latest Updates</p>
            <h2 style="color: #1a3a5c;">Industrial Knowledge & Insights</h2>
            <p style="color: #666; font-size: 14px;">
                Explore our latest blogs, technical insights, and industry updates. 
                Click on any blog to view the content.
            </p>
        </div>

        <div class="blog-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
            @forelse($blogs as $blog)
                <div class="blog-card" 
                     data-type="{{ $blog->type }}"
                     data-id="{{ $blog->id }}"
                     style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); cursor: pointer;">
                    
                    {{-- Card Thumbnail --}}
                    <div class="card-image" style="position: relative; height: 200px; overflow: hidden;">
                        <img src="{{ $blog->thumbnail_url }}" 
                             alt="{{ $blog->title }}" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                        
                        {{-- Type Badge --}}
                        <span class="type-badge" 
                              style="position: absolute; bottom: 12px; left: 12px; 
                                     background: {{ $blog->type === 'pdf' ? '#1a3a5c' : ($blog->type === 'video' ? '#e74c3c' : '#27ae60') }};
                                     color: white; padding: 4px 12px; border-radius: 20px; 
                                     font-size: 12px; display: flex; align-items: center; gap: 4px;">
                            @if($blog->type === 'pdf')
                                📄 PDF
                            @elseif($blog->type === 'video')
                                ▶ Video
                            @else
                                🖼 Image
                            @endif
                        </span>

                        {{-- Play button overlay for video --}}
                        @if($blog->type === 'video')
                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                                        width: 50px; height: 50px; background: rgba(255,255,255,0.9);
                                        border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <span style="font-size: 20px; color: #e74c3c;">▶</span>
                            </div>
                        @endif
                    </div>

                    {{-- Card Content --}}
                    <div class="card-content" style="padding: 20px;">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                            <span style="color: #888; font-size: 12px;">
                                {{ $blog->published_date ? $blog->published_date->format('d F Y') : 'No Date' }}
                            </span>
                        </div>
                        
                        <h3 style="font-size: 16px; color: #1a3a5c; margin-bottom: 8px; font-weight: 600;">
                            {{ $blog->title }}
                        </h3>
                        
                        <p style="color: #666; font-size: 13px; line-height: 1.5; margin-bottom: 16px;">
                            {{ Str::limit($blog->description, 120) }}
                        </p>

                        @if($blog->type === 'pdf')
                            <a href="{{ route('blogs.pdf.view', $blog) }}" 
                               target="_blank"
                               class="view-more-btn"
                               style="display: inline-block; padding: 8px 20px; border: 1px solid #1a3a5c;
                                      color: #1a3a5c; border-radius: 20px; text-decoration: none; font-size: 13px;
                                      transition: all 0.3s;">
                                View More
                            </a>
                        @else
                            <button class="view-more-btn open-popup" 
                                    data-type="{{ $blog->type }}"
                                    data-id="{{ $blog->id }}"
                                    style="padding: 8px 20px; border: 1px solid #1a3a5c;
                                           color: #1a3a5c; border-radius: 20px; background: white;
                                           cursor: pointer; font-size: 13px;">
                                View More
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <p style="text-align: center; color: #888; grid-column: 1 / -1;">No blogs found.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- Video Popup Modal --}}
<div id="videoModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
     background: rgba(0,0,0,0.85); z-index: 1000; align-items: center; justify-content: center;">
    <div style="position: relative; width: 80%; max-width: 900px;">
        <button onclick="closeModal('videoModal')" 
                style="position: absolute; top: -40px; right: 0; background: none; border: none;
                       color: white; font-size: 24px; cursor: pointer;">×</button>
        <div id="videoContainer" style="background: #000; border-radius: 8px; overflow: hidden;">
            {{-- Video content loaded via JS --}}
        </div>
    </div>
</div>

{{-- Image Gallery Popup Modal --}}
<div id="imageModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
     background: rgba(0,0,0,0.9); z-index: 1000; align-items: center; justify-content: center;">
    <div style="position: relative; width: 90%; max-width: 1000px;">
        <button onclick="closeModal('imageModal')" 
                style="position: absolute; top: -40px; right: 0; background: none; border: none;
                       color: white; font-size: 24px; cursor: pointer;">×</button>
        
        <div class="slider-container" style="position: relative;">
            <div id="sliderImages" style="display: flex; transition: transform 0.3s ease;">
                {{-- Images loaded via JS --}}
            </div>
            
            <button onclick="prevSlide()" 
                    style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%);
                           background: rgba(255,255,255,0.3); border: none; color: white;
                           padding: 12px 16px; border-radius: 50%; cursor: pointer; font-size: 18px;">‹</button>
            <button onclick="nextSlide()" 
                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
                           background: rgba(255,255,255,0.3); border: none; color: white;
                           padding: 12px 16px; border-radius: 50%; cursor: pointer; font-size: 18px;">›</button>
        </div>
        
        <div id="imageCaption" style="text-align: center; color: white; margin-top: 16px; font-size: 14px;"></div>
        <div id="slideCounter" style="text-align: center; color: #aaa; margin-top: 8px; font-size: 12px;"></div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    let currentSlide = 0;
    let slides = [];

    // Open popup handlers
    document.querySelectorAll('.open-popup').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const type = this.dataset.type;
            const id = this.dataset.id;
            loadBlogContent(id, type);
        });
    });

    async function loadBlogContent(id, type) {
        try {
            const response = await fetch(`/blogs/${id}`);
            const data = await response.json();

            if (type === 'video') {
                openVideoModal(data);
            } else if (type === 'image') {
                openImageModal(data);
            }
        } catch (error) {
            console.error('Error loading blog content:', error);
        }
    }

    function openVideoModal(data) {
        const container = document.getElementById('videoContainer');
        
        if (data.blog.video_source === 'upload' && data.blog.video_file) {
            container.innerHTML = `
                <video controls style="width: 100%; display: block;" poster="${data.thumbnail_url}">
                    <source src="/storage/${data.blog.video_file}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            `;
        } else if (data.embed_url) {
            container.innerHTML = `
                <iframe src="${data.embed_url}" 
                        style="width: 100%; aspect-ratio: 16/9; border: none;" 
                        allowfullscreen></iframe>
            `;
        }
        
        document.getElementById('videoModal').style.display = 'flex';
    }

    function openImageModal(data) {
        const container = document.getElementById('sliderImages');
        slides = data.images;
        currentSlide = 0;
        
        container.innerHTML = slides.map((img, index) => `
            <div class="slide" style="min-width: 100%; text-align: center;">
                <img src="${img.image_url}" 
                     alt="${img.caption || ''}" 
                     style="max-height: 70vh; max-width: 100%; object-fit: contain;">
            </div>
        `).join('');
        
        updateSlider();
        document.getElementById('imageModal').style.display = 'flex';
    }

    function updateSlider() {
        const container = document.getElementById('sliderImages');
        container.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        const caption = slides[currentSlide]?.caption || '';
        document.getElementById('imageCaption').textContent = caption;
        document.getElementById('slideCounter').textContent = `${currentSlide + 1} / ${slides.length}`;
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        updateSlider();
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        updateSlider();
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
        
        // Stop video if playing
        if (modalId === 'videoModal') {
            const video = document.querySelector('#videoContainer video');
            if (video) {
                video.pause();
                video.src = '';
            }
            const iframe = document.querySelector('#videoContainer iframe');
            if (iframe) {
                iframe.src = '';
            }
        }
    }

    // Close on backdrop click
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal(this.id);
            }
        });
    });

    // Keyboard navigation for image slider
    document.addEventListener('keydown', function(e) {
        if (document.getElementById('imageModal').style.display === 'flex') {
            if (e.key === 'ArrowRight') nextSlide();
            if (e.key === 'ArrowLeft') prevSlide();
            if (e.key === 'Escape') closeModal('imageModal');
        }
        if (document.getElementById('videoModal').style.display === 'flex' && e.key === 'Escape') {
            closeModal('videoModal');
        }
    });
</script>
@endsection