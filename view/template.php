<?php $checkAuth = new UserSession(); 
$flashMessage = new FlashMessage(); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
	 	 <script type="text/javascript" src="public/tinyMCE/tiny_mce/tiny_mce.js"></script>
    <script type="text/javascript">
	 tinyMCE.init({
            mode : "exact",
			theme : "advanced",
		    elements : "content",
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontsizeselect,|,cut,copy,|,search,replace,bullist,numlist",
            theme_advanced_buttons2 : "outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor,|,sub,sup,|,charmap,emotions,|,ltr,rtl,|,fullscreen",
			init_instance_callback : "onInstanceInit",
        });
     </script>
        <title><?= $title ?></title>
        <link href="public/style.css" rel="stylesheet" /> 
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
	<body>
	<header>
		<h1> Billet simple pour l'Alaska</h1>
		
		<h2> Un livre en ligne</h2>

	
		<a href="index.php">Index</a>
			 <hr class="style-one"></hr>

	</header>
	
<?php if ($flashMessage->messageExist()){
	?>
	<aside class="infoMessage" id="messageFlash"><?= $flashMessage->readMessage(); ?></aside>
<?php } ?>
		 
     <?= $content ?>
<footer>
	<?php

	if ($checkAuth->isAuthenticated()){
	echo	'<a href="index.php?action=gestionAdmin">Portail d\'administration</a> <br />';	
	echo	'<a href="index.php?action=logoff">Déconnexion</a>';
	}
	else {
		echo	'<a href="index.php?action=login">Authentification</a>';
	}
	?>
</footer>

</body>
</html>