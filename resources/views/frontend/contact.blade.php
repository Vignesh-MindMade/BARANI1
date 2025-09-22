@extends('layouts-front.app')
@section('content')
    @foreach ($contacts as $contact)
        <div class="rts-banner-area rts-section-gap rts-breadcrumb-area project-bread position-relative"
            style="background-image: url('{{ asset($contact->banner_image) }}');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-area-inner">
                            <span class="water-text">Get in touch</span>
                            <h1 class="title">Contact Us</h1>
                            <div class="nav-area-navigation">
                                <a href="#">home</a>
                                <a class="current" href="#">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="contact-area-page dark-bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 pr--60 pr_sm--0 mb_sm--30 pr_md--10 pb_md--25 pb_sm--25">
                    <div class="contact-main-wrapper-left">
                        @foreach ($contacts as $contact)
                            <h5><span>{{ $contact->contact_title }}</span></h5>
                            <p class="disc">{{ $contact->contact_description }}</p>
                        @endforeach
                        <div class="row g-24">
                            <div class="col-lg-6">
                                <div class="quick-contact-page-1">
                                    <div class="icon">
                                        <img src="assets/images/contact/01.svg" alt="contact" />
                                    </div>
                                    <h5 class="title">Contact</h5>
                                    @foreach ($footerS as $footer)
                                        <a href="#">{{ $footer->mobile_number }}</a>
                                        <a href="#">{{ $footer->prime_mail }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="quick-contact-page-1">
                                    <div class="icon">
                                        <img src="assets/images/contact/02.svg" alt="contact" />
                                    </div>
                                    <h5 class="title">Visit us</h5>
                                    @foreach ($footerS as $footer)
                                        <p>{{ $footer->address }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">

                 <form action="{{ route('contactform.store') }}" method="POST" class="contact-form-area-wrapper">
                        @csrf
                        <h4 class="title">Let’s Get in Touch</h4>
                        <div class="half-inpur-wrapper">
                            <div class="single">
                                <input type="text" name="name" placeholder="Your Name" value="{{ old('name') }}"
                                    required />
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="single">
                                <input type="text" name="mobile_number" minlength="10" maxlength="10"
                                    placeholder="Mobile Number" value="{{ old('mobile_number') }}" required />
                                @error('mobile_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="single">
                                <input type="email" name="email" placeholder="Email Address"
                                    value="{{ old('email') }}" required />
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="single">
                            <input name="subject" type="text" placeholder="Subject" value="{{ old('subject') }}"
                                required />
                            @error('subject')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <textarea name="message" placeholder="Type Your Message" required>{{ old('message') }}</textarea>
                        @error('message')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <button type="submit" class="rts-btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="rts-map-area">
        <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3915.979629517481!2d77.03609157504572!3d11.040153989125084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sPlot%20No%3A21-24%2C%20Industrial%20Estate%20for%20Electrical%20%26%20Electronics%2C%20Civil%20Aerodrome%20Post%2C%20Coimbatore%20-%20641%20014.%20Tamil%20Nadu%2C%20India.!5e0!3m2!1sen!2sin!4v1756904434028!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thank You!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33'
            });
        </script>
    @endif
@endsection
