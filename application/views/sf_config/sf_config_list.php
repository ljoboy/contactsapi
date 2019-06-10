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
        <h2 style="margin-top:0px">Sf_config List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('sf_config/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('sf_config/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('sf_config'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Sf Table</th>
		<th>Sf Field</th>
		<th>Sf Type</th>
		<th>Sf Related</th>
		<th>Sf Label</th>
		<th>Sf Desc</th>
		<th>Sf Order</th>
		<th>Sf Hidden</th>
		<th>Action</th>
            </tr><?php
            foreach ($sf_config_data as $sf_config)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $sf_config->sf_table ?></td>
			<td><?php echo $sf_config->sf_field ?></td>
			<td><?php echo $sf_config->sf_type ?></td>
			<td><?php echo $sf_config->sf_related ?></td>
			<td><?php echo $sf_config->sf_label ?></td>
			<td><?php echo $sf_config->sf_desc ?></td>
			<td><?php echo $sf_config->sf_order ?></td>
			<td><?php echo $sf_config->sf_hidden ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('sf_config/read/'.$sf_config->sf_id),'Read'); 
				echo ' | '; 
				echo anchor(site_url('sf_config/update/'.$sf_config->sf_id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('sf_config/delete/'.$sf_config->sf_id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>