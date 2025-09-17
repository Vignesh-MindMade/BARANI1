@extends('layouts.app')

@section('content')
<style>
    .footer-card { transition: transform 0.3s, box-shadow 0.3s; }
    .footer-card:hover { transform: translateY(-5px); box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
    .form-control:focus { border-color: #007bff; box-shadow: 0 0 5px rgba(0,123,255,0.5); }
    .btn-primary { background-color: #007bff; border-color: #007bff; }
    .btn-primary:hover { background-color: #0056b3; border-color: #0056b3; }
    .btn-secondary { background-color: #6c757d; border-color: #6c757d; }
    .btn-secondary:hover { background-color: #5a6268; border-color: #5a6268; }
    .form-label { font-weight: 500; }
    .section-header { border-bottom: 2px solid #007bff; padding-bottom: 5px; margin-bottom: 20px; }
</style>

<div class="container py-5">
    <div class="card footer-card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0 text-white">{{ isset($footer) ? 'Edit Footer' : 'Create Footer' }}</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

<form action="{{ isset($footer) ? route('admin.footer.update', $footer->id) : route('admin.footer.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($footer))
        @method('PUT')
    @endif

    <!-- Social Media Links -->
    <h5 class="section-header">Social Media Links</h5>
    <div class="row">
        <div class="col-md-4 mb-4">
            <label for="facebook_link" class="form-label">Facebook Link</label>
            <input type="url" class="form-control @error('facebook_link') is-invalid @enderror" id="facebook_link" name="facebook_link"
                   value="{{ old('facebook_link', $footer->facebook_link ?? '') }}">
            @error('facebook_link') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-4 mb-4">
            <label for="linkedin_link" class="form-label">LinkedIn Link</label>
            <input type="url" class="form-control @error('linkedin_link') is-invalid @enderror" id="linkedin_link" name="linkedin_link"
                   value="{{ old('linkedin_link', $footer->linkedin_link ?? '') }}">
            @error('linkedin_link') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-4 mb-4">
            <label for="youtube_link" class="form-label">YouTube Link</label>
            <input type="url" class="form-control @error('youtube_link') is-invalid @enderror" id="youtube_link" name="youtube_link"
                   value="{{ old('youtube_link', $footer->youtube_link ?? '') }}">
            @error('youtube_link') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <!-- Contact Information -->
    <h5 class="section-header">Contact Information</h5>
    <div class="row">
        <div class="col-md-6 mb-4">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="4">{{ old('address', $footer->address ?? '') }}</textarea>
            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6 mb-4">
            <label for="prime_mail" class="form-label">Primary Email</label>
            <input type="email" class="form-control @error('prime_mail') is-invalid @enderror" id="prime_mail" name="prime_mail"
                   value="{{ old('prime_mail', $footer->prime_mail ?? '') }}">
            @error('prime_mail') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6 mb-4">
            <label for="optional_mail" class="form-label">Optional Email</label>
            <input type="email" class="form-control @error('optional_mail') is-invalid @enderror" id="optional_mail" name="optional_mail"
                   value="{{ old('optional_mail', $footer->optional_mail ?? '') }}">
            @error('optional_mail') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6 mb-4">
            <label for="mobile_number" class="form-label">Mobile Number</label>
            <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" id="mobile_number" name="mobile_number"
                   value="{{ old('mobile_number', $footer->mobile_number ?? '') }}">
            @error('mobile_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <!-- Sales Machines -->
    <h5 class="section-header">Sales Machines</h5>
    <div class="row">
        <div class="col-md-6 mb-4">
            <label for="sales_machines_mail" class="form-label">Email</label>
            <input type="email" class="form-control" id="sales_machines_mail" name="sales_machines_mail"
                   value="{{ old('sales_machines_mail', $footer->sales_machines_mail ?? '') }}">
        </div>
        <div class="col-md-6 mb-4">
            <label for="sales_machines_mobile" class="form-label">Mobile</label>
            <input type="text" class="form-control" id="sales_machines_mobile" name="sales_machines_mobile"
                   value="{{ old('sales_machines_mobile', $footer->sales_machines_mobile ?? '') }}">
        </div>
    </div>

    <!-- Sales Spares -->
    <h5 class="section-header">Sales Spares</h5>
    <div class="row">
        <div class="col-md-6 mb-4">
            <label for="sales_spares_mail" class="form-label">Email</label>
            <input type="email" class="form-control" id="sales_spares_mail" name="sales_spares_mail"
                   value="{{ old('sales_spares_mail', $footer->sales_spares_mail ?? '') }}">
        </div>
        <div class="col-md-6 mb-4">
            <label for="sales_spares_mobile" class="form-label">Mobile</label>
            <input type="text" class="form-control" id="sales_spares_mobile" name="sales_spares_mobile"
                   value="{{ old('sales_spares_mobile', $footer->sales_spares_mobile ?? '') }}">
        </div>
    </div>

    <!-- Installation & Commissioning -->
    <h5 class="section-header">Installation & Commissioning</h5>
    <div class="row">
        <div class="col-md-6 mb-4">
            <label for="installation_and_commissioning_mail" class="form-label">Email</label>
            <input type="email" class="form-control" id="installation_and_commissioning_mail" name="installation_and_commissioning_mail"
                   value="{{ old('installation_and_commissioning_mail', $footer->installation_and_commissioning_mail ?? '') }}">
        </div>
        <div class="col-md-6 mb-4">
            <label for="installation_and_commissioning_mobile" class="form-label">Mobile</label>
            <input type="text" class="form-control" id="installation_and_commissioning_mobile" name="installation_and_commissioning_mobile"
                   value="{{ old('installation_and_commissioning_mobile', $footer->installation_and_commissioning_mobile ?? '') }}">
        </div>
    </div>

    <!-- Product Service -->
    <h5 class="section-header">Product Service</h5>
    <div class="row">
        <div class="col-md-6 mb-4">
            <label for="product_service_mail" class="form-label">Email</label>
            <input type="email" class="form-control" id="product_service_mail" name="product_service_mail"
                   value="{{ old('product_service_mail', $footer->product_service_mail ?? '') }}">
        </div>
        <div class="col-md-6 mb-4">
            <label for="product_service_mobile" class="form-label">Mobile</label>
            <input type="text" class="form-control" id="product_service_mobile" name="product_service_mobile"
                   value="{{ old('product_service_mobile', $footer->product_service_mobile ?? '') }}">
        </div>
    </div>

    <!-- Remote Support -->
    <h5 class="section-header">Remote Support for Field Complaints</h5>
    <div class="row">
        <div class="col-md-6 mb-4">
            <label for="remote_support_for_field_complaints_mail" class="form-label">Email</label>
            <input type="email" class="form-control" id="remote_support_for_field_complaints_mail" name="remote_support_for_field_complaints_mail"
                   value="{{ old('remote_support_for_field_complaints_mail', $footer->remote_support_for_field_complaints_mail ?? '') }}">
        </div>
        <div class="col-md-6 mb-4">
            <label for="remote_support_for_field_complaints_mobile_1" class="form-label">Mobile 1</label>
            <input type="text" class="form-control" id="remote_support_for_field_complaints_mobile_1" name="remote_support_for_field_complaints_mobile_1"
                   value="{{ old('remote_support_for_field_complaints_mobile_1', $footer->remote_support_for_field_complaints_mobile_1 ?? '') }}">
        </div>
        <div class="col-md-6 mb-4">
            <label for="remote_support_for_field_complaints_mobile_2" class="form-label">Mobile 2</label>
            <input type="text" class="form-control" id="remote_support_for_field_complaints_mobile_2" name="remote_support_for_field_complaints_mobile_2"
                   value="{{ old('remote_support_for_field_complaints_mobile_2', $footer->remote_support_for_field_complaints_mobile_2 ?? '') }}">
        </div>
    </div>

    <!-- Engineer Deputation -->
    <h5 class="section-header">Engineer Deputation for Field Complaints</h5>
    <div class="row">
        <div class="col-md-6 mb-4">
            <label for="engineer_deputation_for_field_complaints_mail" class="form-label">Email</label>
            <input type="email" class="form-control" id="engineer_deputation_for_field_complaints_mail" name="engineer_deputation_for_field_complaints_mail"
                   value="{{ old('engineer_deputation_for_field_complaints_mail', $footer->engineer_deputation_for_field_complaints_mail ?? '') }}">
        </div>
        <div class="col-md-6 mb-4">
            <label for="engineer_deputation_for_field_complaints_mobile" class="form-label">Mobile</label>
            <input type="text" class="form-control" id="engineer_deputation_for_field_complaints_mobile" name="engineer_deputation_for_field_complaints_mobile"
                   value="{{ old('engineer_deputation_for_field_complaints_mobile', $footer->engineer_deputation_for_field_complaints_mobile ?? '') }}">
        </div>
    </div>

    <!-- Additional Information -->
    <h5 class="section-header">Additional Information</h5>
    <div class="mb-4">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $footer->description ?? '') }}</textarea>
        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-4">
        <label for="copy_rigts" class="form-label">Copyright Text</label>
        <input type="text" class="form-control @error('copy_rigts') is-invalid @enderror" id="copy_rigts" name="copy_rigts"
               value="{{ old('copy_rigts', $footer->copy_rigts ?? '') }}">
        @error('copy_rigts') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <!-- Buttons -->
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">{{ isset($footer) ? 'Update Footer' : 'Create Footer' }}</button>
        <a href="{{ route('admin.footer') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

        </div>
    </div>
</div>
@endsection