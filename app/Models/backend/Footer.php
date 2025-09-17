<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

  protected $table ="footer";

  protected $fillable = [
      'facebook_link', 'linkedin_link', 'youtube_link',
      'address', 'prime_mail', 'optional_mail',
      'mobile_number', 'description', 'copy_rigts',

      'sales_machines_mail', 'sales_machines_mobile',
      'sales_spares_mail', 'sales_spares_mobile',
      'installation_and_commissioning_mail', 'installation_and_commissioning_mobile',
      'product_service_mail', 'product_service_mobile',
      'remote_support_for_field_complaints_mail',
      'remote_support_for_field_complaints_mobile_1',
      'remote_support_for_field_complaints_mobile_2',
      'engineer_deputation_for_field_complaints_mail',
      'engineer_deputation_for_field_complaints_mobile',
  ];

}
