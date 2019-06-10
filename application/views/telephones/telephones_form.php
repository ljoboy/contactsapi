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
        <h2 style="margin-top:0px">Telephones <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="bigint">Numero <?php echo form_error('numero') ?></label>
            <input type="text" class="form-control" name="numero" id="numero" placeholder="Numero" value="<?php echo $numero; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">IdContact <?php echo form_error('idContact') ?></label>
            <input type="text" class="form-control" name="idContact" id="idContact" placeholder="IdContact" value="<?php echo $idContact; ?>" />
        </div>
	    <input type="hidden" name="idPhone" value="<?php echo $idPhone; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('telephones') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>