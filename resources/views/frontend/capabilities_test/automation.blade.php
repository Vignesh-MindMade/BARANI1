@extends('layouts_front.app')
@section('contentFront')


<style>
    .mar-top-30px{
        margin-top:30px;
    }
    
    .tool-process.grid-3fr {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}
</style>
<header class="page-header-cerv bg-img section-padding" data-background="{{asset('assets/frontend/images/banner/Automation.webp')}}" data-overlay-dark="4">
    <div class="container pt-100 ontop">
        <div class="text-center">
            <h1 class="fz-100">Automation
            </h1>
            <div class="mt-15 mb-4">
                <a href="#">Home</a>
                <span class="padding-rl-20">|</span>
                <span class="text-white">Automation</span>
            </div>
        </div>
    </div>
</header>

<section class="process section-padding">
                    <div class="container">
                        <div>
                        <h6 class="sub-title main-color mb-15">Automation</h6>
                        <p>From design to shop‑floor integration, we deliver turnkey automation solutions—boosting throughput, quality, and safety across your machine manufacturing operations. </p>
                    </div>
                    <!--    <div class="sec-head pb-30">-->
                        <!--<h6 class="sub-title main-color mb-5">Steps </h6>-->
                        <!--<div class="bord pt-15 bord-thin-top d-flex align-items-center">-->
                        <!--    <h2>View <span class="fw-200">Tooling Process</span></h2>-->

                        <!--</div>-->
                    <!--</div>-->
                        <div class="tool-process grid-3fr mar-top-30px">
                            <div class="  item md-mb50 pad-25px">
                                <h5 class="mb-15">Intelligent Automation</h5>
                                <p>Achieve consistent quality and faster cycle times with intelligent press line automation.</p>
                            </div>
                        
                            <div class="  item md-mb50 pad-25px">
                                <h5 class="mb-15">Advanced Press Optimization</h5>
                                <p>Reduce changeover time, prevent die crashes, and boost OEE with advanced automation technologies.</p>
                            </div>
                        
                            <div class="  item sm-mb50 pad-25px">
                                <h5 class="mb-15">Smart Digital Manufacturing</h5>
                                <p>Connect your press lines to digital twins, analytics, and IIoT for smarter, data-driven manufacturing.</p>
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
                    <img src="https://sigmadigitec.in/barani/public/assets/frontend/imgs/cap/In-Die sensing.jpg" alt="" class="radius-15">
                </div>
            </div>
            <div class="col-lg-5">
                <div class="text">
                    <h4>In‑Die Sensing & Die Protection</h4>
                    <!--<p>Sensors for strip presence, part ejection, slug detection, double‑sheet, and pilot release.</p>-->
                    <!--<p>Die protection controllers with fast I/O and press stop interlocks.</p>-->
                    <!--<p>Alarm & event historian to quickly diagnose and prevent repeat faults.</p>-->
                    
                                 <ul class="rest dot-list text-white">
                                <li>Sensors for strip presence, part ejection, slug detection, double‑sheet, and pilot release.</li>
                                <li>Die protection controllers with fast I/O and press stop interlocks.</li>
                                <li>Alarm & event historian to quickly diagnose and prevent repeat faults.</li>
                                
                            </ul>
                </div>
            </div>
        </div>

        <!-- Row 2 -->
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-5">
                <div class="text">
                    <h4>Press Monitoring & Analytics</h4>
                    <!--<p>Tonnage/press signature monitoring with envelope limits per die/part.</p>-->
                    <!--<p>Load & deflection sensors for overload protection and preventive maintenance.</p>-->
                    <!--<p>Cycle analytics: stroke rate, dwell, misfeed trends, micro‑stoppage Pareto, OEE.</p>-->
                    
                    <ul class="rest dot-list text-white">
    <li>Tonnage/press signature monitoring with envelope limits per die/part.</li>
    <li>Load & deflection sensors for overload protection and preventive maintenance.</li>
    <li>Cycle analytics: stroke rate, dwell, misfeed trends, micro-stoppage Pareto, OEE.</li>
</ul>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="img md-mb50">
                    <img src="https://sigmadigitec.in/barani/public/assets/frontend/imgs/cap/print-monitoring-analysis.jpg" alt="" class="radius-15">
                </div>
            </div>
        </div>

        <!-- Row 3 -->
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
                <div class="img md-mb50">
                    <img src="https://barani.in/public/assets/frontend/imgs/cap/Transfer & Part Handling1.jpeg" alt="" class="radius-15">
                </div>
            </div>
            <div class="col-lg-5">
                <div class="text">
                    <h4>Transfer & Part Handling</h4>
                    <!--<p>Servo transfer systems (2/3‑axis) for transfer presses and progressive dies.</p>-->
                    <!--<p>Robotic part pick‑off with tailored grippers (vacuum, magnet, mechanical).</p>-->
                    <!--<p>Outfeed conveyors with accumulation, part separation, and orientation control.</p>-->
                    
                    
                    <ul class="rest dot-list text-white">
    <li>Servo transfer systems (2/3-axis) for transfer presses and progressive dies.</li>
    <li>Robotic part pick-off with tailored grippers (vacuum, magnet, mechanical).</li>
    <li>Outfeed conveyors with accumulation, part separation, and orientation control.</li>
</ul>

                </div>
            </div>
        </div>
        
        <!-- Row 4 -->
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-5">
                <div class="text">
                    <h4>In‑Line Quality & Vision</h4>
                    <!--<p>2D/3D vision for dimensional checks, burr/split detection, and surface defects.</p>-->
                    <!--<p>Stamp quality verification (OCR/OCV for marked IDs), camera‑based centering.</p>-->
                    <!--<p>Auto reject & rework routing integrated to the line PLC/MES.</p>-->
                    
                    <ul class="rest dot-list text-white">
    <li>2D/3D vision for dimensional checks, burr/split detection, and surface defects.</li>
    <li>Stamp quality verification (OCR/OCV for marked IDs), camera-based centering.</li>
    <li>Auto reject & rework routing integrated to the line PLC/MES.</li>
</ul>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="img md-mb50">
                    <img src="https://sigmadigitec.in/barani/public/assets/frontend/imgs/cap/in-line.png" alt="" class="radius-15">
                </div>
            </div>
        </div>
        
        <!-- Row 5 -->
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
                <div class="img md-mb50">
                    <img src="https://sigmadigitec.in/barani/public/assets/frontend/imgs/cap/quick-die.png" alt="" class="radius-15">
                </div>
            </div>
            <div class="col-lg-5">
                <div class="text">
                    <h4>Quick Die Change (QDC) & Tooling Management</h4>
                    <!--<p>Die clamps, rollers, lifters, and die carts for rapid changeovers.</p>-->
                    <!--<p>RFID/tool ID & recipe recall for automatic parameter loading.</p>-->
                    <!--<p>SMED playbooks and poka‑yoke for setup verification.</p>-->
                    
                    <ul class="rest dot-list text-white">
    <li>Die clamps, rollers, lifters, and die carts for rapid changeovers.</li>
    <li>RFID/tool ID & recipe recall for automatic parameter loading.</li>
    <li>SMED playbooks and poka-yoke for setup verification.</li>
</ul>

                </div>
            </div>
        </div>
        
        <!-- Row 6 -->
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-5">
                <div class="text">
                    <h4>Safety & Compliance</h4>
                    <!--<p>Dual‑channel safety circuits, light curtains, area scanners, and muting logic.</p>-->
                    <!--<p>Hold‑to‑run, two‑hand controls, and lockout/tagout procedures.</p>-->
                    
                    <ul class="rest dot-list text-white">
    <li>Dual-channel safety circuits, light curtains, area scanners, and muting logic.</li>
    <li>Hold-to-run, two-hand controls, and lockout/tagout procedures.</li>
</ul>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="img md-mb50">
                    <img src="https://sigmadigitec.in/barani/public/assets/frontend/imgs/cap/Safety & Compliance.png" alt="" class="radius-15">
                </div>
            </div>
        </div>
        
        <!-- Row 7 -->
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
                <div class="img md-mb50">
                    <img src="https://sigmadigitec.in/barani/public/assets/frontend/imgs/cap/controls_hmi.jpg" alt="" class="radius-15">
                </div>
            </div>
            <div class="col-lg-5">
                <div class="text">
                    <h4>Controls, HMI & Connectivity</h4>
                    <!--<p>PLC/HMI (Siemens, Rockwell, Mitsubishi) with press cams, encoders, and motion control.</p>-->
                    <!--<p>ERP integration, batch/lot tracking, and SPC.</p>-->
                    <!--<p>Digital dashboards: stroke rate, OEE, alarms, and energy per part.</p>-->
                    
                    <ul class="rest dot-list text-white">
    <li>PLC/HMI (Siemens, Rockwell, Mitsubishi) with press cams, encoders, and motion control.</li>
    <li>ERP integration, batch/lot tracking, and SPC.</li>
    <li>Digital dashboards: stroke rate, OEE, alarms, and energy per part.</li>
</ul>

                </div>
            </div>
        </div>

    </div>
</section>

<section class="blog-list-crev section-padding sub-bg">
    <div class="container">

        <div class="sec-head mb-30">
            <!--<h6 class="sub-title main-color mb-15">Our Strength</h6>-->
            <div class="bord pt-15  d-flex align-items-center">
                <h2 class="fw-600"><span class="fw-200"> Our Strength </span> </h2>
            </div>
        </div>
         <div class="capabalities capabalities-new-boxes  row gap-3 g-0 mw-100" style="justify-content: space-evenly;">
                            <!-- Section Title -->
                            
                        
                            <div class="all-items-box col-lg-5 col-sm-12">
                               
                                 <h5>Engineering & Build</h5>
                                <!-- Item 1 -->
                                <div class="item-box radius-15">
                                
                                    <p>
                                        Mechanical design & retrofits including feeders, machine gaurds. <br>Controls engineering (PLC/HMI/robot), panel build, wiring.
                                    </p>
                                </div>
                        
                               
                        
                            </div>
                            <div class="all-items-box col-lg-5 col-sm-12">
                               
                                <h5>Commissioning & Optimization</h5>
                                <!-- Item 1 -->
                                <div class="item-box radius-15">
                                   
                                    <p>
                                        Onsite ramp‑up support, recipe tuning, signature envelope setting. <br> SMED implementation, mistake‑proofing, ergonomic improvements.
                                    </p>
                                </div>
                        
                               
                        
                            </div>
                            <div class="all-items-box col-lg-5 col-sm-12">
                               
                                <h5>After‑Sales & Reliability</h5>
                                <!-- Item 1 -->
                                <div class="item-box radius-15">
                                   
                                    <p>
                                        Preventive maintenance packages and spare kits. <br> Predictive maintenance (vibration/thermal/tonnage trends). <br> Remote monitoring & secure support (role‑based access). <br> Training: operators, maintenance, and vision “recipe owners”.
                                    </p>
                                </div>
                        
                               
                        
                            </div>
                           
                            <!-- Second Section -->
                            
                        
                           
                        
                        </div>



    </div>
</section>


@endsection