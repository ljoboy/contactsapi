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
        <h2 style="margin-top:0px">Sf_config Read</h2>
        <table class="table">
	    <tr><td>Sf Table</td><td><?php echo $sf_table; ?></td></tr>
	    <tr><td>Sf Field</td><td><?php echo $sf_field; ?></td></tr>
	    <tr><td>Sf Type</td><td><?php echo $sf_type; ?></td></tr>
	    <tr><td>Sf Related</td><td><?php echo $sf_related; ?></td></tr>
	    <tr><td>Sf Label</td><td><?php echo $sf_label; ?></td></tr>
	    <tr><td>Sf Desc</td><td><?php echo $sf_desc; ?></td></tr>
	    <tr><td>Sf Order</td><td><?php echo $sf_order; ?></td></tr>
	    <tr><td>Sf Hidden</td><td><?php echo $sf_hidden; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('sf_config') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>