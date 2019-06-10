<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Types <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">NomType <?php echo form_error('nomType') ?></label>
            <input type="text" class="form-control" name="nomType" id="nomType" placeholder="NomType" value="<?php echo $nomType; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">DetailsType <?php echo form_error('detailsType') ?></label>
            <input type="text" class="form-control" name="detailsType" id="detailsType" placeholder="DetailsType" value="<?php echo $detailsType; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">IdContact <?php echo form_error('idContact') ?></label>
            <input type="text" class="form-control" name="idContact" id="idContact" placeholder="IdContact" value="<?php echo $idContact; ?>" />
        </div>
	    <input type="hidden" name="idType" value="<?php echo $idType; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('types') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>