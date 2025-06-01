<?php

// GESTION INFORMATIONS UTILISATEURS (USERS ET CONDUCTEURS)
function displayNoteStars($note) : string
{
    $stars = "";

    for ($i = 0; $i < floor($note); $i++) {
        $stars .= "⭐";
    }
    return $stars;
}