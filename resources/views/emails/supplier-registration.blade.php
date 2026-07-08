<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }

        .header {
            background-color: #0056b3;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h3 {
            color: #0056b3;
            border-bottom: 2px solid #0056b3;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .info-row {
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }

        .label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            min-width: 150px;
        }

        .value {
            color: #333;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #777;
            font-size: 12px;
        }

        .unit-badge {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>{{ $isUpdate ? 'Supplier Registration Updated' : 'New Supplier Registration' }}</h2>
            @if (!empty($supplierData['unit']))
                <span class="unit-badge">{{ $supplierData['unit'] }}</span>
            @endif
        </div>

        <div class="content">
            <div class="section">
                <h3>Company Information</h3>
                @if (!empty($supplierData['unit']))
                    <div class="info-row">
                        <span class="label">Unit:</span>
                        <span class="value">{{ $supplierData['unit'] }}</span>
                    </div>
                @endif
                <div class="info-row">
                    <span class="label">Company Name:</span>
                    <span class="value">{{ $supplierData['company_name'] }}</span>
                </div>
                @if (!empty($supplierData['company_website']))
                    <div class="info-row">
                        <span class="label">Website:</span>
                        <span class="value"><a
                                href="{{ $supplierData['company_website'] }}">{{ $supplierData['company_website'] }}</a></span>
                    </div>
                @endif
                <div class="info-row">
                    <span class="label">Address:</span>
                    <span class="value">{{ $supplierData['company_address'] }}</span>
                </div>
                @if (!empty($supplierData['year_established']))
                    <div class="info-row">
                        <span class="label">Year Established:</span>
                        <span class="value">{{ $supplierData['year_established'] }}</span>
                    </div>
                @endif
                @if (!empty($supplierData['business_type']))
                    <div class="info-row">
                        <span class="label">Business Type:</span>
                        <span class="value">{{ $supplierData['business_type'] }}</span>
                    </div>
                @endif
            </div>

            <div class="section">
                <h3>Primary Contact</h3>
                <div class="info-row">
                    <span class="label">Name:</span>
                    <span class="value">{{ $supplierData['contact_name'] }}</span>
                </div>
                @if (!empty($supplierData['job_title']))
                    <div class="info-row">
                        <span class="label">Job Title:</span>
                        <span class="value">{{ $supplierData['job_title'] }}</span>
                    </div>
                @endif
                <div class="info-row">
                    <span class="label">Email:</span>
                    <span class="value">{{ $supplierData['contact_email'] }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Phone:</span>
                    <span class="value">{{ $supplierData['contact_phone'] }}</span>
                </div>
            </div>

            <div class="section">
                <h3>Products / Services</h3>
                <div class="info-row">
                    <span class="label">Category:</span>
                    <span class="value">{{ $supplierData['product_category'] }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Description:</span><br>
                    <span class="value">{{ $supplierData['product_description'] }}</span>
                </div>
            </div>

            @if (!empty($supplierData['brochure']) || !empty($supplierData['certifications']))
                <div class="section">
                    <h3>Documentation</h3>
                    @if (!empty($supplierData['brochure']))
                        <div class="info-row">
                            <span class="label">Brochure:</span>
                            <span class="value">{{ $supplierData['brochure'] }}</span>
                        </div>
                    @endif
                    @if (!empty($supplierData['certifications']))
                        <div class="info-row">
                            <span class="label">Certifications:</span>
                            <span class="value">{{ $supplierData['certifications'] }}</span>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="footer">
            <p>This is an automated notification from Barani Hydraulics Supplier Registration System.</p>
            <p>Submitted on {{ date('F d, Y \a\t H:i:s') }}</p>
        </div>
    </div>
</body>

</html>
