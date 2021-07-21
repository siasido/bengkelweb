<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Motor</h1>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Merk Motor</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form action="<?php echo site_url('motor/simpan')?>" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="merk">Merk</label>
                                    <input class="form-control" name="merk" value="<?=$this->input->post('merk')?>" id="merk" type="text" placeholder="Yamaha, Honda etc..">
                                    <label class="invalid-text" for="merk"><?php echo form_error('merk'); ?></label>
                                </div>     
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="2"><?=$this->input->post('keterangan') ?></textarea>
                                    <label class="invalid-text" for="nohp"><?php echo form_error('keterangan'); ?></label>
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