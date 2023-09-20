@extends('admin.layout')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard

                </h1>
                <!--end::Title-->
            </div>

            <!--end::Actions-->
        </div>
        <!--end::Container-->
    </div>

    <div class="card card-wrapper container-xxl Totaldata" id="kt_content_container">
        <div class="row">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-xl-6 ">
                        <div class="card bg-light-warning justify-content-center align-items-center">
                            <h4 class="text-warning">Therapist</h4>

                            <span class="text-warning">{{$totalDoctor}}</span>
                        </div>
                    </div>
                    <div class="col-xl-6 ">
                        <div class="card bg-light-primary justify-content-center align-items-center">
                            <h4 class="text-primary ">Staff</h4>
                            <span class="text-primary">{{$totalStaff}}</span>
                        </div>
                    </div>
                    <div class="col-xl-6 ">
                        <div class="card bg-light-danger justify-content-center align-items-center">
                            <h4 class="text-danger">Group</h4>
                            <span class="text-danger">{{$totalGroup}}</span>

                        </div>
                    </div>
                    <div class="col-xl-6 ">
                        <div class="card bg-light-success justify-content-center align-items-center">
                            <h4 class="text-success">Patient</h4>
                            <span class="text-success">{{$totalPatient}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card card-wrapper container-xxl Totaldata" id="kt_content_container">
        <div class="row">
            <div class="col-xl-4">
                <canvas id="mypatientChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>


</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var monthlyDischarges = @json($total_discharges);
    var monthlyAdmited = @json($total_admited);

    var labels = [];
    var discharge = [];
    var admited = [];

    monthlyDischarges.forEach(function(item) {
        labels.push(item.year + '-' + item.month);
        discharge.push(item.total_discharges);
    });

    monthlyAdmited.forEach(function(item) {
        admited.push(item.total_admit);
    });


    var ctx2 = document.getElementById('mypatientChart').getContext('2d');
    var mypatientChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Monthly Discharges Patients',
                data: discharge,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }, {
                label: 'Monthly Admited Patients',
                data: admited,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection