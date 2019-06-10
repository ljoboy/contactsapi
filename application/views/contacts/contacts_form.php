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
        <h2 style="margin-top:0px">Contacts <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nom <?php echo form_error('nom') ?></label>
            <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="<?php echo $nom; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Postnom <?php echo form_error('postnom') ?></label>
            <input type="text" class="form-control" name="postnom" id="postnom" placeholder="Postnom" value="<?php echo $postnom; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Prenom <?php echo form_error('prenom') ?></label>
            <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom" value="<?php echo $prenom; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Cree Le <?php echo form_error('cree_le') ?></label>
            <input type="text" class="form-control" name="cree_le" id="cree_le" placeholder="Cree Le" value="<?php echo $cree_le; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Etat <?php echo form_error('etat') ?></label>
            <input type="text" class="form-control" name="etat" id="etat" placeholder="Etat" value="<?php echo $etat; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Genre <?php echo form_error('genre') ?></label>
            <input type="text" class="form-control" name="genre" id="genre" placeholder="Genre" value="<?php echo $genre; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Img Url <?php echo form_error('img_url') ?></label>
            <input type="text" class="form-control" name="img_url" id="img_url" placeholder="Img Url" value="<?php echo $img_url; ?>" />
        </div>
	    <input type="hidden" name="idContact" value="<?php echo $idContact; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('contacts') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>