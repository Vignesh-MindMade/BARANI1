@extends("layouts.app") @section("style")
<link href="{{ asset('assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

@endsection

<style>
    #button_style {
        width: 100px;
        margin-left: 43%;
    }
</style>

@section("wrapper")
<div class="page-wrapper">
     <div class="page-content">
        
                  
          <div class="card">
               <div class="card-body">
                   <h5 style="font-size: 22px;font-family: math;font-weight: bold; color: red;">Annual Report</h5>
                   <hr>


                   <form action="{{ route('annual-report-title-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required />
                    </div>
                
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
<hr>


<form action="{{ route('annual-report-store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="annual_report_id" class="form-label">Select Title</label>
        <select class="form-control" id="annual_report_id" name="annual_report_id" required>
            <option value="">-- Select Title --</option>
            @foreach ($annualReportTitles as $title)
                <option value="{{ $title->id }}">{{ $title->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="year" class="form-label">Year</label>
        <input type="text" class="form-control" id="year" name="year"  />
    </div>

    <div class="mb-3">
        <label for="subtitle" class="form-label">Sub Title</label>
        <input type="text" class="form-control" id="subtitle" name="subtitle"  />
    </div>

    <div class="mb-3">
        <label for="text_1" class="form-label">Text 1</label>
        <input type="text" class="form-control" id="text_1" name="text_1"  />
    </div>

    <div class="mb-3">
        <label for="pdf_1" class="form-label">PDF 1</label>
        <input type="file" class="form-control" id="pdf_1" name="pdf_1" accept=".pdf" />
    </div>

    <div class="mb-3">
        <label for="text_2" class="form-label">Text 2</label>
        <input type="text" class="form-control" id="text_2" name="text_2"  />
    </div>

    <div class="mb-3">
        <label for="pdf_2" class="form-label">PDF 2</label>
        <input type="file" class="form-control" id="pdf_2" name="pdf_2" accept=".pdf" />
    </div>

    <div class="mb-3">
        <label for="text_3" class="form-label">Text 3</label>
        <input type="text" class="form-control" id="text_3" name="text_3"  />
    </div>

    <div class="mb-3">
        <label for="pdf_3" class="form-label">PDF 3</label>
        <input type="file" class="form-control" id="pdf_3" name="pdf_3" accept=".pdf" />
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>


 
               </div>
           </div>
           
    <div class="">
            
            <hr />
            <div class="">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            
                            <table  id="AnnualReport" class="table table-bordered table mb-0">
                                
                                 <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Year</th>
                                        <th>Subtitle</th>
                                        <th>Text 1</th>
                                        <th>PDF 1</th>
                                        <th>Text 2</th>
                                        <th>PDF 2</th>
                                        <th>Text 3</th>
                                        <th>PDF 3</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach($annualReports as $index => $report)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $report->title->title ?? 'N/A' }}</td>
                                            <td>{{ $report->year }}</td>
                                            <td>{{ $report->subtitle }}</td>
                                            <td>{{ $report->text_1 }}</td>
                                            <td>
                                                @if ($report->pdf_1)
                                                    <a href="{{ asset('public/pdfs/' . $report->pdf_1) }}" target="_blank">View PDF</a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $report->text_2 }}</td>
                                            <td>
                                                @if ($report->pdf_2)
                                                    <a href="{{ asset('public/pdfs/' . $report->pdf_2) }}" target="_blank">View PDF</a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $report->text_3 }}</td>
                                            <td>
                                                @if ($report->pdf_3)
                                                    <a href="{{ asset('public/pdfs/' . $report->pdf_3) }}" target="_blank">View PDF</a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                                                                <!-- In the table row -->
                                        <td>
                                            <button type="button" class=" btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editAnnualReportModal" data-id="{{ $report->id }}" data-annual-report-id="{{ $report->annual_report_id }}" data-year="{{ $report->year }}" data-subtitle="{{ $report->subtitle }}" data-text-1="{{ $report->text_1 }}" data-text-2="{{ $report->text_2 }}" data-text-3="{{ $report->text_3 }}">Edit</button>
                                            <form action="{{ route('annual-report-delete', $report->id) }}" method="POST" style="display: inline-block;" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $report->id }})">Delete</button>
                                            </form>
                                        </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
           
 
<!-- Edit Modal -->
<div class="modal fade" id="editAnnualReportModal" tabindex="-1" aria-labelledby="editAnnualReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAnnualReportModalLabel">Edit Annual Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editAnnualReportForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Select Title -->
                    <div class="mb-3">
                        <label for="edit_annual_report_id" class="form-label">Select Title</label>
                        <select class="form-control" id="edit_annual_report_id" name="annual_report_id" required>
                            <option value="">-- Select Title --</option>
                            @foreach ($annualReportTitles as $title)
                                <option value="{{ $title->id }}">{{ $title->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Year -->
                    <div class="mb-3">
                        <label for="edit_year" class="form-label">Year</label>
                        <input type="text" class="form-control" id="edit_year" name="year" />
                    </div>

                    <!-- Sub Title -->
                    <div class="mb-3">
                        <label for="edit_subtitle" class="form-label">Sub Title</label>
                        <input type="text" class="form-control" id="edit_subtitle" name="subtitle" />
                    </div>

                    <!-- Text & PDF 1 -->
                    <div class="mb-3">
                        <label for="edit_text_1" class="form-label">Text 1</label>
                        <input type="text" class="form-control" id="edit_text_1" name="text_1" />
                    </div>

                    <div class="mb-3">
                        <label for="edit_pdf_1" class="form-label">PDF 1</label>
                        <input type="file" class="form-control" id="edit_pdf_1" name="pdf_1" accept=".pdf" />
                        <div id="pdf_preview_1" class="mt-2"></div>
                    </div>

                    <!-- Text & PDF 2 -->
                    <div class="mb-3">
                        <label for="edit_text_2" class="form-label">Text 2</label>
                        <input type="text" class="form-control" id="edit_text_2" name="text_2" />
                    </div>

                    <div class="mb-3">
                        <label for="edit_pdf_2" class="form-label">PDF 2</label>
                        <input type="file" class="form-control" id="edit_pdf_2" name="pdf_2" accept=".pdf" />
                        <div id="pdf_preview_2" class="mt-2"></div>
                    </div>

                    <!-- Text & PDF 3 -->
                    <div class="mb-3">
                        <label for="edit_text_3" class="form-label">Text 3</label>
                        <input type="text" class="form-control" id="edit_text_3" name="text_3" />
                    </div>

                    <div class="mb-3">
                        <label for="edit_pdf_3" class="form-label">PDF 3</label>
                        <input type="file" class="form-control" id="edit_pdf_3" name="pdf_3" accept=".pdf" />
                        <div id="pdf_preview_3" class="mt-2"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>




</div>
</div>

 
         
     </div>
 </div>

 @endsection @section('script')
 <script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

 {{-- Sweet Alert Cdn Script --}}
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.all.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>

    $(document).ready(function () {
        $("#AnnualReport").DataTable({
            paging: true,
            lengthMenu: [5, 10, 25, 50],
            ordering: true,
            info: true,
            autoWidth: false,
            searching: true,
        });
    });
</script>




<script>
    document.addEventListener("DOMContentLoaded", function() {
        const editButtons = document.querySelectorAll(".edit-btn");

        editButtons.forEach((button) => {
            button.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const annualReportId = this.getAttribute("data-annual-report-id");
                const year = this.getAttribute("data-year");
                const subtitle = this.getAttribute("data-subtitle");
                const text1 = this.getAttribute("data-text-1");
                const text2 = this.getAttribute("data-text-2");
                const text3 = this.getAttribute("data-text-3");

                const form = document.getElementById("editAnnualReportForm");
                form.action = "{{ route('annual-report-update', ':id') }}".replace(":id", id);

                document.getElementById("edit_annual_report_id").value = annualReportId;
                document.getElementById("edit_year").value = year;
                document.getElementById("edit_subtitle").value = subtitle;
                document.getElementById("edit_text_1").value = text1;
                document.getElementById("edit_text_2").value = text2;
                document.getElementById("edit_text_3").value = text3;
            });
        });
    });



    function confirmDelete(id) {
        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Delete",
        }).then((result) => {
            if (result.isConfirmed) {
                const deleteForm = document.querySelector(`.delete-form[action*="${id}"]`);
                deleteForm.submit();
            }
        });
    }
</script>





 <script>


     function confirmDeleteTopBar(testimonialId) {
         Swal.fire({
             title: "Are you sure?",
             icon: "warning",
             showCancelButton: true,
             confirmButtonColor: "#3085d6",
             cancelButtonColor: "#d33",
             confirmButtonText: "Delete",
         }).then((result) => {
             if (result.isConfirmed) {
                 // Select the form dynamically
                 const deleteForm = document.querySelector(".delete-form-testimonial");
                 deleteForm.action = "{{ route('examcell-people-destroy', ':id') }}".replace(":id", testimonialId);
                 deleteForm.submit();
             }
         });
     }

 </script>

  @if(session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    });
</script>



@endif

@endsection
