
<footer class="footer-section section-padding pb-60 text-white ">
    <div class="container">
        <div class="row">
            <div
                class="col-lg-6 col-md-12 mb-4 col-sm-12 d-flex justify-content-center flex-column align-items-center align-items-lg-start">
                <div class="footer-logo mb-3 icon-img-100">
                    <img src="{{ asset('assets/frontend/imgs/logo-light.png')}}" alt="footer-logo" />
                </div>
                <p class="footer-para">
                    Barani Hydraulics India Private Limited has rich experience
                    of 21 years in Hydraulic Press manufacturing and catered to
                    variety of applications. Its Major Customers are leading
                    Corporate who are pioneers in their fields.
                </p>
                <div class="d-flex">
                    <p class="mt-3 pe-2">Follow us on</p>
                    <ul class="social-media navbar p-0 m-0 gap-2">
                        <li class="navbar-nav">
                            <a href="#" class="navbar-link social-link">
                                <iconify-icon icon="ri:facebook-fill" style="color: #fff" class="icons"></iconify-icon>
                            </a>
                        </li>
                        <li class="navbar-nav">
                            <a href="#" class="navbar-link social-link">
                                <iconify-icon icon="mdi:instagram" style="color: #fff" class="icons"></iconify-icon>
                            </a>
                        </li>
                        <li class="navbar-nav">
                            <a href="#" class="navbar-link social-link">
                                <iconify-icon icon="mdi:twitter" style="color: #fff" class="icons"></iconify-icon>
                            </a>
                        </li>
                        <li class="navbar-nav">
                            <a href="#" class="navbar-link social-link">
                                <iconify-icon icon="circum:linkedin" style="color: #fff" class="icons"></iconify-icon>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div
                class="col-lg-3 col-md-6 mb-0 col-sm-6  d-flex  flex-column align-items-center align-items-lg-start text-center text-lg-start">
                <h6 class="mb-2">Quick Access</h6>
                <ul class="navbar-nav footer-navbar ">
                    <li class="nav-item "><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Barani Group</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Products</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Capabilities</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Sustainability</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Contact Us</a></li>
                </ul>
            </div>

            <div
                class="col-lg-3 col-md-6 col-sm-6 mb-0 footer-address  d-flex  flex-column align-items-center align-items-lg-start ">
                <h6 class="mb-3">Corporate Address</h6>
                <p class="address">
                    1043 / 1, 1044 / 1, Kurumbapalaya
                    Main Road, Kalapatti, Coimbatore,
                    Tamil Nadu, India – 641 045.
                </p>
                <p><a href="#" class="nav-link">
                        +91 422 2669081, 082<br />
                        +91 98429 57026
                    </a></p>
                <p><a href="#" class="nav-link">admin@bhipl.in</a></p>
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
<!-- ==================== End Footer ==================== -->
</div>
</div>




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
observer.observe(document.querySelector('.numbers'));
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
</body>
</html>