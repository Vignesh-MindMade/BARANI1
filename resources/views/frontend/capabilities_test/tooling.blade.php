@extends('layouts_front.app')
@section('contentFront')
<style>
    .tick.dot-list li:before {
    background-image: url(data:image/svg+xml;charset=utf-8;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHZpZXdCb3g9JzAgMCAxNiAxNic+PGcgZmlsbD0nbm9uZScgc3Ryb2tlPScjMWYxZjFmJyBzdHJva2UtbGluZWNhcD0ncm91bmQnIHN0cm9rZS1saW5lam9pbj0ncm91bmQnIHN0cm9rZS13aWR0aD0nMC44Jz48cGF0aCBkPSdtMTQuMjUgOC43NWMtLjUgMi41LTIuMzg0OSA0Ljg1MzYzLTUuMDMwNjkgNS4zNzk5MS0yLjY0NTc4LjUyNjMtNS4zMzA2Ni0uNzA0NC02LjY1OTAzLTMuMDUyMy0xLjMyODM3LTIuMzQ3ODQtMS4wMDA0My01LjI4MzA3LjgxMzM2LTcuMjc5ODkgMS44MTM3OS0xLjk5NjgzIDQuODc2MzYtMi41NDc3MSA3LjM3NjM2LTEuNTQ3NzEnLz48cG9seWxpbmUgcG9pbnRzPSc1Ljc1IDcuNzUgOC4yNSAxMC4yNSAxNC4yNSAzLjc1Jy8+PC9nPjwvc3ZnPg==);
}
</style>
<header class="page-header-cerv bg-img section-padding" data-background="{{asset('assets/frontend/images/banner/Tooling.webp')}}" data-overlay-dark="4">
    <div class="container pt-100 ontop">
        <div class="text-center">
            <h1 class="fz-100">Tooling
            </h1>
            <div class="mt-15 mb-4">
                <a href="#">Home</a>
                <span class="padding-rl-20">|</span>
                <span class="text-white">Tooling</span>
            </div>
        </div>
    </div>
</header>



<section class="services-dots cap-list section-padding  radius-30 ">
    <div class="container">
        
        <div class="sec-head mb-30">
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <h6 class="sub-title main-color mb-15">Tooling</h6>
                        <p>End-to-end press tooling design, manufacturing, validation and high-precision solutions with APQP/PPAP support for automotive, industrial, and consumer sectors</p>
                    </div>
                </div>
            </div>
        </div>
          

        <div class="row  ontop">
           

            <!-- Progressive Dies -->
            <div class="col-lg-6">
                <div class="item  ">
                    <img src="https://sigmadigitec.in/barani/public/assets/frontend/imgs/cap-items/1.png" alt="Progressive Dies" class="mb-20"/>
                    <h5>Progressive Dies</h5>
                    <div class="text mt-15">
                        <!--<p class="mb-30">-->
                        <!--    We design multi-station progressive dies that maximize material utilization and achieve tight tolerances for complex geometries.-->
                        <!--</p>-->
                        <ul class="rest tick dot-list fz-18 ">
                            <li class="mb-10">  We design multi-station progressive dies that maximize material utilization and achieve tight tolerances for complex geometries.</li>
                            <li class="mb-10">Optimized strip layout, pitch, and carrier design</li>
                            <li class="mb-10">In-die tapping, forming, and coining options</li>
                            <li class="mb-10">Integrated sensors for misfeed, part-out, and over-travel protection</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Transfer & Tandem Dies -->
            <div class="col-lg-6">
                <div class="item  ">
                    <img src="https://sigmadigitec.in/barani/public/assets/frontend/imgs/cap-items/2.png" alt="Transfer & Tandem Dies" class="mb-20"/>
                    <h5>Transfer & Tandem Dies</h5>
                    <div class="text mt-15">
                        <!--<p class="mb-30">-->
                        <!--    Robust tooling for large components and deep draws, ensuring stable blank-holding and wrinkle-free forming-->
                        <!--</p>-->
                       <ul class="rest tick dot-list fz-18 ">
                            <li class="mb-10">Robust tooling for large components and deep draws, ensuring stable blank-holding and wrinkle-free forming</li>
                            <li class="mb-10">Draw-bead strategy and FEM-ready concepts</li>
                            <li class="mb-10">Modular nests and quick-change tool elements</li>
                            <li class="mb-10">Interfaces for EOAT/robotic handling</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Single-Hit / Line Dies -->
            <div class="col-lg-6">
                <div class="item  ">
                    <img src="https://sigmadigitec.in/barani/public/assets/frontend/imgs/cap-items/Single_hit_die.png" alt="Single-Hit / Line Dies" class="mb-20"/>
                    <h5>Single-Hit / Line Dies</h5>
                    <div class="text mt-15">
                        <!--<p class="mb-30">-->
                        <!--    High-rigidity dies for piercing, trimming, and notching where cycle-time, tool life, and repeatability are critical-->
                        <!--</p>-->
                     <ul class="rest tick dot-list fz-18 ">
                            <li class="mb-10"> High-rigidity dies for piercing, trimming, and notching where cycle-time, tool life, and repeatability are critical</li>
                            <li class="mb-10">Carbide & coated punches</li>
                            <li class="mb-10">Guided strippers and precision bushings</li>
                            <li class="mb-10">Die protection and error-proofing systems</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Fixture Design & Gauging -->
            <div class="col-lg-6">
                <div class="item">
                    <img src="https://sigmadigitec.in/barani/public/assets/frontend/imgs/cap-items/Gauges_Icon.png" alt="Fixture Design & Gauging" class="mb-20"/>
                    <h5>Fixture Design & Gauging</h5>
                    <div class="text mt-15">
                        <!--<p class="mb-30">-->
                        <!--    Inspection fixtures aligned to GD&T, enabling reliable attribute and variable checks-->
                        <!--</p>-->
                     <ul class="rest tick dot-list fz-18 ">
                            <li class="mb-10">Inspection fixtures aligned to GD&T, enabling reliable attribute and variable checks</li>
                            <li class="mb-10">Datum strategy and tolerance stack-up analysis</li>
                            <li class="mb-10">Interchangeability studies for multi-cavity tools</li>
                            <li class="mb-10">SPC-ready measurement plans and CMM fixtures</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>





                


              




<section class="main-feat cap-sect section-padding bg-img bg-blue">
    <div class="container alternate-rows">

        <!-- Row 1 -->
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
                <div class="img md-mb50">
                    <img src="https://sigmadigitec.in/barani/public/assets/frontend/imgs/cap/end.webp" alt="" class="radius-15">
                </div>
            </div>
            <div class="col-lg-5">
                <div class="text">
                    <h4>End-to-End Tooling Delivery</h4>
                    <!--<p>From RFQ to PPAP, we deliver complete tooling programs under APQP governance</p>-->
                    <!--<p>Concept, DFM/FEA, strip layout</p>-->
                    <!--<p>Manufacturing & assembly with standardized elements</p>-->
                    <!--<p>Tryout, tuning, and capability studies (Cm/Cmk, Cpk)</p>-->
                    <ul class="rest dot-list text-white">
                                <li>From RFQ to PPAP, we deliver complete tooling programs under APQP governance</li>
                                <li>Concept, DFM/FEA, strip layout</li>
                                <li>Manufacturing & assembly with standardized elements</li>
                                <li>Tryout, tuning, and capability studies (Cm/Cmk, Cpk)</li>
                            </ul>
                </div>
            </div>
        </div>

        <!-- Row 2 -->
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-5">
                <div class="text">
                    <h4>Value Engineering</h4>
                    <!--<p>Cost and performance optimization without compromising quality</p>-->
                    <!--<p>Material and coating alternatives for tool life</p>-->
                    <!--<p>Quick-change designs for maintainability</p>-->
                    <!--<p>Sensorization and Poka-Yoke for process reliability</p>-->
                    
                                        <ul class="rest dot-list text-white">
                                <li>Cost and performance optimization without compromising quality</li>
                                <li>Material and coating alternatives for tool life</li>
                                <li>Quick-change designs for maintainability</li>
                                <li>Sensorization and Poka-Yoke for process reliability</li>
                            </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="img md-mb50">
                    <img src="https://sigmadigitec.in/barani/public/assets/frontend/imgs/cap/value.webp" alt="" class="radius-15">
                </div>
            </div>
        </div>

        <!-- Row 3 -->
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
                <div class="img md-mb50">
                    <img src="https://sigmadigitec.in/barani/public/assets/frontend/imgs/cap/Tool Maintenance.jpg" alt="" class="radius-15">
                </div>
            </div>
            <div class="col-lg-5">
                <div class="text">
                    <h4>Tool Maintenance & Refurbishment</h4>
                    <!--<p>Extend tool life and restore performance with proactive maintenance</p>-->
                    <!--<p>Wear assessment and re-grinding</p>-->
                    <!--<p>Component replacement and alignment checks</p>-->
                    <!--<p>Spare parts catalog and traceability</p>-->
                    
                                 <ul class="rest dot-list text-white">
                                <li>Extend tool life and restore performance with proactive maintenance</li>
                                <li>Wear assessment and re-grinding</li>
                                <li>Component replacement and alignment checks</li>
                                <li>Spare parts catalog and traceability</li>
                            </ul>
                </div>
            </div>
        </div>

    </div>
</section>


 <section class="process section-padding">
                    <div class="container">
                        <div class="sec-head pb-30">
                        <!--<h6 class="sub-title main-color mb-5"> </h6>-->
                        <div class="bord pt-15  d-flex align-items-center">
                            <h2><span class="fw-200">Tooling Process</span></h2>

                        </div>
                    </div>
                       <div class="tool-process tool-grid3">
    <div class="item md-mb50 pad-25px">
        <h5 class="mb-15">Requirement Capture</h5>
        
       <ul class="rest  tick dot-list fz-17">
            <li class="mb-10">Part print review</li>
            <li class="mb-10">GD&T analysis</li>
            <li class="mb-10">Feasibility and</li>
            <li class="mb-10">Risk assessment</li>
        </ul>
    </div>
    
    <div class="item md-mb50 pad-25px">
        <h5 class="mb-15">Concept & Simulation</h5>
       <ul class="rest  tick dot-list fz-17">
            <li class="mb-10">Strip layout</li>
            <li class="mb-10">Forming simulation</li>
            <li class="mb-10">Architecture and</li>
            <li class="mb-10">standard parts selection</li>
        </ul>
    </div>
    <div class="item sm-mb50 pad-25px">
        <h5 class="mb-15">Detail Design</h5>
        <ul class="rest  tick dot-list fz-17">
            <li class="mb-10">3D modeling</li>
            <li class="mb-10">BOM</li>
            <li class="mb-10">2D drawings and</li>
            <li class="mb-10">Manufacturability checks</li>
        </ul>
    </div>
    <div class="item pad-25px">
        <h5 class="mb-15">Manufacturing</h5>
       <ul class="rest  tick dot-list fz-17">
            <li class="mb-10">Inhouse - CNC</li>
            <li class="mb-10">Grinding process</li>
            <li class="mb-10">Outsource - EDM</li>
            <li class="mb-10">Grinding and</li>
            <li class="mb-10">Heat treatment</li>
        </ul>
    </div>
    <div class="item pad-25px">
        <h5 class="mb-15">Tryout & Tuning</h5>
       <ul class="rest  tick dot-list fz-17">
            <li class="mb-10">Press trials</li>
            <li class="mb-10">Dimensional validation</li>
            <li class="mb-10">Defect elimination and</li>
            <li class="mb-10">Process stabilization</li>
        </ul>
    </div>
</div>

                    </div>
                </section>
               

<section class="blog-list-crev section-padding sub-bg">
    <div class="container">

        <div class="sec-head mb-30">
            <!--<h6 class="sub-title main-color mb-15">Materials Range</h6> below clas missed "bord-thin-top"-->
            <div class="bord pt-15  d-flex align-items-center">
                <h2 class="fw-600"> <span class="fw-200"> Materials, Press Range & Standards </span> </h2>
            </div>
        </div>
         <div class="capabalities capabalities-new-boxes  row justify-content-center flex-nowrap gap-3 g-0 mw-100">
                            <!-- Section Title -->
                            
                        
                            <div class="all-items-box col-lg-4 col-md-12">
                               
                                 <h5>Materials</h5>
                                <!-- Item 1 -->
                                <div class="item-box radius-15">
                                
                                    <p>
                                        CRCA, HR, stainless steels, aluminum, HSLA, and coated steels (galvanized / galvannealed). Burr control, flatness, and surface protection tailored to part requirements.
                                    </p>
                                </div>
                        
                               
                        
                            </div>
                            <div class="all-items-box col-lg-4 col-md-12">
                               
                                <h5>Press Capacity</h5>
                                <!-- Item 1 -->
                                <div class="item-box radius-15">
                                   
                                    <p>
                                        Hydraulic presses ranging from 25T to 2000T, with bed sizes up to 2000×1200 mm
                                    </p>
                                </div>
                        
                               
                        
                            </div>
                            <div class="all-items-box col-lg-4 col-md-12">
                               
                                <h5>Tooling Standards</h5>
                                <!-- Item 1 -->
                                <div class="item-box radius-15">
                                   
                                    <p>
                                        DIN/ISO standard elements and standardized die sets for fast builds and easier maintenance.
                                    </p>
                                </div>
                        
                               
                        
                            </div>
                           
                            <!-- Second Section -->
                            
                        
                           
                        
                        </div>



    </div>
</section>



               













@endsection