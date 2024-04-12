<?php

require_once __DIR__ . "/Post/consts.php";

function postHandleTags(array|null $tags) : array | null { // handles tags and returns them as a string
    if ($tags && count($tags) > 0) {
        $tags = array_map(fn ($tag): string => "#" . $tag, $tags); // adds # to each tag [1, 2, 3] > [#1, #2, #3]
        $tags = implode(" ", $tags); // joins tags with space [#1, #2, #3] > "#1 #2 #3"
        return $tags;
    }

    return null;
}

function  postHandleSocials(array $socials): array { // handles socials and returns them as an array

    $selectedSocials = [];

    foreach (SOCIALS as $social) {
        $selectedSocials[$social] = ((in_array($social, $socials)) ? true : false); // checks if social is in the array of socials and sets it to true or false
    };

    return $selectedSocials;
}
function postAddOrderAttributetoPhotos(array $files): array { // handles photos and returns them as an array
        
    if ($files && count($files) > 0) {
        $files = array_map(function ($file, $i) { // sets order for each file (made for reusability of funtion in update method)
            $file["position"] = $i;
            return $file;
        }, $files, array_keys($files)); 

        return $files;
    }

    return [];
}