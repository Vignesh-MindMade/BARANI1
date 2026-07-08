{{-- The redirect.blade.php remains the same, as it now receives $carrer from the controller --}}
@extends('layouts_front.app')
@section('contentFront')

    <div id="smooth-wrapper">
        <div id="smooth-content">
            <main class="main-bg ">
                <section class="page-header-cerv bg-img section-padding"
                    data-background="{{ asset('assets/frontend/images/banner/banner.webp') }}" data-overlay-dark="4">
                    <div class="container pt-100 ontop">
                        <div class="text-center">
                            <h1 class="fz-100">Job Application</h1>
                            <div class="mt-15 mb-4">
                                <a href="#">Home</a>
                                <span class="padding-rl-20">|</span>
                                <span class="text-white">Job Application</span>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="supplier-registration section-padding pb-20 ">
                    <div class="container">
                        <div class="row rest form-img-box">
                            <!-- Job Card -->
                            <div class="item mb-20">
                                <div class="content main-bg p-20">
                                    <div class="d-flex align-items-center mb-15">
                                        <div class="commt opacity-7 fz-16">
                                            <span class="ti-calendar mr-10"></span>Posted on date Any day
                                        </div>
                                        <div class="ml-40 commt fz-16">
                                            <span class="ti-location-pin mr-5"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4 class="mb-10"><a href="#0">Any position</a></h4>
                                        </div>
                                    </div>

                                    <div class="skill-tags d-flex gap-10 mt-10 mb-20">
                                        <p>All position</p>
                                        <p>Any experience</p>
                                        <p>Any Degree</p>
                                    </div>
                                    <!--<p>-->
                                    <!--  All users are welcome to apply for a position at Barani Group. Please fill out the job application form below with your details and upload your resume. We look forward to reviewing your application and potentially having you join our team.-->
                                    <!--</p>-->

                                    <div class="actions-job d-flex gap-15 mt-15">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="supplier-registration section-padding pt-20 ">
                    <div class="container">
                        <div class="row rest justify-content-center form-img-box">

                            <!-- Career Application Form -->
                            <div class="col-lg-7 col-12 rest">
                                <div class="form-box">
                                    <h4 class="text-center mb-10">Job Application</h4>
                                    <p class="text-center mb-30">Join our team at Barani Group. Complete the form below to
                                        apply.</p>

                                    <form id="supplier-form" method="post" action="{{ route('career.apply') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <!-- 1. Personal Information -->
                                        <div class="form-section mb-4">
                                            <label>Select Unit</label>

                                            <select name="unit" class="form-control" required>
                                                <option value="" disabled selected>Select Unit</option>
                                                <option value="Unit1">Press Manufacturing Division</option>
                                                <option value="Unit2">Pressed Components and Assembly</option>
                                                <option value="Unit3">Foundry Division</option>
                                            </select>
                                            <h6 class="mb-3">1. Personal Information</h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label>Full Name *</label>
                                                    <input type="text" name="full_name" class="form-control" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Email Address *</label>
                                                    <input type="email" name="email" class="form-control" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Phone Number *</label>
                                                    <input type="tel" name="phone" class="form-control" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Current Location *</label>
                                                    <input type="text" name="location" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 2. Job Details -->
                                        <div class="form-section mb-4">
                                            <h6>2. Job Details</h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label>Position Applying For *</label>
                                                    <input type="text" name="position" class="form-control" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Years of Experience *</label>
                                                    <input type="number" name="experience_years" class="form-control"
                                                        min="0" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Expected Salary (INR)</label>
                                                    <input type="number" name="expected_salary" class="form-control"
                                                        placeholder="Optional">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Available From *</label>
                                                    <input type="date" name="available_from" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 3. Education -->
                                        <div class="form-section mb-4">
                                            <h6>3. Education</h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label>Highest Qualification *</label>
                                                    <input type="text" name="qualification" class="form-control" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Specialization / Major</label>
                                                    <input type="text" name="specialization" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 4. Resume Upload -->
                                        <div class="form-section mb-4">
                                            <h6>4. Resume Upload</h6>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label>Upload Resume (PDF/DOC) *</label>
                                                    <input type="file" name="resume" class="form-control"
                                                        accept=".pdf,.doc,.docx" required>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label>Additional Documents (Optional)</label>
                                                    <input type="file" name="additional_docs" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Agreement -->
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" id="agreement" name="agreement"
                                                value="1" required>
                                            <label class="form-check-label" for="agreement">
                                                By checking this box, I confirm that all information provided is accurate
                                                and I agree to
                                                Barani Group <a href="#">recruitment terms and privacy policy</a>.
                                            </label>
                                        </div>

                                        <div class="mb-4">
                                            <div class="g-recaptcha"
                                                data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="butn butn-full butn-bord radius-30 max-300">
                                                <span class="text">Submit Application</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- <div class="col-lg-5 d-lg-block d-none rest">
                                    <div class="bg-image-sf"></div>
                                </div> -->
                        </div>
                    </div>
                </section>

            </main>

        </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

@endsection