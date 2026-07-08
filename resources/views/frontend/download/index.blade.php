@extends('layouts_front.app')
@section('contentFront')


    <div id="smooth-wrapper">
        <div id="smooth-content">
            <main class="main-bg ">
<header class="page-header-cerv bg-img section-padding" data-background="{{ asset('assets/frontend/images/banner/banner.webp') }}" data-overlay-dark="4">
    <div class="container pt-100 ontop">
        <div class="text-center">
            <h1 class="fz-100">Downloads</h1>
            <div class="mt-15 mb-4">
                <a href="#">Home</a>
                <span class="padding-rl-20">|</span>
                <span class="text-white">Downloads</span>
            </div>
        </div>
    </div>
</header>

<section class="blog-main section-padding pt-80">
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-12">
                <div class="sidebar d-flex align-items-center justify-content-between">
                    <!-- Search + Category filter -->
                    <div class="search-filter d-flex w-100">
                        <div class="search-box" style="flex:1; margin-right:10px;">
                            <label for="search-download" class="sr-only">Search downloads</label>
                            <input id="search-download" type="text" name="search-download"
                                placeholder="Search by title, keywords or file name" class="w-100">
                            <span class="icon pe-7s-search" aria-hidden="true"></span>
                        </div>

                        <div class="category-filter location-filter" style="width:220px;">
                            <label for="category-select" class="sr-only">Filter by category</label>
                            <select id="category-select" name="category" class="w-100"
                                aria-label="Filter downloads by category">
                                <option value="all">All Categories</option>
                                @php
                                    $categories = $topbars->pluck('catagory')->filter()->unique();
                                @endphp
                                @foreach ($categories as $cat)
                                    <option value="{{ strtolower($cat) }}">{{ ucfirst($cat) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="downloads-page mt-30" id="downloads-container">
                @forelse ($topbars as $download)
                    <div class="item download-item"
                        data-title="{{ strtolower($download->title) }}"
                        data-description="{{ strtolower($download->description) }}"
                        
                        data-category="{{ strtolower($download->catagory) }}">
                        <div class="content main-bg p-20">
                            <div class="d-flex align-items-center mb-15">
                                <div class="commt opacity-7 fz-13">
                                    <span class="ti-calendar mr-10"></span>
                                    Uploaded on {{ \Carbon\Carbon::parse($download->updated_on)->format('d/m/Y') }}
                                </div>
                                <div class="ml-auto commt fz-13">
                                    <span class="ti-file mr-5"></span>PDF
                                </div>
                            </div>

                            <h4 class="mb-10">
                                @if ($download->pdf)
                                    <a href="{{ asset('download_pdf/' . $download->pdf) }}" download>
                                        {{ $download->title }}
                                    </a>
                                @else
                                    {{ $download->title }}
                                @endif
                            </h4>

                            <p>{{ $download->description }}</p>
                                 <div class="skill-tags d-flex gap-10 mt-10 flex-wrap">
                                
                                    {{-- Category --}}
                                    @if ($download->catagory)
                                        <p>Category: {{ ucfirst($download->catagory) }}</p>
                                    @endif
                                
                                    {{-- Minimum Age Rules Points (same UI style) --}}
                                    @if ($download->minimum_age_rules_points)
                                        @foreach (explode(',', $download->minimum_age_rules_points) as $point)
                                            <p>{{ trim($point) }}</p>
                                        @endforeach
                                    @endif
                                
                                </div>



                            @if ($download->pdf)
                                <div class="actions-job d-flex gap-15 mt-15">
                                    <a href="{{ asset('download_pdf/' . $download->pdf) }}" target="_blank"
                                        class="d-flex align-items-center">
                                        <span class="text mr-15">View File</span>
                                        <span class="ti-eye"></span>
                                    </a>
                                    <a href="{{ asset('download_pdf/' . $download->pdf) }}" download
                                        class="d-flex align-items-center">
                                        <span class="text mr-5">Download</span>
                                        <span class="ti-download"></span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-center mt-30">No downloads available.</p>
                @endforelse
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!-- 🔍 Dynamic Search + Filter Script -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search-download");
    const categorySelect = document.getElementById("category-select");
    const downloadItems = document.querySelectorAll(".download-item");

    function filterDownloads() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = categorySelect.value.toLowerCase();

        downloadItems.forEach(item => {
            const title = item.getAttribute("data-title");
            const description = item.getAttribute("data-description");
            const category = item.getAttribute("data-category");

            const matchesSearch =
                title.includes(searchTerm) || description.includes(searchTerm);
            const matchesCategory =
                selectedCategory === "all" || category === selectedCategory;

            if (matchesSearch && matchesCategory) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
    }

    searchInput.addEventListener("keyup", filterDownloads);
    categorySelect.addEventListener("change", filterDownloads);
});
</script>




</main>


@endsection