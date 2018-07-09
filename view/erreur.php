<?php $title= "Erreur"; ?>
<?php ob_start();

echo 'Erreur : ' . $e->getMessage() . '<br />';
echo 'On dirait que vous vous êtes perdus en chemin... <a href="index.php">Revenez plutôt à l\'index !</a>';

$content = ob_get_clean();
require('template.php');

