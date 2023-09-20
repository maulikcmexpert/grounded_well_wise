<!DOCTYPE html>
<html>

<head>
    <title>Clustered Column Chart Example</title>
    <!-- Include Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>


    </style>
</head>

<body>
    <form method="POST" action="{{route('patient.discharge_report_pdf')}}">
        @csrf
        <input type="hidden" name="patient_id" value="{{$patientID}}">
        <div class="card discarge-wrap">
            <div class="row">
                <div class="container mt-2">
                    <h2 class="mb-4">Discharge Report: {{$patientDetails->first_name.' '.$patientDetails->last_name}}</h2>
                    <table class="table table-bordered border-bottom">
                        <tbody>
                            <tr>
                                <th>Client</th>
                                <td>{{$patientDetails->first_name.' '.$patientDetails->last_name}}</td>
                                <th>Date of admission</th>
                                <td>{{ date("d F Y",strtotime($patientDetails->PatientApoms[0]->dateOfScreening))}}</td>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <td>{{$patientDetails->patientDetails->EZMed_number}} ({{$patientDetails->PatientApoms[0]->age}})</td>
                                <th>Date of Discharge & Report</th>
                                <td>{{date('d F Y')}}</td>
                            </tr>
                            <tr>
                                <th>Contact details:</th>
                                <td>{{$patientDetails->patientDetails->contact_number}}</td>
                                <th>Email</th>
                                <td>{{$patientDetails->patientDetails->email}}</td>
                            </tr>
                            <tr>
                                <th>Discharge destination</th>
                                <td><input class="col-md-1" name="dischargeDestination" type="text"></td>
                            </tr>

                            <tr>
                                <th>Next of kin</th>
                                <td colspan="3">{{$patientDetails->patientDetails->next_of_kin}}</td>
                            </tr>
                            <tr>
                                <th>Occupational Therapist</th>
                                <td>{{$patientDetails->PatientApoms[0]->therapistName}}</td>
                                <th>Treating Psychiatrist</th>
                                <td>{{$patientDetails->PatientApoms[0]->psychiatrist}}</td>
                            </tr>
                            <tr>
                                <th>Purpose of the report</th>
                                <td colspan="3">To summarize the changes in the client’s recovery and level of function. The information in the report aims to support continuation of care and provide relevant recommendations.</td>
                            </tr>
                            <tr>
                                <th>Intervention during admission</th>
                                <td colspan="3"> {{$patientDetails->first_name.' '.$patientDetails->last_name}} was placed in the {{$patientDetails->PatientApoms[0]->group->group_name}} after the initial screening and orientation. {{($patientDetails->PatientDetails->gender == 'male')?"He":"She"}} attended {{ $attendence }} individual sessions of therapy groups (out of a possible {{$groupTotalSessions}}).</td>
                            </tr>

                            <!-- Add more details and sections as needed -->
                        </tbody>
                    </table>

                    <div class="rasReport mt-5">
                        <h3>Progress:</h3>
                        <div class="row border">

                            <div class="col-md-6 pt-4">
                                <ul>
                                    <li>Recovery Assessment Scale (RAS)</li>
                                    <li>Assesses personal recovery across five domains.</li>
                                    <li>Recovery in mental health can be defined as ‘a way of living a satisfying, hopeful and contributing life even with limitations caused by illness’</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <canvas id="clusteredColumnChart" width="400" height="200"></canvas>
                                <input type="hidden" name="hidenRASChartImage" id="hidenRASChartImage">
                            </div>
                        </div>
                    </div>


                    <div class="rasReport mt-5">
                        <h3>Activity Participation Outcome Measure (APOM):</h3>
                        <div class="row border">
                            <div class="col-md-6">

                                <ul>
                                    <li>Completed by the OT during group activities.</li>
                                    <li>Assesses levels of functioning</li>
                                    <li>Aligned with the Vona du Toit Model of Creative Ability (VdTMoCA)</li>
                                    <li>The assessment of action enables an OT to measure the intensity of motivation.</li>
                                    The focus is on purposeful activity participation.
                                </ul>
                            </div>
                            <div class="col-md-6">

                                <canvas id="apomChart" width="400" height="200"></canvas>
                                <input type="hidden" name="hidenApomChartImage" id="hidenApomChartImage">

                            </div>
                        </div>
                    </div>

                    <div class="rasReport mt-5">
                        <h3>Summary & Recommendations</h3>
                        <div class="row ps-3">

                            {{$patientDetails->first_name.' '.$patientDetails->last_name}} has made <input class="col-md-4" type="text" name="gainstatus" placeholder="gains/ not made gains/ made marginal gains/ made significant gains"> in her sense of her own mental health recovery. <input type="text" name="improveStatus" placeholder="Improvement / the lack of improvement"> on the RAS is reflected in {{($patientDetails->patientDetails->gender == 'male')?"him":"her"}} experiencing changes in the mental health condition itself and in <input type="text" name="findStatus" placeholder="finding / not finding"> ways to build a life worth living despite being limited by {{($patientDetails->patientDetails->gender == 'male')?"his":"her"}} mental health condition. The overall improvement of <input type="text" name="percentageStatus" placeholder="%">% is considered <input type="text" name="considerStatus" placeholder="considered significant/not considered significant.">.

                            She has demonstrated improved levels of functioning in <input type="text" name="domainStatus" placeholder="all 8 domains / ___(number) of the 8 domains"> of the APOM. Her initial level of creative ability was <input type="text" name="lavelStatus" placeholder="self-presentation level"> and on discharge, it was at <input type="text" name="passiveStatus" placeholder="passive participation">. Based on the results, {{$patientDetails->first_name.' '.$patientDetails->last_name}} is <input type="text" name="dischargeStatus" placeholder="functionally safe to be discharged home">.

                            To continue recovery post-discharge, the following is recommended:
                            <ul>
                                </li>Follow up with the occupational therapy outpatient practice.</li>
                                </li>Attend follow-up appointments with her psychiatrist and psychologist.</li>
                            </ul>

                        </div>
                    </div>



                    ______________________<br>
                    <div class="rasReport">

                        <input type="text" name="therapist" placeholder="Therapist"><br>
                    </div>
                    Occupational Therapist<br>
                    B Occupational Therapy (UFS)<br>
                    Post Grad Dip Voc Rehab (UP)
                    </p>
                </div>
            </div>
        </div>
        <div class="ps-4"><button type="submit" class="btn btn-primary">Make Descharge Report</button>
            <input class="btn btn-primary" type="submit" name="viewreport" value="PDF View">
        </div>

    </form>







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
                        document.getElementById('hidenRASChartImage').setAttribute('value', radarChart.toBase64Image());
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
                        document.getElementById('hidenApomChartImage').setAttribute('value', radarApomChart.toBase64Image());
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