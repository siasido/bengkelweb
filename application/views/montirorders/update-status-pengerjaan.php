<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Update Booking Service</h1>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Booking Service</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form action="<?php echo site_url('jasamontir/submitupdatestatus')?>" method="post">
                        <input type="hidden" name="id" value="<?=$row->orderid?>"></input>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input class="form-control"value="<?=$row->nama?>" id="nama" type="text" readonly="true">
                                    <label class="invalid-text" for="nama"><?php echo form_error('nama'); ?></label>
                                </div>     
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nohp">No.HP</label>
                                    <input class="form-control" value="<?=$row->nohp?>" id="nohp" type="number" readonly="true">
                                    <label class="invalid-text" for="nohp"><?php echo form_error('nohp'); ?></label>
                                </div>     
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="orderdate">Booking Untuk Tanggal</label>
                                    <input name="orderdate" type="text" class="form-control" id="orderdate" value="<?=$row->orderdate?>" readonly="true">
                                </div>     
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="rekening">Rekening</label>
                                    <input name="rekening" type="text" class="form-control" id="rekening" value="<?=$row->namabank.'-'.$row->norek?>" readonly="true">
                                </div>     
                            </div>
                        </div>

                        <div class="row">
                            

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="merk">Merk</label>
                                    <input name="merk" type="text" class="form-control" id="merk" value="<?=$row->merk?>" readonly="true">
                                </div>     
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <input name="type" type="text" class="form-control" id="type" value="<?=$row->type?>" readonly="true">
                                </div>     
                            </div>

                        </div>
                        

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kendala">Kendala</label>
                                    <textarea class="form-control" id="kendala" name="kendala" rows="2" readonly="true"><?=$row->kendala ?></textarea>
                                    <label class="invalid-text" for="nohp"><?php echo form_error('kendala'); ?></label>
                                </div> 
                            </div>

                            
                            
                        </div>
                        <div class="row">
                            
                             <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="namamontir">Montir Yang Dikirim</label>
                                    <input class="form-control"value="<?=$row->namamontir?>" id="namamontir" type="text" readonly="true">
                                    <label class="invalid-text" for="namamontir"><?php echo form_error('namamontir'); ?></label>
                                </div>     
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="status">Status Pengerjaan:</label>
                                    <select class="form-control" id="stats" name="status" required>
                                        <option value="">- Pilih Status -</option>
                                        <?php $status = $this->input->post('status') ?? $row->status ?>
                                        <option value="2" <?php echo $status == "2" ? 'selected' : null ?>>Sedang Diproses</option>
                                        <option value="3" <?php echo $status == "3" ? 'selected' : null ?>>Sudah Selesai</option>
                                        
                                    </select>
                                    <label class="invalid-text" for="nohp"><?php echo form_error('status'); ?></label>
                                </div>     
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 offset-lg-6">
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