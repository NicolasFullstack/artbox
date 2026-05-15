<?php

function connexion()
{
    $bdd = new PDO(
        'mysql:host=localhost;dbname=artbox;charset=utf8',
        'root',
        ''
    );

    return $bdd;
}