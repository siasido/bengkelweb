
<div class="row">
    <div class="col-lg-6"> <h1 class="h3 mb-4 text-gray-800">List Order Montir</h1> </div>
    <div class="col-lg-6 text-right"> <a class="btn btn-primary" href="<?=site_url('jasamontir/ordermontir')?>">Booking Montir</a></div>
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
                        <th>Alamat</th>
                        <th>Booking Untuk Tanggal</th>
                        <th>Merk Motor</th>
                        <th>Kendala</th>
                        <th>Status</th>
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
                        <td><?=$data->alamatlengkap?></td>
                        <td><?=$data->orderdate?></td>
                        <td><?=$data->merk.' '.$data->type?></td>
                        <td><?=$data->kendala?></td>
                        <td><?=$data->status == 'kirim montir' ? 'Montir '.$data->namamontir.' sudah dikirim' : $data->status?></td>
                        <td class="text-center">

                            
                            <?php if ( ($now > $time) && $data->status == 'menunggu pembayaran') { ?>
                                Invalid
                                
                            <?php } else if ( ($now <= $time) && $data->status == 'menunggu pembayaran') {?>
                                -
                            <?php } else if (($now <= $time) && $data->status == 'menunggu konfirmasi pembayaran') { ?>
                                <a href="<?=site_url('jasamontir/lihatbuktibayar/'.$data->orderid)?>" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-eye"></i> Lihat Bukti Bayar    
                                </a>
                            <?php } else if ($data->status == 'pembayaran diterima'){ ?>
                                <a href="<?=site_url('jasamontir/sendmontir/'.$data->orderid)?>" class="btn btn-primary btn-sm">
                                    kirim montir
                                </a>
                            <?php } ?>
                           
                        </td>
                    </tr>
                <?php } ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>