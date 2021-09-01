
<div class="row">
    <div class="col-lg-6"> <h1 class="h3 mb-4 text-gray-800">List Order Montir</h1> </div>
    <!-- <div class="col-lg-6 text-right"> <a class="btn btn-primary" href="<?=site_url('jasamontir/ordermontir')?>">Booking Montir</a></div> -->
</div>

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
                        <td><?=datetime_indo($data->orderdate)?></td>
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
                            <td> -</td>
                            <td> -</td>
                            <td> -</td>
                            <td> -</td>
                        <?php } else if ($data->statusbayar == 1 ) { ?>
                            <td>Menunggu Konfirmasi</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td> 
                                <a href="<?=site_url('jasaservice/lihatbuktibayar/'.$data->orderid)?>" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-eye"></i> Lihat Bukti Bayar    
                                </a>
                            </td>
                        <?php } else if ($data->statusbayar == 2 )  { ?>
                            <td>Pembayaran Diterima</td>
                            <?php if ($data->status == 0 || $data->status == null) { ?>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>
                                <a href="<?=site_url('jasaservice/updatestatus/'.$data->orderid)?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a> 
                                <a href="<?=site_url('jasaservice/sendreminder/'.$data->orderid)?>" class="btn btn-primary btn-sm">
                                    Send Reminder
                                </a>
                            </td>
                            <?php } else if ($data->status == 1) { ?>
                                <td>Sedang Diproses</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <a href="<?=site_url('jasaservice/updatestatus/'.$data->orderid)?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            <?php } else if ($data->status == 2) { ?>
                                <td>Telah Selesai Diservice</td>
                                <td>Rp<?=number_format($data->sisapelunasan,2,',','.')?></td>
                                <td><?=$data->statuspelunasan == 2 ? 'Lunas' : '-'?></td>
                                <td> <?php if ($data->statuspelunasan != 2) { ?>
                                    <a class="btn btn-info" href="#" data-toggle="modal" data-target="#pelunasanModal<?=$data->orderid?>">Input Pelunasan</a>
                                    <?php } ?>
                                </td>
                            <?php } ?>
                            
                        <?php } else if ($data->statusbayar == 3) { ?>
                            <td> Pembayaran Ditolak karena <?=$data->notes ?? '-'?> .Silahkan Upload Ulang Bukti Pembayaran </td>
                            <td>- </td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        <?php }?>
                    </tr>
                <?php } ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php foreach ($result as $key => $data) { ?>
<div id="pelunasanModal<?=$data->orderid?>" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="content">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pelunasan</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?=site_url('jasaservice/inputpelunasan')?>" method="post">
                        <input type="hidden" name="id" value="<?=$data->orderid?>">
                        <div class="form-group row">
                            <div class="col-12 col-sm-3 offset-sm-1">
                                <label for="firstname" class="form-check-label"><strong>Sisa Pelunasan</strong></label>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="number" class="form-control" id="sisapelunasan" name="sisapelunasan" placeholder="">
                            </div>
                            <div class="col col-sm"></div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-12 offset-sm-4">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Cancel
                                 </button>
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>