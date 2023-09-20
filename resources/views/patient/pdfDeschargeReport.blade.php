<!DOCTYPE html>
<html>

<head>
    <title>Clustered Column Chart Example</title>
    <!-- Include Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .rasReport .col-md-3 {
            border-right: 1px solid;
        }

        .discarge-wrap {
            padding: 20px;
            margin-left: 15px;
            margin-right: 15px;
        }

        .discarge-wrap .rasReport .col-md-6 img {
            padding: 10px;
            height: 380px !important;
            width: 450px;
        }
    </style>

</head>

<body>
    <div class="card discarge-wrap">
        <div class="row">
            <div class="container mt-2">
                <h2 class="mb-4" style="font-size: 16px;">Discharge Report: {{$patientDetails->first_name.' '.$patientDetails->last_name}}</h2>
                <table class="table table-bordered border-bottom">
                    <tbody>
                        <tr>
                            <th style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">Client</th>
                            <td style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">{{$patientDetails->first_name.' '.$patientDetails->last_name}}</td>
                            <th style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">Date of admission</th>
                            <td style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">{{ date("d F Y",strtotime($patientDetails->PatientApoms[0]->dateOfScreening))}}</td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">ID</th>
                            <td style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">{{$patientDetails->patientDetails->EZMed_number}} ({{$patientDetails->PatientApoms[0]->age}})</td>
                            <th style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">Date of Discharge & Report</th>
                            <td style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">{{date('d F Y')}}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">Contact details:</td>
                            <td style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">{{$patientDetails->patientDetails->contact_number}}</td>
                            <td style="border: 1px solid #dee2e6 !important;border-bottom: 1px solid #dee2e6 !important; padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">Email</td>
                            <td style="border: 1px solid #dee2e6 !important;border-bottom: 1px solid #dee2e6 !important; padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">{{$patientDetails->patientDetails->email}}</td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">Discharge destination</th>
                            <td colspan="3" style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">{{$deschargeDetail->dischargeDestination}}</td>
                        </tr>

                        <tr>
                            <th style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">Next of kin</th>
                            <td style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;" colspan="3">{{$patientDetails->patientDetails->next_of_kin}}</td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">Occupational Therapist</th>
                            <td style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">{{$patientDetails->PatientApoms[0]->therapistName}}</td>
                            <th style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">Treating Psychiatrist</th>
                            <td style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">{{$patientDetails->PatientApoms[0]->psychiatrist}}</td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">Purpose of the report</th>
                            <td style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;" colspan="3">To summarize the changes in the client’s recovery and level of function. The information in the report aims to support continuation of care and provide relevant recommendations.</td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;">Intervention during admission</th>
                            <td style="border: 1px solid #dee2e6;padding: 4px 4px 4px 4px;font-size: 14px;color:#212529 !important;font-weight:400;" colspan="3"> {{$patientDetails->first_name.' '.$patientDetails->last_name}} was placed in the {{$patientDetails->PatientApoms[0]->group->group_name}} after the initial screening and orientation. {{($patientDetails->PatientDetails->gender == 'male')?"He":"She"}} attended {{ $attendence }} individual sessions of therapy groups (out of a possible {{$groupTotalSessions}}).</td>
                        </tr>

                        <!-- Add more details and sections as needed -->
                    </tbody>
                </table>

                <div class="rasReport mt-5">
                    <h3 class="mb-3" style="font-size: 16px;">Progress:</h3>
                    <div class="row border">
                        <div class="col-md-6" style="150px;border: 1px solid #ccc;">
                            <ul class="pt-3">
                                <li style="font-size: 14px;color:#212529 !important;font-weight:400;">Recovery Assessment Scale (RAS)</li>
                                <li style="font-size: 14px;color:#212529 !important;font-weight:400;">Assesses personal recovery across five dom ains.</li>
                                <li style="font-size: 14px;color:#212529 !important;font-weight:400;">Recovery in mental health can be defined as ‘a way of living a satisfying, hopeful and contributing life even with limitations caused by illness’</li>
                            </ul>
                        </div>
                        <div class="col-md-6 pt-3" style="border: 1px solid #ccc;">
                            <!-- <canvas id="clusteredColumnChart" width="400" height="200"></canvas> -->
                            <!-- <img src="" id="hidenRASChartImage" class="img-fluid" alt="Responsive image"> -->
                            <img src="{{$deschargeDetail->hidenRASChartImage}}">
                        </div>
                    </div>
                </div>


                <div class="rasReport mt-5">
                    <h3 class="mb-3" style="font-size: 16px;">Activity Participation Outcome Measure (APOM):</h3>
                    <div class="row border">
                        <div class="col-md-6" style="border: 1px solid #ccc;">
                            <ul class="pt-3">
                                <li style="font-size: 14px;color:#212529 !important;font-weight:400;">Completed by the OT during group activities.</li>
                                <li style="font-size: 14px;color:#212529 !important;font-weight:400;">Assesses levels of functioning</li>
                                <li style="font-size: 14px;color:#212529 !important;font-weight:400;">Aligned with the Vona du Toit Model of Creative Ability (VdTMoCA)</li>
                                <li style="font-size: 14px;color:#212529 !important;font-weight:400;">The assessment of action enables an OT to measure the intensity of motivation.</li>
                                The focus is on purposeful activity participation.
                            </ul>
                        </div>
                        <div class="col-md-6" style="250px;border: 1px solid #ccc;">
                            <!-- <canvas id="apomChart" width="400" height="200"></canvas> -->
                            <!-- <img src="" id="hidenApomChartImage" class="img-fluid" alt="Responsive image"> -->
                            <img src="{{$deschargeDetail->hidenApomChartImage}}">
                        </div>
                    </div>
                </div>

                <div class="rasReport mt-4">
                    <h3 style="font-size: 16px;">Summary & Recommendations</h3>
                    <div class="row border" style="font-size: 14px;color:#212529 !important;">

                        {{$patientDetails->first_name.' '.$patientDetails->last_name}} has made {{$deschargeDetail->gainstatus}} in her sense of her own mental health recovery. {{$deschargeDetail->improveStatus}} on the RAS is reflected in {{($patientDetails->patientDetails->gender == 'male')?"him":"her"}} experiencing changes in the mental health condition itself and in {{$deschargeDetail->findStatus}} ways to build a life worth living despite being limited by {{($patientDetails->patientDetails->gender == 'male')?"his":"her"}} mental health condition. The overall improvement of {{$deschargeDetail->percentageStatus}} % is considered {{$deschargeDetail->considerStatus}}.

                        She has demonstrated improved levels of functioning in {{$deschargeDetail->domainStatus}} of the APOM. Her initial level of creative ability was {{$deschargeDetail->lavelStatus}} and on discharge, it was at {{$deschargeDetail->passiveStatus}}. Based on the results, {{$patientDetails->first_name.' '.$patientDetails->last_name}} is {{$deschargeDetail->dischargeStatus}}.

                        To continue recovery post-discharge, the following is recommended:
                        <ul>
                            </li>Follow up with the occupational therapy outpatient practice.</li>
                            </li>Attend follow-up appointments with her psychiatrist and psychologist.</li>
                        </ul>

                    </div>
                </div>



                ______________________<br>
                <b>{{$deschargeDetail->therapist}}</b><br>
                Occupational Therapist<br>
                B Occupational Therapy (UFS)<br>
                Post Grad Dip Voc Rehab (UP)
                </p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Sample data for initial and final reports for 5 categories
        const categories = @json($subscaleName);
        const initialData = @json($initialReport);
        const finalData = @json($finalReport);


        var options = {
            type: 'radar',
            data: {
                labels: categories,
                datasets: [{
                        label: 'Baseline',
                        data: initialData,
                        fill: true,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgb(255, 99, 132)',
                        pointBackgroundColor: 'rgb(255, 99, 132)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(255, 99, 132)'
                    },
                    {
                        label: 'Final',
                        data: finalData,
                        fill: true,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgb(54, 162, 235)',
                        pointBackgroundColor: 'rgb(54, 162, 235)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(54, 162, 235)'
                    }
                ]
            },
            options: {
                responsive: true,

                animation: {
                    onComplete: function() {
                        document.getElementById('hidenRASChartImage').setAttribute('src', radarChart.toBase64Image());
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        }


        var ctx = document.getElementById('clusteredColumnChart').getContext('2d');
        var radarChart = new Chart(ctx, options);


        // Create the chart
        // const
        // new Chart(ctx, {


        // });
    </script>


    <script>
        const Apomcategories = @json($partOfApom);
        const ApominitialData = @json($initialApom);
        const ApomfinalData = @json($finalApom);

        // Create the chart

        var option1 = {
            type: 'radar',
            data: {
                labels: Apomcategories,
                datasets: [{
                        label: 'Baseline',
                        data: ApominitialData,
                        fill: true,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgb(255, 99, 132)',
                        pointBackgroundColor: 'rgb(255, 99, 132)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(255, 99, 132)'
                    },
                    {
                        label: 'Final',
                        data: ApomfinalData,
                        fill: true,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgb(54, 162, 235)',
                        pointBackgroundColor: 'rgb(54, 162, 235)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(54, 162, 235)'
                    }
                ]
            },
            options: {
                responsive: true,
                animation: {
                    onComplete: function() {
                        document.getElementById('hidenApomChartImage').setAttribute('src', radarApomChart.toBase64Image());
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            },
        }


        var apomctx = document.getElementById('apomChart').getContext('2d');
        var radarApomChart = new Chart(apomctx, option1);

        // new Chart(apomctx, {


        // });
    </script>
</body>

</html>