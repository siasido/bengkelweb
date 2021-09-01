<?php if ($this->session->flashdata('notif_success')) { ?>
    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
        <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Success - </strong><?= $this->session->flashdata('notif_success') ?>
    </div>
<?php } ?>

<?php if ($this->session->flashdata('notif_failed')) { ?>
    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
        <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Error - </strong> <?= $this->session->flashdata('notif_failed') ?>
    </div>
<?php } ?>


<div class="row">
    <div class="col-lg-6"> <h1 class="h3 mb-4 text-gray-800">List Booking Service</h1> </div>
    <div class="col-lg-6 text-right"> <a class="btn btn-primary" href="<?=site_url('jasaservice/bookingservice')?>">Booking Service</a></div>
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pesanan Saya</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>No.HP</th>
                        <th>Booking Untuk Tanggal</th>
                        <th>Merk Motor</th>
                        <th>Kendala</th>
                        <th>Status Bayar</th>
                        <th>Status Pengerjaan</th>
                        <th>Sisa Pelunasan</th>
                        <th>Status Pelunasan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($result as $key => $data) { ?>
                        <?php $time = DateTime::createFromFormat('Y-m-d H:i:s', $data->orderdate); ?>
                        <?php $time->modify('+30 minutes'); ?>
                        <?php $now = new DateTime() ?>
                    <tr>
                        <td><?=$data->nama?></td>
                        <td><?=$data->nohp?></td>
                        <td><?=$data->orderdate?></td>
                        <td><?=$data->merk.' '.$data->type?></td>
                        <td><?=$data->kendala?></td>
                        <?php if ($data->status == 99) { ?>
                            <td> Pesanan Dibatalkan </td>
                            <td> - </td>
                            <td> -</td>
                            <td> -</td>
                            <td> - </td>
                        <?php } else if (($now > $time && $data->statusbayar == 0 ) || ($now > $time && $data->statusbayar == 2)) { ?>
                            <td> Pesanan Invalid </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                        <?php } else if ($data->statusbayar == 0 ) { ?>
                            <td> Menunggu Pembayaran </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td>
                                <a href="<?=site_url('jasaservice/edit/'.$data->orderid)?>" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <a href="<?=site_url('jasaservice/getformbayar/'.$data->orderid)?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-upload"></i>
                                </a>
                                <a href="<?=site_url('jasaservice/cancel/'.$data->orderid)?>" class="btn btn-danger btn-sm">
                                    Cancel
                                </a>
                            </td>
                        <?php } else if ($data->statusbayar == 1 ) { ?>
                            <td> Menunggu Konfirmasi Pembayaran oleh Admin</td>
                            <td> -</td>
                            <td> -</td>
                            <td> -</td>
                            <td>
                                <a href="<?=site_url('jasaservice/edit/'.$data->orderid)?>" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <a href="<?=site_url('jasaservice/getformbayar/'.$data->orderid)?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-upload"></i>
                                </a>
                                <a href="<?=site_url('jasaservice/cancel/'.$data->orderid)?>" class="btn btn-danger btn-sm">
                                    Cancel
                                </a>
                            </td>
                        <?php } else if ($data->statusbayar == 2 )  { ?>
                            <td>Pembayaran Diterima</td>
                            <?php if ($data->status == 0 || $data->status == null) { ?>
                            <td>Masih dalam antrian</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <?php } else if ($data->status == 1) { ?>
                            <td>Sedang Diproses </td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <?php } else if ($data->status == 2) { ?>
                                <td>Telah Selesai Diservice </td>
                                <td>Rp<?=number_format($data->sisapelunasan,2,',','.')?></td>
                                <td><?=$data->statuspelunasan == 2 ? 'Lunas' : '-'?></td>
                                <td>-
                                <!--  -->
                                </td>
                                
                            <?php } ?>
                        <?php } else if ($data->statusbayar == 3) { ?>
                            <td> Pembayaran Ditolak karena <?=$data->notes ?? '-'?> .Silahkan Upload Ulang Bukti Pembayaran </td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>
                                <a href="<?=site_url('jasaservice/edit/'.$data->orderid)?>" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <a href="<?=site_url('jasaservice/cancel/'.$data->orderid)?>" class="btn btn-danger btn-sm">
                                    Cancel
                                </a>
                                <a href="<?=site_url('jasaservice/getformbayar/'.$data->orderid)?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-upload"></i>
                                </a>
                                
                            </td>
                        <?php }?>
                    </tr>
                <?php } ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

