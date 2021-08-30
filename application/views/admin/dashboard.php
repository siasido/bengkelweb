<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>

    <div class="row">
        <div class="col-lg-2 col-xl-2 mb-2">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Customer</div>
                            <div class="text-lg fw-bold"><?=$totalCustomer?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-xl-2 mb-2">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Montir</div>
                            <div class="text-lg fw-bold"><?=$totalMontir?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-xl-2 mb-2">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Ongoing Order Montir</div>
                            <div class="text-lg fw-bold"><?=$totalOngoingOrder?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-xl-2 mb-2">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Ongoing Service</div>
                            <div class="text-lg fw-bold"><?=$totalOngoingService?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-xl-2 mb-2">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Finished Order Montir</div>
                            <div class="text-lg fw-bold"><?=$totalFinishedOrder?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-xl-2 mb-2">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Finished Service</div>
                            <div class="text-lg fw-bold"><?=$totalFinishedService?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>