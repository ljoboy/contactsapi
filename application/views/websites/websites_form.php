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
        <h2 style="margin-top:0px">Websites <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Url <?php echo form_error('url') ?></label>
            <input type="text" class="form-control" name="url" id="url" placeholder="Url" value="<?php echo $url; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">IdContact <?php echo form_error('idContact') ?></label>
            <input type="text" class="form-control" name="idContact" id="idContact" placeholder="IdContact" value="<?php echo $idContact; ?>" />
        </div>
	    <input type="hidden" name="idSite" value="<?php echo $idSite; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('websites') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>