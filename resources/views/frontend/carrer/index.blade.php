@extends('layouts_front.app')
@section('contentFront')



@php
    $bannerImage = optional($banner)->banner_image
        ? asset($banner->banner_image)
        : asset('assets/frontend/images/banner/Carrer.webp');
@endphp

<section class="page-header-cerv bg-img section-padding"
    data-background="{{ $bannerImage }}"
    data-overlay-dark="4">

    
    <div class="container pt-100 ontop">
        <div class="text-center">
            <h1 class="fz-100">Careers</h1>
            <div class="mt-15 mb-4">
                <a href="#">Home</a>
                <span class="padding-rl-20">|</span>
                <span class="text-white">Careers</span>
            </div>
        </div>
    </div>
</section>

<section class="wwo-sec section-padding pb-0" data-scroll-index="1">
    <div class="container">
        <div class="sec-head mb-30">
            <h6 class="sub-title main-color mb-10">Careers at Barani Group</h6>
            <div class="bord pt-15 bord-thin-top d-flex align-items-center">
                <h2>What We <span class="fw-200">Offer</span></h2>
            </div>
        </div>
        <div class="row">

          @foreach ($OrganizationDetatils as $what)
            <div class="col-lg-4">
                <div class="item-box radius-15 md-mb30">
                    <h5>{{ $what->title }}</h5>
                    <p>{{ $what->description }}</p>
                </div>
            </div>
            @endforeach  
        </div>
    </div>
</section>

<!-- ==================== Start Header ==================== -->
<section class="crev-portfolio-header section-padding position-re">
    <div class="line-overlay">
        <svg viewbox="0 0 1728 1101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M-43 773.821C160.86 662.526 451.312 637.01 610.111 733.104C768.91 829.197 932.595 1062.9 602.782 1098.75C272.969 1134.6 676.888 25.4306 1852 1"
                style="stroke-dasharray: 3246.53, 0;"></path>
        </svg>
    </div>
    <div class="container pt-50 ontop">
        <div class="row">
            <div class="col-lg-12">
                <div class="caption">
                    <h2>Join Us – Innovating the Future of Industrial Solutions. {{-- <span
                            class="underline main-color fz-30"><a href={{route('generalcareer.apply')}}>Apply Now</a></span>  --}} </h2>
                    <div class="row mt-30">
                        <div class="col-lg-4">
                            <div class="circle-button" >
                                <div class="rotate-circle fz-30 text-u" >
                                    <svg class="textcircle opacity-7" viewbox="0 0 500 500">
                                        <defs>
                                            <path id="textcircle"
                                                d="M250,400 a150,150 0 0,1 0,-300a150,150 0 0,1 0,300Z">
                                            </path>
                                        </defs>
                                        <text>
                                            <textpath xlink:href="#textcircle" textlength="900" style="font-size:40px;font-weight:700;"> Apply Now -
                                                Apply Now - Apply Now - </textpath>
                                        </text>
                                    </svg>
                                </div>
                                <div class="icon">
                                    <a href={{route('generalcareer.apply')}}>
                                    <span class="ti-arrow-down fz-40"></span> </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 valign">
                            <div class="text">
                                <p class="fz-18">At Barani Group, we believe that great work starts with great people. We are always looking for talented, passionate, and curious individuals who are eager to make an impact and grow their careers with us.</p>
                                <p class="fz-18">Whether you’re just starting out or bringing years of experience, you’ll find an environment that encourages learning, collaboration, and growth. If you’re driven by innovation and excited to be part of a dynamic team shaping the future of industrial solutions, we want to hear from you.</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-pattern bg-img opacity-4" data-background="assets/imgs/patterns/pattern2.png"></div>
</section>


<section class="blog-main section-padding pt-0">
    <div class="container">
@if(isset($Carrers) && $Carrers->count() > 0)
        <div class="row lg-marg justify-content-around">
            <!-- MAIN: Search + Location filter + Job listings -->
            <div class="col-lg-8 ">
                <div class="sidebar d-flex align-items-center justify-content-between">
                    <!-- Search + Location filter (UI only) -->
                    <div class="search-filter d-flex w-100">
                        <div class="search-box" style="flex:1; margin-right:10px;">
                            <label for="search-post" class="sr-only">Search jobs</label>
                            <input id="search-post" type="text" name="search-post"
                                placeholder="Search jobs, keywords or skills" class="w-100">
                            <span class="icon pe-7s-search" aria-hidden="true"></span>
                        </div>

                        
                    </div>
                </div>

                <!-- Intro / Careers Header -->
                <div class="md-mb80 mt-4">
                    @foreach($Carrers as $carrer)
                    <!-- Job Card -->
                    <div class="item mb-20" data-location="{{ strtolower(str_replace(' ', '-', $carrer->location)) }}" data-categories="{{ strtolower(str_replace(' ', '-', $carrer->categories)) }}">
                        <div class="content main-bg p-20">
                            <div class="d-flex align-items-center mb-15">
                                <div class="commt opacity-7 fz-13">
                                    <span class="ti-calendar mr-10"></span>Posted on {{ date('m/d/Y', strtotime($carrer->posted_at)) }}
                                </div>
                                <div class="ml-auto commt fz-13">
                                    <span class="ti-location-pin mr-5"></span>{{ $carrer->location }}
                                </div>
                            </div>
                            <h4 class="mb-10"><a href="{{ route('job_detatils.index', $carrer->id) }}"> {{ $carrer->job_title }}</a></h4>
                            <p>
                                {{ $carrer->description }}
                            </p>

                            <div class="skill-tags d-flex gap-10 mt-10">
                                <p>{{ $carrer->categories }}</p>
                                <p>8+ Years Experience</p>
                                <p>B.E. / B.Tech</p>
                            </div>

                            <div class="actions-job d-flex gap-15 mt-15">
                                <a href="{{ route('job_detatils.index', $carrer->id) }}" class="d-flex align-items-center">
                                    <span class="text mr-15">View More</span>
                                </a>
                                <a href="{{ route('job_detatils.index', $carrer->id) }}" class="d-flex align-items-center">
                                    <span class="text mr-5">Apply Now</span>
                                    <span class="ti-arrow-top-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div> <!-- md-mb80 -->


            </div> 
            @endif
            <!-- SIDEBAR: Categories -->
            <div class="col-lg-12 hr-details cont">
                
                   <div class="item-box  mb-30 ">
                                                <!--3-->
                                            <h5>Press Manufacturing Division</h5>
                                            <div class="text mt-30">
                                                <p class="mb-10">Mobile number
                                                </p>
                                                 <p><i class="fas fa-phone-alt"></i>
                                                    <a href="tel: +91 9698256665"> +91 9698256665  </a>
                                                </p>
                                            </div>
                                            <div class="text hr-links mt-30">
                                                <p class="mb-10">Email ID
                                                </p>
                                                 <p><i class="fas fa-envelope"></i>
                                                <a href="mailto:hr@bhipl.co.in">  hr@bhipl.co.in </a>
                                                </p>
                                                </p>
                                            </div>
                                            <p>
                                            
         </div>
                
                
               <div class="item-box  mb-30">
                                   
                                       
                                        <!--1-->
                                            <h5>Pressed components & Assembly Division</h5>
                                            <div class="text mt-30">
                                                <p class="mb-10">Mobile number
                                                </p>
                                                 <p><i class="fas fa-phone-alt"></i>
                                                    <a href="tel:+91 8870999691">+91 8870999691 </a>
                                                </p>
                                            </div>
                                            <div class="text hr-links mt-30">
                                                <p class="mb-10">Email ID
                                                </p>
                                                 <p><i class="fas fa-envelope"></i>
                                                <a href="mailto:hr2@bhipl.co.in">hr2@bhipl.co.in </span></a>
                                                </p>
                                                </p>
                                            </div>
                                            <p>
                                                 </div>
               <div class="item-box  mb-30 ">
                                                <!--2-->
                                            <h5>Foundry Division</h5>
                                            <div class="text mt-30">
                                                <p class="mb-10">Mobile number
                                                </p>
                                                 <p><i class="fas fa-phone-alt"></i>
                                                    <a href="tel:+91 7402612113">+91 7402612113  </a> <!-- <span class="icon ti-arrow-top-right"></span> -->
                                                </p>
                                            </div>
                                            <div class="text hr-links mt-30">
                                                <p class="mb-10">Email ID
                                                </p>
                                                 <p><i class="fas fa-envelope"></i>
                                                <a href="mailto: hrferro@barani.in"> hrferro@barani.in </a>
                                                </p>
                                                </p>
                                            </div>
                                            <p>
                                                 </div>
            
            </div>



        </div> <!-- row -->
    </div> <!-- container -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-post');
            const locationSelect = document.getElementById('location-select');
            const categoryLinks = document.querySelectorAll('.job-cat a');
            const jobItems = document.querySelectorAll('.item');

            let selectedCategory = '';

            // Category filter toggle
            categoryLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const isActive = this.parentElement.classList.contains('active');
                    categoryLinks.forEach(l => l.parentElement.classList.remove('active'));
                    if (!isActive) {
                        this.parentElement.classList.add('active');
                        selectedCategory = this.dataset.category;
                    } else {
                        selectedCategory = '';
                    }
                    filterJobs();
                });
            });

            function filterJobs() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const selectedLocation = locationSelect.value;

                jobItems.forEach(item => {
                    // Location match
                    const matchesLocation = selectedLocation === 'all' || item.dataset.location === selectedLocation;

                    // Category match
                    const matchesCategory = selectedCategory === '' || item.dataset.categories === selectedCategory;

                    // Search match
                    let matchesSearch = true;
                    if (searchTerm !== '') {
                        const title = item.querySelector('h4 a').textContent.toLowerCase();
                        const desc = item.querySelector('p').textContent.toLowerCase();
                        const catText = item.querySelector('.skill-tags p').textContent.toLowerCase();
                        matchesSearch = title.includes(searchTerm) || desc.includes(searchTerm) || catText.includes(searchTerm);
                    }

                    const show = matchesLocation && matchesCategory && matchesSearch;
                    item.style.display = show ? 'block' : 'none';
                });
            }

            // Event listeners
            searchInput.addEventListener('input', filterJobs);
            locationSelect.addEventListener('change', filterJobs);
        });
    </script>
</section>
@endsection
