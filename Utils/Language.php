<?php
    namespace App\Utils;
    use App\Config\Config;

    class Language
    {  
        public static function getField($field)
        {
            $lang = Config::LANGUAGE;
            if (isset($_SESSION["language"])) {
                $lang = $_SESSION["language"];
            }

            $langfile = fopen($_SERVER["DOCUMENT_ROOT"] . "/Languages/" . $lang . ".json", "r");
            $langjson = fread($langfile, filesize($_SERVER["DOCUMENT_ROOT"] . "/languages/" . $lang . ".json"));

            $langobj = json_decode($langjson, true);

            return $langobj[$field];
        }    
    }
?>