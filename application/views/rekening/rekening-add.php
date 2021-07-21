<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Rekening</h1>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Rekening</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form action="<?php echo site_url('rekening/simpan')?>" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="namabank">Nama Bank</label>
                                    <input class="form-control" name="namabank" value="<?=$this->input->post('namabank')?>" id="namabank" type="text" placeholder="BNI, MANDIRI, etc..">
                                    <label class="invalid-text" for="namabank"><?php echo form_error('namabank'); ?></label>
                                </div>     
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="norek">Nomor Rekening</label>
                                    <input class="form-control" name="norek" value="<?=$this->input->post('norek')?>" id="norek" type="text" placeholder="0362xxxx..">
                                    <label class="invalid-text" for="norek"><?php echo form_error('norek'); ?></label>
                                </div>     
                            </div>
                            
                            
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="namaakun">Nama Pemilik Akun</label>
                                    <input class="form-control" name="namaakun" value="<?=$this->input->post('namaakun')?>" id="namaakun" type="text" placeholder="John Doe..">
                                    <label class="invalid-text" for="namaakun"><?php echo form_error('namaakun'); ?></label>
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