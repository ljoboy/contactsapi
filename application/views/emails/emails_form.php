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
        <h2 style="margin-top:0px">Emails <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Email <?php echo form_error('email') ?></label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">IdContact <?php echo form_error('idContact') ?></label>
            <input type="text" class="form-control" name="idContact" id="idContact" placeholder="IdContact" value="<?php echo $idContact; ?>" />
        </div>
	    <input type="hidden" name="idEmail" value="<?php echo $idEmail; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('emails') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>