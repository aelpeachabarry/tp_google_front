<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>
  <link rel="stylesheet" href="">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
</head>
<body>

<h3>Tapez votre recherche</h3>
<form method="post" action="">
	<input type="text" name="search" class="form-control" placeholder="Tapez votre recherche">
	<input type="submit" value="Envoyer" />
</form>
<p>Vous voulez soummetre une url à l'indexation? cliquez<a href="<?php echo site_url(array('searchform', 'indexer')); ?>" >ici</a></p>
<br/><br/>

<div id="sources_list"></div>

<script type="text/javascript">
$(function(){

    //on ecoute ce que l'utilisateur tape dans le champ de recherche
    $('.form-control').keyup(function(){
        
        var field = $(this);// a pour valeur $(.search)
        console.log(field);
        $('#sources_list').html(''); //on initialise le contenu de la div

        if(field.val().length >1)//si on a tapé plus de 1 caractere
        {
            $.ajax({

                url: 'http://localhost/google_front_tp/searchform/recherche',
                type: 'POST',
                data: 'search=' + $('.form-control').val(),

                success: function(data){
                    $('#sources_list').html(data);
                    console.log(data);
                }

            });
        }

    });


    
});

</script>   
</body>
</html>