@extends('layouts-front.app')
@section('content')
@foreach ($profiles as $profile)
     

   <div class="rts-banner-area rts-section-gap rts-breadcrumb-area project-bread position-relative" style="background-image: url({{ asset($profile->banner_image) }});">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-area-inner">
                            <span class="water-text">Profile</span>
                            <h1 class="title">
                                Profile
                            </h1>
                            <div class="nav-area-navigation">
                                <a href="#">home</a>
                                <a class="current" href="#">Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endforeach

     <!-- our working process area start -->
        <div class="section-gap dark-bg profile-wrap">
            <div class="marque-wrapper one" dir="ltr">
                <div class="marquee">
                    <span>About Us   About Us   About Us About Us   About Us</span>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title-center-wrapper-4">
                            <h3>INSPECTION . DETECTION . SORTING</h3>
                            @foreach ($profiles as $profile)
                                <p class="disc">{{ $profile->about_us_description }}</p>
                            @endforeach
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- our working process area end -->

        <div class="working-process-mt-dec-4 dark-bg flow-profile">
            <div class="container">
                <div class="row bd-process">
                    <div class="col-lg-6">
                        <div class="single-process-wrapper-4">
                            <span class="number">01</span>
                            @foreach ( $profiles as $profile)
                                <h5 class="title">{{ $profile->textile_name }}</h5>
                                <p class="pro-high">{{ $profile->textile_work }}</p>
                                <p class="disc">{{ $profile->textile_description }}</p>
                            @endforeach

               
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="single-process-wrapper-4">
                            <span class="number">02</span>
                            @foreach ( $profiles as $profile)  
                            <h5 class="title">{{ $profile->food_processing_name }}</h5>
                            <p class="pro-high">{{ $profile->food_processing_work }}</p>
                            <p class="disc">{{ $profile->food_processing_description }}</p>
                         @endforeach
                         </div>
                    </div>
                </div>
            </div>
        </div>   

        <div class="rts-offer-provide-section rts-section-gap dark-bg">
            <div class="container">
                <div class="row g-24">
                    <div class="col-lg-6">
                     @foreach ($profiles as $profile)
                         <div class="rts-single-offer">
                         <a href="service-details.html" class="thumbnail">
                              <img src="{{ asset($profile->history_image) }}" alt="History Image">
                         </a>

                         <div class="content-wrapper">
                              <a href="#">
                                   <h5 class="title">History</h5>
                              </a>
                              <p class="disc">
                                   {{ $profile->history_description }}
                              </p>
                             
                         </div>
                         </div>
                         @endforeach

                    </div>
                    <div class="col-lg-6">

                         @foreach ($profiles as $profile)
                        <div class="rts-single-offer">
                            <a href="service-details.html" class="thumbnail">
                                <img src="{{ asset($profile->management_image) }}" alt="management">
                            </a>
                            <div class="content-wrapper">
                                <a href="#">
                                    <h5 class="title">Management</h5>
                                </a>
                                <p class="disc">{{ $profile->mission_description }}</p>
                            </div>
                        </div>
                         @endforeach
                    </div>

                </div>
            </div>
        </div>


        <div class="team-area-start section-gap dark-bg">
        <div class="container">
          @foreach ($profiles as $profile )
               
         
            <div class="row align-items-center">
                <div class="col-lg-6 pr--50 pr_md--20 pr_sm--0 mb_md--60 pb_sm--30">
                    <div class="thumbnail-team-support-left position-relative">
                        <img src="{{ asset($profile->team_thumnail) }}" alt="team">
                        <div class="vedio-icone">
                            <a class="video-play-button play-video" href="{{ $profile->team_video_link }}" data-fancybox>
                                <span></span>
                            </a>
                            <div class="video-overlay">
                                <a class="video-overlay-close">×</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="team-support-area-wrapper-left-inner">
                        <div class="about-wrapper-area-five">
                            <div class="about-left-wrapper">
                                <h3 class="pre">Team</h3>
                                <p class="disc">{{ $profile->team_description }}</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
             @endforeach
        </div>
    </div>

@endsection