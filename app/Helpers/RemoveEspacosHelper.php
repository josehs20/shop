<?php

if (!function_exists('string')) {

    /**
     * description
     *
     * @param
     * @return
     */
    //Remove espaços desnecessáios da string
    function remove_espacos($string)
    {
        return trim(preg_replace('/\\s\\s+/', ' ', $string));
    }
}
