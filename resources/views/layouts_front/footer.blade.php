
<footer class="footer-section  footer-container section-padding pb-60 text-white ">
    <div class="container">
        <div class="row">
            <div
                class="col-lg-6 col-md-12 mb-4 col-sm-12 d-flex justify-content-center flex-column align-items-center align-items-lg-start">
                <div class="footer-logo mb-3 icon-img-100">
                    <img src="{{ asset('assets/frontend/imgs/logo-light.png')}}" alt="footer-logo" />
                </div>
                @foreach($footertexts->sortBy('sort_id') as $footertext) 
                <p class="footer-para">
                  {{ $footertext->text }}
                </p>
   @endforeach
   <!--Social Links-->
           <div class="d-flex align-items-center mt-3">
    <!--<p class="pe-2 mb-0">Follow us on</p>-->

    @foreach($socials->sortBy('sort_id') as $social)
        <ul class="d-flex list-unstyled gap-2 mb-0">

            @if(!empty($social->facebook) && $social->facebook !== '#')
                <li>
                    <a href="{{ $social->facebook }}" target="_blank" class="text-white fs-5">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </li>
            @endif

            @if(!empty($social->instagram) && $social->instagram !== '#')
                <li>
                    <a href="{{ $social->instagram }}" target="_blank" class="text-white fs-5">
                        <i class="fab fa-instagram"></i>
                    </a>
                </li>
            @endif

            @if(!empty($social->twitter) && $social->twitter !== '#')
                <li>
                    <a href="{{ $social->twitter }}" target="_blank" class="text-white fs-5">
                        <i class="fab fa-twitter"></i>
                    </a>
                </li>
            @endif

            @if(!empty($social->linkedin) && $social->linkedin !== '#')
                <li>
                    <a href="{{ $social->linkedin }}" target="_blank" class="text-white fs-5">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </li>
            @endif

        </ul>
    @endforeach
</div>


            </div>
            <div
                class="col-lg-3 col-md-6 mb-0 col-sm-6  d-flex  flex-column align-items-center align-items-lg-start text-center text-lg-start">
                <h6 class="mb-2">Quick Access</h6>
                 @foreach($QuickAccess->sortBy('sort_id') as $QuickAcces)
                    <ul class="navbar-nav footer-navbar ">
                    <li class="nav-item "><a class="nav-link" target="_blank" href="{{ $QuickAcces->link }}">{{ $QuickAcces->pagename }}</a></li>
                </ul>
                @endforeach
                

            </div>

            <div
                class="col-lg-3 col-md-6 col-sm-6 mb-0 footer-address  d-flex  flex-column align-items-center align-items-lg-start ">
                <h6 class="mb-3">Corporate Address</h6>

                @foreach($contacts->sortBy('sort_id') as $contact)
                <p class="address">
                   {{ $contact->address }}
                </p>

                <p><a href="#" class="nav-link">
                        {{  $contact->contact_no_1 }}<br />
                       {{  $contact->contact_no_2 }}
                    </a></p>
                <p><a href="#" class="nav-link"> {{  $contact->mail }}</a></p>
                @endforeach
            </div>
        </div>

        <hr />

        <div class="row ">
            <div class="col-md-8  d-flex justify-content-center flex-column align-items-center align-items-lg-start">
                <p class="mb-0 copyright">Copyright © Barani Hydraulics. All rights reserved.</p>
            </div>
            <div
                class="col-md-4 text-md-end  d-flex justify-content-center flex-column align-items-center align-items-lg-end">
                <p class="mb-0 text-white-50 copyright">Website Developed By <span class="text-white">MindMade</span>
                </p>
            </div>
        </div>
    </div>
    
 
</footer>

</div>
</div>

<!--<a href="#" class="page-floating-btn">Enquire Now</a>-->
<!-- Floating button -->
@if (!empty($page->brochure))
<a href="javascript:void(0)"
   id="openBrochureForm"

   class="page-floating-btn">
   Download Brochure
</a>
@endif


<!-- Modal -->
<div class="modal fade" id="brochureModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Please fill to download</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

<form id="brochureForm" method="POST" action="{{ route('brochure.lead.store') }}">
@csrf

<!-- Hidden field to pass brochure filename - only pass if exists -->
@if (!empty($page->brochure))
<input type="hidden" name="brochure_file" value="{{ $page->brochure }}" autocomplete="off">
@endif

<div class="mb-3">
<label class="form-label">Name
<input type="text" class="form-control" name="name"autocomplete="Given name" required></label>
</div>

<div class="mb-3">
<label class="form-label">Phone Number
<input type="tel" class="form-control" name="phone" autocomplete="phone number"required></label>
</div>

<div class="mb-3">
<label class="form-label">Email
<input type="email" class="form-control" name="email" autocomplete="off" required></label>
</div>

<div class="mb-3">
<label class="form-label">Company Name
<input type="text" class="form-control" autocomplete="Company Name" name="company" required></label>
</div>

<div class="mb-3">
<label class="form-label">Country
<input type="text" class="form-control" autocomplete="country" name="country"></label>
</div>

<button type="submit" class="btn btn-primary w-100">
Submit & Download
</button>

</form>

      </div>
    </div>
  </div>
</div>

<script>
document.getElementById("openBrochureForm")?.addEventListener("click", function () {
    const modal = new bootstrap.Modal(document.getElementById("brochureModal"));
    modal.show();
});

// Close modal after form submission
document.getElementById("brochureForm")?.addEventListener("submit", function () {
    // Close the modal
    const modal = bootstrap.Modal.getInstance(document.getElementById("brochureModal"));
    if (modal) {
        modal.hide();
    }
});
</script>



<script>
document.addEventListener('DOMContentLoaded', function () {

  /* =============================
     SAFETY CHECKS
  ============================= */

  if (typeof Swiper === 'undefined') {
    console.error('❌ Swiper JS not loaded');
    return;
  }

  const mainEl  = document.querySelector('.pps-product-main-swiper');
  const thumbEl = document.querySelector('.pps-product-thumb-swiper');
if (!mainEl || !thumbEl) return;

  /* =============================
     THUMB SWIPER
  ============================= */

  window.ppsThumbsSwiper = new Swiper('.pps-product-thumb-swiper', {
        direction: 'vertical',
        spaceBetween: 15,
        slidesPerView: 3.5,
        watchSlidesProgress: true,
        speed: 600,

        navigation: {
            nextEl: '.pps-product-thumb-swiper .thumbs-next',
            prevEl: '.pps-product-thumb-swiper .thumbs-prev',
            enabled: true
        },

        breakpoints: {
            0: {
                direction: 'horizontal',
                navigation: {
                    enabled: false
                }
            },
            992: {
                direction: 'vertical',
                navigation: {
                    enabled: true
                }
            }
        }
    });

  /* =============================
     MAIN SWIPER
  ============================= */

  window.ppsMainSwiper = new Swiper(mainEl, {
    slidesPerView: 1,              // REQUIRED for fade
    speed: 700,
    effect: 'fade',
    fadeEffect: { crossFade: true },
    thumbs: {
      swiper: window.ppsThumbsSwiper
    },
    on: {
      slideChangeTransitionEnd() {
        this.slides.forEach((slide, index) => {
          const video = slide.querySelector('video');
          if (!video) return;

          if (index === this.activeIndex) {
            video.currentTime = 0;
            video.play().catch(() => {});
          } else {
            video.pause();
            video.currentTime = 0;
          }
        });
      }
    }
  });

  /* =============================
     PLAY VIDEO ON FIRST LOAD
  ============================= */

  const firstVideo = mainEl.querySelector('video');
  if (firstVideo) {
    firstVideo.muted = true;   // mobile autoplay fix
    firstVideo.play().catch(() => {});
  }

  console.log('✅ Swiper initialized', {
    main: window.ppsMainSwiper,
    thumbs: window.ppsThumbsSwiper
  });

});
</script>




<script>
const counters = document.querySelectorAll('.count');
const speed = 100; // lower = faster
const animateCounters = () => {
    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const increment = Math.ceil(target / speed);
            if (count < target) {
                counter.innerText = count + increment;
                setTimeout(updateCount, 30);
            } else {
                counter.innerText = target.toLocaleString(); // format with commas if needed
            }
        };
        updateCount();
    });
};
// Trigger when section is in viewport
const el = document.querySelector('.numbers');
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateCounters();
            observer.disconnect(); // run once
        }
    });
}, {
    threshold: 0.6
});
if (el){
observer.observe(document.querySelector('.numbers'));
}
</script>

<!--<script>-->
<!--document.addEventListener('DOMContentLoaded', function() {-->
    <!--// Service Tab switching (using custom logic, not Bootstrap)-->
<!--    const serviceTabLinks = document.querySelectorAll('.item-link');-->
<!--    const serviceTabContents = document.querySelectorAll('.serv-tab-cont .tab-content');-->
<!--    const serviceTabImages = document.querySelectorAll('.front-images > *');-->

<!--    serviceTabLinks.forEach(link => {-->
<!--        link.addEventListener('click', function() {-->
<!--            serviceTabLinks.forEach(item => item.classList.remove('current'));-->
<!--            serviceTabContents.forEach(content => content.classList.remove('current'));-->
<!--            serviceTabImages.forEach(image => image.classList.remove('current'));-->

<!--            this.classList.add('current');-->
<!--            const tabId = this.getAttribute('data-service-tab');-->
<!--            document.getElementById(tabId).classList.add('current');-->
<!--            const activeImage = document.querySelector(`.front-images .${tabId}`);-->
<!--            if (activeImage) {-->
<!--                activeImage.classList.add('current');-->
<!--            }-->
<!--        });-->
<!--    });-->

    <!--// Slider for all service tabs-->
<!--    const sliders = document.querySelectorAll('.slider-container');-->
<!--    sliders.forEach(slider => {-->
<!--        const sliderImages = slider.querySelector('.slider-images');-->
<!--        const dots = slider.querySelectorAll('.dot');-->
<!--        let currentIndex = 0;-->
<!--        const totalImages = sliderImages.querySelectorAll('img').length;-->

<!--        function updateSlider() {-->
<!--            sliderImages.style.transform = `translateX(-${currentIndex * 100}%)`;-->
<!--            dots.forEach(dot => dot.classList.remove('active'));-->
<!--            dots[currentIndex].classList.add('active');-->
<!--        }-->

<!--        dots.forEach(dot => {-->
<!--            dot.addEventListener('click', () => {-->
<!--                currentIndex = parseInt(dot.getAttribute('data-index'));-->
<!--                updateSlider();-->
<!--            });-->
<!--        });-->

        <!--// Auto-slide every 5 seconds for the active tab-->
<!--        setInterval(() => {-->
<!--            if (slider.classList.contains('current')) {-->
<!--                currentIndex = (currentIndex === totalImages - 1) ? 0 : currentIndex + 1;-->
<!--                updateSlider();-->
<!--            }-->
<!--        }, 5000);-->
<!--    });-->
<!--});-->
<!--</script>-->



<!--pdf model popup-->
<script>
document.querySelectorAll('.cert-pdf-link').forEach(link => {
    link.addEventListener('click', function () {
        const pdfUrl = this.getAttribute('data-pdf');

        document.getElementById('pdfIframe').src = pdfUrl;
        document.getElementById('pdfModal').style.display = 'flex';
    });
});

// Close modal
document.querySelector('.pdf-close').addEventListener('click', () => {
    document.getElementById('pdfIframe').src = '';
    document.getElementById('pdfModal').style.display = 'none';
});

// Close on background click
document.getElementById('pdfModal').addEventListener('click', e => {
    if (e.target.id === 'pdfModal') {
        document.getElementById('pdfIframe').src = '';
        e.target.style.display = 'none';
    }
});
</script>


<!-- jQuery -->
<script src="{{ asset('assets/frontend/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('assets/frontend/js/jquery-migrate-3.4.0.min.js')}}"></script>
<!-- plugins -->
<script src="{{ asset('assets/frontend/js/plugins.js')}}"></script>
<script src="{{ asset('assets/frontend/js/gsap.min.js')}}"></script>
<script src="{{ asset('assets/frontend/js/ScrollSmoother.min.js')}}"></script>
<script src="{{ asset('assets/frontend/js/ScrollTrigger.min.js')}}"></script>
<script src="{{ asset('assets/frontend/js/smoother-script.js')}}"></script>
<!-- custom scripts -->
<script src="{{ asset('assets/frontend/js/scripts.js')}}"></script>

<!--model popup-->
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>


