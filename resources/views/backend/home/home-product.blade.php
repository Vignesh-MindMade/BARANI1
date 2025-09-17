@extends('layouts.app')
@section('content')


<form action="{{ route('home-product-store')}}" method="post" enctype="multipart/form-data">
@csrf
 <div class="form-group">
        <label for="years_working_experience">Years of Working Experience <span style="color:red">*</span></label>
        <input type="text" class="form-control" id="years_working_experience" name="years_working_experience" style="width:50%" required>
    </div>

    <div class="form-group">
        <label for="content">Content <span style="color:red">*</span></label>
        <textarea class="form-control" id="content" name="content" rows="4" style="width:50%" required></textarea>
    </div>

    <div class="form-group">
        <label for="textile_industry">Textile Industry Description</label>
        <textarea class="form-control" id="textile_industry" name="textile_industry" rows="3" style="width:50%"></textarea>
    </div>

    <div class="form-group">
        <label for="textile_industry_image">Textile Industry Image</label>
        <input type="file" class="form-control" id="textile_industry_image" name="textile_industry_image" style="width:50%">
    </div>

    <div class="form-group">
        <label for="food_processing_industry">Food Processing Industry Description</label>
        <textarea class="form-control" id="food_processing_industry" name="food_processing_industry" rows="3" style="width:50%"></textarea>
    </div>

    <div class="form-group mb-4">
        <label for="food_processing_industry_image">Food Processing Industry Image</label>
        <input type="file" class="form-control" id="food_processing_industry_image" name="food_processing_industry_image" style="width:50%">
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

     
@endsection