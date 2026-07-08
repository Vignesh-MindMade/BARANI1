<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierRegistration extends Model
{
    use HasFactory;

    protected $table = 'supplier_registrations';

    protected $fillable = [
        'unit',
        // Company Information
        'company_name',
        'company_website',
        'company_address',
        'year_established',
        'business_type',

        // Primary Contact
        'contact_name',
        'job_title',
        'contact_email',
        'contact_phone',

        // Products / Services
        'product_category',
        'product_description',

        // Documentation
        'brochure',
        'certifications',
    ];
    
}
