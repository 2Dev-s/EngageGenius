<?php

require_once  __DIR__ .  "/constants.php";
function postHandleTags(array|null $tags) : string | null { // handles tags and returns them as a string
    if ($tags && count($tags) > 0) {
        $tags = array_map(fn ($tag): string => "#" . $tag, $tags); // adds # to each tag [1, 2, 3] > [#1, #2, #3]
        $tags = implode(" ", $tags); // joins tags with space [#1, #2, #3] > "#1 #2 #3"
        return $tags;
    }

    return null;
}
function postHandleTagsUnpack(string|null $tags): array { // handles tags and returns them as an array
    if ($tags) {
        $tags = explode(" ", $tags); // splits tags by space "#1 #2 #3" > ["#1", "#2", "#3"]
        $tags = array_map(fn ($tag): string => str_replace("#", "", $tag), $tags); // removes # from each tag ["#1", "#2", "#3"] > ["1", "2", "3"]
        return $tags;
    }
    return [];
}
function postHandleSocials(array $socials): array { // handles socials and returns them as an array

    $selectedSocials = [];

    foreach (POSTSOCIALS as $social) {
        $selectedSocials[$social] = ((in_array($social, $socials)) ? true : false); // checks if social is in the array of socials and sets it to true or false
    };

    return $selectedSocials;
}
function postHandleSocialsToArray(array $postAttrs): array { // handles socials and returns them as an array
    $socials = [];
    foreach (POSTSOCIALS as $social) {
        if ($postAttrs[$social] == true) {
            $socials[] = $social;
        }
    }
    return $socials;
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