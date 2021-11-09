<?php 

for ($i=0; $i<count($tab); $i++)
{
    if ($tab[key($tab)]==true) {
        $montableau2[][key($tab)]='code';
    }
    next($tab);
}

// Ceci est une horreur ... c'est sale très sale ....
