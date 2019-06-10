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
        <h2 style="margin-top:0px">Contacts Read</h2>
        <table class="table">
	    <tr><td>Nom</td><td><?php echo $nom; ?></td></tr>
	    <tr><td>Postnom</td><td><?php echo $postnom; ?></td></tr>
	    <tr><td>Prenom</td><td><?php echo $prenom; ?></td></tr>
	    <tr><td>Cree Le</td><td><?php echo $cree_le; ?></td></tr>
	    <tr><td>Etat</td><td><?php echo $etat; ?></td></tr>
	    <tr><td>Genre</td><td><?php echo $genre; ?></td></tr>
	    <tr><td>Img Url</td><td><?php echo $img_url; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('contacts') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>