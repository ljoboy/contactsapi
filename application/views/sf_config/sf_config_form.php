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
        <h2 style="margin-top:0px">Sf_config <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Sf Table <?php echo form_error('sf_table') ?></label>
            <input type="text" class="form-control" name="sf_table" id="sf_table" placeholder="Sf Table" value="<?php echo $sf_table; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Sf Field <?php echo form_error('sf_field') ?></label>
            <input type="text" class="form-control" name="sf_field" id="sf_field" placeholder="Sf Field" value="<?php echo $sf_field; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Sf Type <?php echo form_error('sf_type') ?></label>
            <input type="text" class="form-control" name="sf_type" id="sf_type" placeholder="Sf Type" value="<?php echo $sf_type; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Sf Related <?php echo form_error('sf_related') ?></label>
            <input type="text" class="form-control" name="sf_related" id="sf_related" placeholder="Sf Related" value="<?php echo $sf_related; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Sf Label <?php echo form_error('sf_label') ?></label>
            <input type="text" class="form-control" name="sf_label" id="sf_label" placeholder="Sf Label" value="<?php echo $sf_label; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinytext">Sf Desc <?php echo form_error('sf_desc') ?></label>
            <input type="text" class="form-control" name="sf_desc" id="sf_desc" placeholder="Sf Desc" value="<?php echo $sf_desc; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Sf Order <?php echo form_error('sf_order') ?></label>
            <input type="text" class="form-control" name="sf_order" id="sf_order" placeholder="Sf Order" value="<?php echo $sf_order; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Sf Hidden <?php echo form_error('sf_hidden') ?></label>
            <input type="text" class="form-control" name="sf_hidden" id="sf_hidden" placeholder="Sf Hidden" value="<?php echo $sf_hidden; ?>" />
        </div>
	    <input type="hidden" name="sf_id" value="<?php echo $sf_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('sf_config') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>