<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Booking Montir</h1>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Acc Resi Pembayaran</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div>
                <div class="card-body">
                    <form action="<?php echo site_url('jasamontir/accpembayaran')?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?=$data->orderid?>">
                        <div class="col-lg-6" style="margin-bottom: 1em;">
                            <?php if($data->resi != null) { ?>
                                <label for="">Resi Pembayaran:</label>
                                <div class="text-left" >
                                    <img  width="400" height="600" src="<?=base_url('uploads/resi/'.$data->resi)?>" class="rounded" alt="...">
                                </div>
                            <?php } ?>                               
                        </div>
                                
                    <div class="col-lg-6">
                        <button name="submit" type="submit" class="btn btn-submit btn-primary btn-user btn-block">
                            Approve
                        </button>
                        </div>
                                
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>