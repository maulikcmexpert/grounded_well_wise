<!DOCTYPE html>
<html>

<head>
    <title>Clustered Column Chart Example</title>
    <!-- Include Bootstrap CSS for styling -->


    <style>


    </style>
</head>

<body>
    <section class="apom-report">
        <div class="container">
            <form method="POST" action="{{ route('patient.apom_assessment_pdf_genarate')}}">
                @csrf
                <div class="card">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title mb-5">
                                <h3 class="text-center">Activity Participation Outcome Measure (APOM): Baseline Assessment</h3>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="d-flex align-items-center">
                                <p>Person No.</p>
                                <h4>{{$patientDetails->patientDetails->EZMed_number}}</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="d-flex align-items-center">
                                <p>Gender</p>
                                <h4>{{$patientDetails->patientDetails->gender}}</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="d-flex align-items-center">
                                <p>Name</p>
                                <h4>{{$patientDetails->first_name.' '.$patientDetails->last_name}}</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="d-flex align-items-center">
                                <p>OT</p>
                                <h4>{{$patientDetails->PatientApoms[1]->therapistName}}</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="d-flex align-items-center">
                                <p>Date of Admission</p>
                                <h4>{{date('d-m-Y',strtotime($patientDetails->PatientApoms[0]->dateOfScreening))}}</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="d-flex align-items-center">
                                <p>Date of Discharge</p>
                                <h4>{{date('d-m-Y',strtotime($patientDetails->PatientApoms[1]->dateOfScreening))}}</h4>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Date of assessment</th>
                                        <th></th>
                                        @foreach($partOfApom as $value)
                                        <th class="title-rotate">{{$value}}</th>
                                        @endforeach
                                        <th class="title-rotate">Average Level</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>{{date('d-m-Y',strtotime($patientDetails->PatientApoms[0]->dateOfScreening))}}</td>
                                        <td>Baseline</td>
                                        @php
                                        $initialApomAvg = 0;
                                        @endphp
                                        @foreach($initialApom as $value)
                                        <td>{{ $value}}</td>
                                        @php
                                        $initialApomAvg += $value;
                                        @endphp

                                        @endforeach
                                        @php
                                        $baselineAvg = $initialApomAvg;
                                        @endphp
                                        <td>{{ $baselineAvg/count($initialApom)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{date('d-m-Y',strtotime($patientDetails->PatientApoms[1]->dateOfScreening))}}</td>
                                        <td>Final</td>
                                        @php
                                        $finalApomAvg = 0;
                                        @endphp
                                        @foreach($finalApom as $value)
                                        <td>{{ $value}}</td>
                                        @php
                                        $finalApomAvg += $value;
                                        @endphp

                                        @endforeach
                                        @php
                                        $finalAvg = $finalApomAvg;
                                        @endphp
                                        <td>{{ $finalAvg/count($finalApom)}}</td>
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
                            <div class="mt-5">



                                <canvas id="apomChart" width="400" height="200"></canvas>
                                <input type="hidden" name="hidenApomChartImage" id="hidenApomChartImage">
                                <input type="hidden" name="patientID" value="{{ $patientID }}">

                            </div>

                        </div>

                    </div>
                </div>
                <div>

                    <button type="submit" class="btn btn-primary">Genarate PDF</button>
                </div>
            </form>
        </div>



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