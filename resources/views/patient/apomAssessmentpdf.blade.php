<!DOCTYPE html>
<html>

<head>
    <title>Clustered Column Chart Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Include Bootstrap CSS for styling -->


    <style>
        .apom-report .card {
            padding: 30px;
            box-shadow:rgba(100, 100, 111, 0.2) 0px 7px 29px 0px !important;
        }

        .apom-report p {
            border: 1px solid #774692;
            display: flex;
            align-items: center;
            flex-basis: 65%;
            font-size: 14px;
            height: 45px;
            padding-left: 20px;
            border-radius: 5px;
            margin-bottom: 0px !important;
        }

        .apom-report h3 {
            font-size: 25px;
            margin-bottom: 15px !important;
        }

        .apom-report h4 {
            font-size: 16px;
            margin-left: 10px;
        }

        .apom-report table {
            margin-top: 30px;
        }

        .apom-report th,
        tr,
        td {
            border: 1px solid #ccc;
            padding: 15px;
            text-align: center;
            max-width: 50px;
            min-width: 50px;
        }

        .apom-report th {
            height: 0px !important;
        }

        .title-rotate {
            transform: rotate(90deg);
            height: 0px !important;
        }
        .apom-assessment-pdf-wrp{
            width: 100%;
            max-width: 600px;
            margin: 0px auto;
            height: 500px;
        }
        .apom-assessment-pdf-wrp .apomChartimg{
            width: 100%;
            max-width: 600px;
            margin: 0px auto;
            height: 450px;
        }
        .apom-assessment-pdf-wrp .apomChartimg img{
            width: 100%;
            height: 100%;
        }
        .apom-assessment-pdf-wrp #apomChart{
            width: 100% !important;
            height: 100% !important;
        }
    </style>
</head>

<body>
    <section class="apom-report">
        <!-- <div class="container"> -->
            <div class="card">
                <!-- <div class="row"> -->
                    <div class="col-lg-12">
                        <div class="title">
                            <h3 class="text-center" style="font-size: 18px;margin-bottom: 15px;">Activity Participation Outcome Measure (APOM): Baseline Assessment</h3>
                        </div>
                    </div>
                  
                    <table class="table table-bordered border-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <th style="border: 1px solid #dee2e6;padding: 4px 4px 4px 10px;font-size: 14px;color:#212529 !important;font-weight:600;width: 100%;text-align:left;">Person No.</th>
                                <td style="border: 1px solid #dee2e6;padding: 4px 4px 4px 10px;font-size: 14px;color:#212529 !important;font-weight:400;width: 100%;text-align:left;">{{$patientDetails->patientDetails->EZMed_number}}</td>
                                <th style="border: 1px solid #dee2e6;padding: 4px 4px 4px 10px;font-size: 14px;color:#212529 !important;font-weight:600;width: 100%;text-align:left;">Gender</th>
                                <td style="border: 1px solid #dee2e6;padding: 4px 4px 4px 10px;font-size: 14px;color:#212529 !important;font-weight:400;width: 100%;text-align:left;">{{$patientDetails->patientDetails->gender}}</td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #dee2e6;padding: 4px 4px 4px 10px;font-size: 14px;color:#212529 !important;font-weight:600;width: 100%;text-align:left;">Name</th>
                                <td style="border: 1px solid #dee2e6;padding: 4px 4px 4px 10px;font-size: 14px;color:#212529 !important;font-weight:400;width: 100%;text-align:left;">{{$patientDetails->first_name.' '.$patientDetails->last_name}}</td>
                                <th style="border: 1px solid #dee2e6;padding: 4px 4px 4px 10px;font-size: 14px;color:#212529 !important;font-weight:600;width: 100%;text-align:left;">OT</th>
                                <td style="border: 1px solid #dee2e6;padding: 4px 4px 4px 10px;font-size: 14px;color:#212529 !important;font-weight:400;width: 100%;text-align:left;">{{$patientDetails->PatientApoms[1]->therapistName}}</td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #dee2e6;padding: 4px 4px 4px 10px;font-size: 14px;color:#212529 !important;font-weight:600;width: 100%;text-align:left;">Date of Admission</th>
                                <td style="border: 1px solid #dee2e6;padding: 4px 4px 4px 10px;font-size: 14px;color:#212529 !important;font-weight:400;width: 100%;text-align:left;">{{date('d-m-Y',strtotime($patientDetails->PatientApoms[0]->dateOfScreening))}}</td>
                                <th style="border: 1px solid #dee2e6;padding: 4px 4px 4px 10px;font-size: 14px;color:#212529 !important;font-weight:600;width: 100%;text-align:left;">Date of Discharge</th>
                                <td style="border: 1px solid #dee2e6;padding: 4px 4px 4px 10px;font-size: 14px;color:#212529 !important;font-weight:400;width: 100%;text-align:left;">{{date('d-m-Y',strtotime($patientDetails->PatientApoms[1]->dateOfScreening))}}</td>
                            </tr>
                            <!-- Add more details and sections as needed -->
                        </tbody>
                    </table>

                    <div class="col-lg-12">
                        <table style="width: 300px;border-collapse: collapse; ">
                            <thead>
                                <tr>
                                    <th style="padding: 3px;height: 50px;max-width: 50px; font-size: 12px">Date of assessment</th>
                                    <th style="padding: 3px;height: 50px;max-width: 50px; font-size: 12px"></th>
                                    @foreach($partOfApom as $value)
                                    <th style="padding: 3px;height: 50px;max-width: 50px; font-size: 12px">{{$value}}</th>
                                    @endforeach
                                    <th style="padding: 3px;height: 50px;max-width: 50px; font-size: 12px">Average Level</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding: 3px;height: 50px; font-size: 12px">{{date('d-m-Y',strtotime($patientDetails->PatientApoms[0]->dateOfScreening))}}</td>
                                    <td style="padding: 3px;height: 50px; font-size: 12px">Baseline</td>
                                    @php
                                    $initialApomAvg = 0;
                                    @endphp
                                    @foreach($initialApom as $value)
                                    <td style="padding: 3px;height: 50px; font-size: 12px">{{ $value}}</td>
                                    @php
                                    $initialApomAvg += $value;
                                    @endphp

                                    @endforeach
                                    @php
                                    $baselineAvg = $initialApomAvg;
                                    @endphp
                                    <td style="padding: 3px;height: 50px; font-size: 12px">{{ $baselineAvg/count($initialApom)}}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 3px;height: 50px; font-size: 12px">{{date('d-m-Y',strtotime($patientDetails->PatientApoms[1]->dateOfScreening))}}</td>
                                    <td style="padding: 3px;height: 50px; font-size: 12px">Final</td>
                                    @php
                                    $finalApomAvg = 0;
                                    @endphp
                                    @foreach($finalApom as $value)
                                    <td style="padding: 3px;height: 50px; font-size: 12px">{{ $value}}</td>
                                    @php
                                    $finalApomAvg += $value;
                                    @endphp

                                    @endforeach
                                    @php
                                    $finalAvg = $finalApomAvg;
                                    @endphp
                                    <td style="padding: 3px;height: 50px; font-size: 12px">{{ $finalAvg/count($finalApom)}}</td>
                                </tr>
                                <!-- <tr>
                                <td></td>
                                <td>Goal</td>
                                <td>14</td>
                                <td>16</td>
                                <td>14</td>
                                <td>14</td>
                                <td>14</td>
                                <td>14</td>
                                <td>14</td>
                                <td>14</td>
                                <td></td>
                            </tr> -->
                            </tbody>
                        </table>
                        <div class="mt-5 pb-3 apom-assessment-pdf-wrp">
                            <canvas id="apomChart"></canvas>
                            <input type="hidden" name="hidenApomChartImage" id="hidenApomChartImage">
                            <div class="apomChartimg mt-4">
                                <img src="{{$apomChartDetail->hidenApomChartImage}}">
                            </div>

                        </div>
                    </div>

                <!-- </div> -->
            </div>

        <!-- </div> -->

    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    </script>
    
</body>
</html>