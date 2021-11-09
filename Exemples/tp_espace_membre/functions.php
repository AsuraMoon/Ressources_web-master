<?php
function nettoyerTexte($texte)
{
    $texte = trim($texte); // supprime espace et retour à la ligne
    $texte = stripslashes($texte); // supprime les antislashes
    $texte = htmlspecialchars($texte); // transforme tout les carcatères spéciaux en caractères HTML

    return $texte;
}