@extends('layouts_front.app')
@section('contentFront')
<style>
    .factory-locations {
    background: #f8f9fb;
}

.location-card {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    height: 100%;
}

.location-card h5 {
    font-weight: 600;
}

.map-embed {
    position: relative;
    width: 100%;
    height: 260px;
    overflow: hidden;
    border-radius: 10px;
}

.map-embed iframe {
    width: 100%;
    height: 100%;
    border: 0;
}

</style>
    @foreach ($Contactus as $Contact)
        <header class="page-header-cerv bg-img section-padding" data-background="{{ asset('images/' . $Contact->banner) }}"
            data-overlay-dark="4">
            <div class="container pt-100 ontop">
                <div class="text-center">
                    <h1 class="fz-100">Contact Us</h1>
                    <div class="mt-15 mb-4">
                        <a href="#">Home</a>
                        <span class="padding-rl-20">|</span>
                        <span class="text-white">Contact Us</span>
                    </div>
                </div>
            </div>
        </header>

        <section class="contact section-padding">
            <div class="container">
                <div class="row">
                    <!-- Left Content -->
                    <div class="col-lg-5 valign">
                        <div class="sec-head md-mb80">
                            <h6 class="sub-title main-color mb-5">Contact Us</h6>
                            <div class="bord pt-15 bord-thin-top d-flex align-items-center">
                                <h2>Get In <span class="fw-200"> Touch</span></h2>
                            </div>
                            <p class="mt-20 mb-20 preserve-text">{{ $Contact->pre_kg_timing }}</p>
    @endforeach

    </div>
    </div>

    <!-- Right Content (Form) -->
    <div class="col-lg-5 offset-lg-1 valign">
        <div class="full-width">
            <div class="md-hide">
                <div class="sec-head pb-30">

                    <div class="bord pt-15  d-flex align-items-center">
                        <h2>Send <span class="fw-200">A Message</span></h2>
                    </div>
                </div>
            </div>

            <div class="full-width">
                <form id="ss" method="POST" action="{{ route('contact.send') }}">
                    @csrf
                    <div class="messages"></div>
                    <div class="controls row">

                        <div class="col-lg-6">
                            <div class="form-group mb-30">
                                <input id="form_name" type="text" name="name" placeholder="Full Name"
                                    required="required">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-30">
                                <input id="form_email" type="email" name="email" placeholder="Email Address"
                                    required="required">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-30">
                                <input id="form_subject" type="text" name="subject" placeholder="What is this About?">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <textarea id="form_message" name="message" placeholder="Tell us your message" rows="4" required="required"></textarea>
                            </div>
                              <div class="mb-4">
                                            <div class="g-recaptcha"
                                                data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                        </div>
                            <div class="mt-30 d-f-c">
                                <button type="submit" class="butn butn-full butn-bord radius-30">
                                    <span class="text">Send Message</span>
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    </div>
    </section>
    
<section class="factory-locations section-padding">
    <div class="container">
        <div class="sec-head mb-50">
            <h6 class="sub-title main-color mb-10">Our Infrastructure</h6>
            <h2 class="fw-600">Factory Locations</h2>
        </div>

        <div class="row">
            <!-- Unit 1 -->
            <div class="col-lg-4 col-md-6 mb-30">
                <div class="location-card">
                    <h5 class="mb-15">Press Manufacturing Division</h5>
                    <div class="map-embed">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3915.395656231361!2d77.03314441122313!3d11.083861153401026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba8f8402f037dd1%3A0xead042a938f76d33!2sBARANI%20HYDRAULICS%20INDIA%20PRIVATE%20LIMITED!5e0!3m2!1sen!2sin!4v1768827012911!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

            <!-- Unit 2 -->
            <div class="col-lg-4 col-md-6 mb-30">
                <div class="location-card">
                    <h5 class="mb-15">Pressed Components and Assembly</h5>
                    <div class="map-embed">
                        <iframe
                            src="https://www.google.com/maps?q=Coimbatore,Tamil%20Nadu&output=embed"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Unit 3 -->
            <div class="col-lg-4 col-md-6 mb-30">
                <div class="location-card">
                    <h5 class="mb-15">Foundry Division</h5>
                    <div class="map-embed mt-">
                     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3915.2434306986984!2d77.10413751122314!3d11.095226453185633!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba8ff3248314ba3%3A0xd414d7783dd4eceb!2sBarani%20Ferrocast%20Pvt%20Ltd!5e0!3m2!1sen!2sin!4v1768826801638!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    <section class="contact detailed-cont section-padding sub-bg pt-50 pb-50">
        <div class="container">

            @foreach ($Contactus_titles as $title)
                <div class="mt-30">
                    <div class="sec-head pb-10 pt-50">
                        <div class="bord pt-5 bord-thin-top d-flex align-items-center">
                            <h2>{{ $title->title }}</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @forelse ($title->departments as $dept)
                        <div class="col-lg-3 items">
                            <div class="cont">
                                <div class="sticky-item">
                                    <h5 class="mb-10">{{ $dept->contactus_department_subtitle }}</h5>
                                    <h6 class="opacity-7 mb-5">{{ $dept->name ?? 'Vacant' }}</h6>
                                    <p class="mb-10">{{ $dept->desgination }}</p>

                                    @if ($dept->phone)
                                        <p>
                                            <i class="fas fa-phone-alt"></i>
                                            <a href="tel:{{ $dept->phone }}">{{ $dept->phone }}</a>
                                        </p>
                                    @endif

                                    @if ($dept->mail)
                                        <p>
                                            <i class="fas fa-envelope"></i>
                                            <a href="mailto:{{ $dept->mail }}">{{ $dept->mail }}</a>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted">No contacts available under this division.</p>
                        </div>
                    @endforelse
                </div>
            @endforeach

        </div>
    </section>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
