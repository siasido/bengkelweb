<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Montir</h1>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Montir</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form action="<?php echo site_url('montir/simpan')?>" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="namamontir">Nama Montir</label>
                                    <input class="form-control" name="namamontir" value="<?=$this->input->post('namamontir')?>" id="namamontir" type="text" placeholder="John..">
                                    <label class="invalid-text" for="namamontir"><?php echo form_error('namamontir'); ?></label>
                                </div>     
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nohp">Nomor HP</label>
                                    <input class="form-control" name="nohp" value="<?=$this->input->post('nohp')?>" id="nohp" type="number" placeholder="081xxxx..">
                                    <label class="invalid-text" for="nohp"><?php echo form_error('nohp'); ?></label>
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