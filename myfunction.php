<?php
    function taggenerator($string)
    {
        /*
        * Açıklama içerisindeki etiketleri ayıklar
        * Ayıklanan etiketleri bir array içerisine atar
        * */
        $record = false;
        $tags = array();
        $counter = 0;
        for ($i = 0; $i < strlen($string); $i++) {
            if ($string[$i] == '#') {
                if ($record) {
                    if ($string[$i + 1] != ' ') {
                        $counter++;
                    }
                } else {
                    $record = true;
                }
                continue;
            }
            if ($string[$i] == ' ' && $record) {
                $record = false;
                $counter++;
            }

            if ($record) {
                $tags[$counter] .= $string[$i];
            }
        }
        return $tags;
    }


    function genregenerator($string)
    {
        /*
        * Seçilen tür id'lerini bir array içerisine toplar, tagdan farklı olarak idler direk ilişkisel tabloya kayıt edilir
        */
        $genres = array();
        $counter = 0;
        for ($i = 0; $i < strlen($string); $i++) {
            if ($string[$i] == ',') {
                $counter++;
                continue;
            }
            $genres[$counter] .= $string[$i];
        }
        return $genres;
    }

    function addspan($class, $id, $upid)
    {
        echo "<div id='$upid'>";
        echo '<span class="' . $class . '" id="' . $id . '">';
        switch ($class) {
            case 'edit':
                echo '<i class="material-icons">mode_edit</i>';
                break;
            case 'remove';
                echo '<i class="material-icons">delete_forever</i>';
                break;
        }
        echo '</span></div>';
    }



    function ErrorPost($errorNo,$errorlist){
        echo '<br>'.$errorNo. ' =>'. $errorlist[$errorNo]. '<br>';
    }
?>