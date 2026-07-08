<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title>New Career Application</title>-->
<!--</head>-->
<!--<body>-->
<!--    <h2>New Career Application</h2>-->

<!--    <p>A new career application has been submitted with the following details:</p>-->

<!--    <ul>-->
<!--        <li><strong>Full Name:</strong> {{ $data->full_name }}</li>-->
<!--        <li><strong>Email:</strong> {{ $data->email }}</li>-->
<!--        <li><strong>Phone:</strong> {{ $data->phone }}</li>-->
<!--        <li><strong>Location:</strong> {{ $data->location }}</li>-->
<!--        <li><strong>Position Applied For:</strong> {{ $data->position }}</li>-->
<!--        <li><strong>Experience:</strong> {{ $data->experience_years }} years</li>-->
<!--        <li><strong>Expected Salary:</strong> {{ $data->expected_salary }}</li>-->
<!--        <li><strong>Available From:</strong> {{ $data->available_from }}</li>-->
<!--        <li><strong>Qualification:</strong> {{ $data->qualification }}</li>-->
<!--        <li><strong>Specialization:</strong> {{ $data->specialization }}</li>-->
<!--    </ul>-->

<!--    <p>The applicant’s CV is attached to this email.</p>-->

<!--    <p>— HR System</p>-->
<!--</body>-->
<!--</html>-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Career Application</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f8; font-family:Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8; padding:30px 0;">
    <tr>
        <td align="center">

            <!-- Container -->
            <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border:1px solid #d1d5db;">
                
                <!-- Header -->
                <tr>
                    <td style="background-color:#1f2933; padding:20px;">
                        <h2 style="margin:0; color:#ffffff; font-size:20px; letter-spacing:1px;">
                            CAREER APPLICATION – Barani Group
                        </h2>
                        <!--<p style="margin:5px 0 0; color:#cbd5e1; font-size:13px;">-->
                        <!--    Pressed Components & Machinery Parts-->
                        <!--</p>-->
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td style="padding:25px; color:#111827;">
                        <p style="font-size:14px; margin:0 0 15px;">
                            A new career application has been submitted. Candidate details are listed below:
                        </p>

                        <!-- Details Table -->
                        <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse; font-size:13px;">
                            <tr style="background-color:#f1f5f9;">
                                <td width="40%" style="border:1px solid #d1d5db;"><strong>Full Name</strong></td>
                                <td style="border:1px solid #d1d5db;">{{ $data->full_name }}</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #d1d5db;"><strong>Email</strong></td>
                                <td style="border:1px solid #d1d5db;">{{ $data->email }}</td>
                            </tr>
                            <tr style="background-color:#f1f5f9;">
                                <td style="border:1px solid #d1d5db;"><strong>Phone</strong></td>
                                <td style="border:1px solid #d1d5db;">{{ $data->phone }}</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #d1d5db;"><strong>Location</strong></td>
                                <td style="border:1px solid #d1d5db;">{{ $data->location }}</td>
                            </tr>
                            <tr style="background-color:#f1f5f9;">
                                <td style="border:1px solid #d1d5db;"><strong>Position Applied</strong></td>
                                <td style="border:1px solid #d1d5db;">{{ $data->position }}</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #d1d5db;"><strong>Experience</strong></td>
                                <td style="border:1px solid #d1d5db;">{{ $data->experience_years }} years</td>
                            </tr>
                            <tr style="background-color:#f1f5f9;">
                                <td style="border:1px solid #d1d5db;"><strong>Expected Salary</strong></td>
                                <td style="border:1px solid #d1d5db;">{{ $data->expected_salary }}</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #d1d5db;"><strong>Available From</strong></td>
                                <td style="border:1px solid #d1d5db;">{{ \Carbon\Carbon::parse($data->available_from)->format('d M Y') }}</td>
                            </tr>
                            <tr style="background-color:#f1f5f9;">
                                <td style="border:1px solid #d1d5db;"><strong>Qualification</strong></td>
                                <td style="border:1px solid #d1d5db;">{{ $data->qualification }}</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #d1d5db;"><strong>Specialization</strong></td>
                                <td style="border:1px solid #d1d5db;">{{ $data->specialization }}</td>
                            </tr>
                        </table>

                        <p style="margin:20px 0 0; font-size:13px;">
                            📎 <strong>Note:</strong> Candidate CV is attached to this email.
                        </p>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="background-color:#f1f5f9; padding:15px; text-align:center;">
                        <p style="margin:0; font-size:12px; color:#4b5563;">
                            This email was generated automatically by the HR recruitment system.
                        </p>
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>
