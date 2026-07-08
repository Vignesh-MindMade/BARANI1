<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO -->
    <meta name="keywords"
        content="Barani Group, hydraulic systems, hydraulic cylinders, hydraulic presses, hydraulic power packs, custom hydraulic solutions, industrial hydraulics, hydraulic service and repair, Coimbatore hydraulics">
    <meta name="description"
        content="Barani Group is a leading manufacturer and service provider of high-performance hydraulic systems including cylinders, presses, and power packs. Trusted by industries for quality and reliability.">
    <meta name="author" content="Barani Group">

    <!-- Title -->
    <title>Barani Group</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/frontend/imgs/favicon.png') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Allerta+Stencil&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <!-- Fonts / Icons / CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/satoshi.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}">

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/timeline.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">-->
    
    <!--model popup-->
    <!-- GLightbox -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">


</head>

<body class="max">

    @include('layouts_front.header')

    <div  id="smooth-wrapper" class="max-width-2000">
        <div id="smooth-content">
            <main class="main-bg o-hidden">

                @yield('contentFront')

            </main>

            @include('layouts_front.footer')
        </div>
    </div>
    
    <!--model pop up-->
    
    <div class="award-modal" id="awardModal" style="backdrop-filter: blur(2px);">
    <div class="award-overlay"></div>

    <div class="award-modal-box">
        <span class="award-close">&times;</span>

        <div class="award-modal-inner">

            <!-- LEFT: IMAGE SWIPER -->
            <div class="award-slider">
                <div class="swiper awardSwiper">
                    <div class="swiper-wrapper" id="awardSwiperWrapper"></div>

                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>

            <!-- RIGHT: CONTENT -->
            <div class="award-content">
                <h3 id="awardTitle"></h3>
                <p id="awardDescription" class="preserve-text"></p>
            </div>

        </div>
    </div>
</div>

<!-- Terms & Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="max-height: 80vh;">
      
      <div class="modal-header">
        <h5 class="modal-title" id="termsModalLabel">Supplier Terms & Conditions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <!-- Scrollable Body -->
      <div class="modal-body" style="overflow-y: auto;">
        
        <h6>1. Eligibility</h6>
        <p>
          Suppliers must provide accurate, complete, and up-to-date information during registration. 
          Barani Hydraulics reserves the right to verify all submitted details before approval.
        </p>

        <h6>2. Compliance</h6>
        <p>
          All suppliers must comply with applicable laws, regulations, and industry standards. 
          Failure to comply may result in suspension or termination of supplier status.
        </p>

        <h6>3. Quality Standards</h6>
        <p>
          Products and services supplied must meet agreed specifications and quality requirements. 
          Barani Hydraulics may conduct inspections or audits when necessary.
        </p>

        <h6>4. Pricing & Payment</h6>
        <p>
          Pricing must be transparent and agreed upon in writing. Payments will be processed 
          according to mutually agreed terms stated in purchase orders or contracts.
        </p>

        <h6>5. Confidentiality</h6>
        <p>
          Suppliers must maintain confidentiality of all proprietary, technical, and commercial 
          information shared by Barani Hydraulics.
        </p>

        <h6>6. Termination</h6>
        <p>
          Barani Hydraulics reserves the right to terminate supplier agreements in cases of 
          misconduct, breach of terms, or poor performance.
        </p>

        <h6>7. Liability</h6>
        <p>
          Suppliers shall be responsible for any loss, damage, or legal consequences arising 
          from non-compliance, defective materials, or inaccurate information.
        </p>

        <h6>8. Amendments</h6>
        <p>
          These terms may be updated periodically. Continued engagement with Barani Hydraulics 
          implies acceptance of revised terms.
        </p>

      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<!--award section-->
<script>
let modal = document.getElementById("awardModal");
let wrapper = document.getElementById("awardSwiperWrapper");
let title = document.getElementById("awardTitle");
let desc = document.getElementById("awardDescription");
let swiperInstance = null;

document.querySelectorAll(".award-item").forEach(item => {
    item.addEventListener("click", () => {

        wrapper.innerHTML = "";

         let images = JSON.parse(item.dataset.images || "[]");
        images.forEach(img => {
            wrapper.innerHTML += `
                <div class="swiper-slide" style="height:auto;">
                    <img src="${img}" style="width:100%; border-radius:12px;object-fit: fill;">
                </div>`;
        });

        title.textContent = item.dataset.title;
        desc.textContent = item.dataset.description;

        modal.style.display = "block";

        if (swiperInstance) swiperInstance.destroy(true, true);

        swiperInstance = new Swiper(".awardSwiper", {
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            }
        });
    });
});

document.querySelector(".award-close").onclick = closeModal;
document.querySelector(".award-overlay").onclick = closeModal;

function closeModal() {
    modal.style.display = "none";
}
</script>

</body>

</html>
