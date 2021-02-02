<?php
function token64()
        {
            $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $longueurMax = strlen($caracteres);
            $chaineAleatoire = '';
            for ($i = 0; $i < 64; $i++)
            {
                $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
            }
            return $chaineAleatoire;
        }

        function token32()
        {
            return sprintf('%04X%04X%04X%04X%04X%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));    
        }

        function guid()
        {
            return sprintf('%04X-%04X-%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));    
        }

        echo "token64() -> ".token64();
        echo "<BR>";
        echo "token32() -> ".token32();
        echo "<BR>";
        echo "guid() -> ".guid();
        echo "<BR>";
        echo "<BR>";
        ?>