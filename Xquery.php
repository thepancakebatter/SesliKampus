<?php

/*
 * xquery sınıfını database bilgilerini içeren bir array ile kurmalısınız;
 *
 * Xquery bir sql sorgusu olup, SELECT ifadesi çağırıldığında dönen değerin boyutuna göre(dimension)
 * bir array yada değer döndürür.
 *
 * INSERT INTO,UPDATE ve DELETE FROM ifadeleri çağırıldığında, işelerin başarı durumuna göre başarılıysa true,
 *  başarısızsa false döndürür.
 */

class xquery
{
    public $conn;
    public $config;

    public function __construct($my_config)
    {
        $this->config = $my_config;
    }

    public function connection($a)
    {

        $this->conn = mysqli_connect($a[0], $a[1], $a[2], $a[3]);
        if (!mysqli_set_charset($this->conn, "utf8")) {
            printf("Error loading character set utf8: %s\n", mysqli_error($this->conn));
            exit();
        } else {
            // printf("Current character set: %s\n", mysqli_character_set_name($conn));
        }
        if (!$this->conn) {
            die("Connection failed:" . mysqli_connect_error());
        }


    }

    //Parametrelerin yerleri değişti
    public function Xquery($sql, $a = '', $starterkey = false, $debug = false)
    {
        $this->connection($this->config);
        $con = $this->conn;
        if (is_array($a)) {
            $keys = array_keys($a);
        }else{
            $keys = '';
        }
        $add = ' ';
        for ($i = 0; $i < count($a); $i++) {

            if ($keys[0] == '') {
                $add .= '\'';
                $add .= $a;
                $add .= '\' ';
                break;
            }
            $add .= '`';
            $add .= $keys[$i];
            $add .= '` = \'';
            $add .= $a[$keys[$i]];
            if (count($a) > 1 && $i < count($a) - 1) {
                $add .= '\', ';
            } else $add .= '\'';
        }
        $sql = str_replace('?', $add, $sql);
        if ($debug) echo $sql;

        if (strpos($sql, 'SELECT') !== false) {
            $result = mysqli_query($con, $sql);
            if(!$result){
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
                return;
            }
            if (mysqli_num_rows($result) > 0) {
                $counter = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $rowkey = array_keys($row);
                    for ($i = 0; $i < count($row); $i++) {
                        $my_result[$counter][$rowkey[$i]] = $row[$rowkey[$i]];
                    }

                    $counter++;
                }
                if (!$starterkey) {
                    if ($counter == 1) {
                        $my_result = $my_result[0];
                        if (count($my_result) == 1) {
                            $my_result = $my_result[$rowkey[0]];
                        }
                    }
                }

                mysqli_close($con);
                return $my_result;
            } else {
                mysqli_close($con);
                return 0;
            }
        } elseif (strpos($sql, 'INSERT INTO') !== false) {
//                echo $sql;


            if (mysqli_query($con, $sql)) {
//                    echo "Updated successfully";
                mysqli_close($con);
                return 1;
            } else {

//                    echo "Error: " . $sql . "<br>" . mysqli_error($con);

                mysqli_close($con);

                return 0;
            }
        } elseif (strpos($sql, 'UPDATE') !== false) {
            if (mysqli_query($con, $sql)) {
//                    echo "Updated successfully";
                mysqli_close($con);
                return 1;
            } else {

//                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                mysqli_close($con);
                return 0;
            }

        } elseif (strpos($sql, 'DELETE FROM') !== false) {
            if (mysqli_query($con, $sql)) {
//                    echo "Updated successfully";
                mysqli_close($con);
                return 1;
            } else {

//                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                mysqli_close($con);
                return 0;
            }
        } else {
            echo "SQL Query Error";
            mysqli_close($con);
            return NULL;
        }
    }
//sesli kampus eklentisi_konum çağırma
    public function get_location()
    {

        $loc = $this->Xquery('SELECT location_id,parent_id,name FROM sk_location ', '', true, false);
        $location = array();
        if ($loc == 0) return NULL;
//                    $location["children"] = array();
        $locup = array();
        foreach ($loc as $x) {
            $location["name"] = $x["name"];
            $location["location_id"] = $x["location_id"];
            $location["parent_id"] = $x["parent_id"];
//                        array_push($location["children"],get_location($x["location_id"], $conn));
            array_push($locup, $location);
        }
//                    print_r($loc);
        return $locup;
    }

}