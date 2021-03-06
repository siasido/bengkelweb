
<div class="row">
    <div class="col-lg-6"> <h1 class="h3 mb-4 text-gray-800">Laporan Order Montir</h1> </div>

    
    
</div>

    <form action="<?php echo site_url('jasaservice/searchreportservicebymonth')?>" method="post">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <!-- <label for="level">Role</label> -->
                <select class="form-control" id="month" name="month" required>
                    <option value="">- Pilih Bulan -</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <button name="submit" class="btn btn-submit btn-primary btn-user ">
                    Search
                </button>
            </div>                                
        </div>
    </div>
    </form>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <!-- <h6 class="m-0 font-weight-bold text-primary">Pesanan Saya</h6> -->
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
                        <th>Status Pembayaran</th>
                        <th>Status Pengerjaan</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($result as $key => $data) { ?>
                    <tr>
                        <?php $time = DateTime::createFromFormat('Y-m-d H:i:s', $data->orderdate); ?>
                        <?php $time->modify('+30 minutes'); ?>
                        <?php $now = new DateTime() ?>
                        <td><?=$data->nama?></td>
                        <td><?=$data->nohp?></td>
                        <td><?=datetime_indo($data->orderdate)?></td>
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