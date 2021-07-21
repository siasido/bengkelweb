<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Booking Montir</h1>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Upload Resi</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form action="<?php echo site_url('jasaservice/submitresi')?>" method="post" enctype="multipart/form-data">
                    
                    <div class="col-lg-8">
                        <div class="form-group">
                        <input type="hidden" name="id" value="<?=$data->orderid?>">
                        <label>Upload bukti bayar Sebesar Rp50.000 ke Rekening <strong><?=$data->namabank.', nomor rekening : '.$data->norek.' atas nama '.$data->namaakun?> sebelum tanggal <?=$deadline->format('d/m/Y')?> pukul <?=$deadline->format('H:i')?> </strong></label>

                            <div class="input-group">
                                <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="image">
                                <label class="custom-file-label" for="image">Pilih Foto</label>
                                <!-- <label style="color:red" for="image"><?php echo $error ?></label> -->
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <button name="submit" type="submit" class="btn btn-submit btn-primary btn-user btn-block">
                                        Simpan
                                    </button>
                                </div>                                
                            </div>
                        </div>
                                
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>