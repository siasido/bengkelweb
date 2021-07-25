
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="<?=base_url()?>assets/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=base_url()?>assets/template/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?=base_url()?>assets/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

 
  <div class="card shadow mb-4" style="margin-top:4em">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-6">
                <h6 class="m-0 font-weight-bold text-primary">Jadwal Service</h6>
            </div>
            <div class="col-6 text-right">
                
                    <a class="btn btn-secondary" href="<?=site_url('landingpage')?>">Kembali</a>
                    <a class="btn btn-primary" href="<?=site_url('auth')?>">Order</a>
               
            </div>
        </div>
        
    </div>
    <div class="card-body">
        
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Booking Untuk Tanggal</th>
                        <th>Merk Motor</th>
                        <th>Kendala</th>
                        <th>Status Pembayaran</th>
                        <th>Status Pengerjaan</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($result as $key => $data) { ?>
                        <?php $time = DateTime::createFromFormat('Y-m-d H:i:s', $data->orderdate); ?>
                        <?php $time->modify('+30 minutes'); ?>
                        <?php $now = new DateTime() ?>
                        <?php $orderdate = DateTime::createFromFormat('Y-m-d H:i:s', $data->orderdate); ?>
                    <tr>
                        <td><?=$data->nama?></td>
                        <td><?=$orderdate->format('d/m/Y H:i')?></td>
                        <td><?=$data->merk.' '.$data->type?></td>
                        <td><?=$data->kendala?></td>
                        <?php if (($now > $time && $data->statusbayar == 0 ) || ($now > $time && $data->statusbayar == 2)) { ?>
                            <td> Pesanan Invalid </td>
                            <td> - </td>
                        <?php } else if ($data->statusbayar == 0 ) { ?>
                            <td> Menunggu Pembayaran </td>
                            <td><?=$data->status?></td>
                        <?php } else if ($data->statusbayar == 1 ) { ?>
                            <td> Menunggu Konfirmasi Pembayaran oleh Admin</td>
                            <td><?=$data->status?></td>
                        <?php } else if ($data->statusbayar == 2 )  { ?>
                            <td>Pembayaran Diterima</td>
                            <?php if ($data->status == 0 || $data->status == null) { ?>
                            <td></td>
                            <?php } else if ($data->status == 1) { ?>
                                <td>Sedang Diproses</td>
                            <?php } else if ($data->status == 2) { ?>
                                <td>Telah Selesai Diservice</td>
                            <?php } ?>
                            
                        <?php } else if ($data->statusbayar == 3) { ?>
                            <td> Pembayaran Ditolak karena <?=$data->notes ?? '-'?> .Silahkan Upload Ulang Bukti Pembayaran </td>
                            <td> <?=$data->status?></td>
                        <?php }?>
                    </tr>
                <?php } ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

  </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url()?>assets/template/vendor/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=base_url()?>assets/template/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=base_url()?>assets/template/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?=base_url()?>assets/template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>assets/template/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?=base_url()?>assets/template/js/demo/datatables-demo.js"></script>

</body>

</html>