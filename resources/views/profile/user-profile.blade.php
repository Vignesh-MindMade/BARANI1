		
@if ($message = Session::get('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ $message }}',
            confirmButtonText: 'OK'
        });
    });
</script>
@endif

    @extends("layouts.app")
    @section("wrapper")
        <div class="page-wrapper">
            <div class="page-content">

                <div class="container">
                    <div class="main-body">
                        <div class="row">
                            <!--<div class="col-lg-4">-->
                            <!--    <div class="card">-->
                            <!--        {{-- <div class="card-body">-->
                            <!--            <div class="d-flex flex-column align-items-center text-center">-->
                            <!--                <img src="assets/images/avatars/avatar-2.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">-->
                            <!--            </div>-->
                            <!--        </div> --}}-->
                            <!--    </div>-->
                            <!--</div> -->
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('profile.update') }}" method="post">
                                            @csrf
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Full Name</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Email</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Phone</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" name="mobilenumber" minlength="10" maxlength="10" value="{{ Auth::user()->mobilenumber }}" required />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Password</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="password" class="form-control" name="password" placeholder="********" />
                                                    <small class="form-text text-muted">Leave blank if you don't want to change the password</small>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="submit" class="btn btn-primary px-4" value="Save" />
                                                </div>
                                            </div>
                                        </form>
                                        
                                        
                                         
                                    </div>
                                </div>              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @endsection



