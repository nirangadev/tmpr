<?php

/*
    |--------------------------------------------------------------------------
    | CSV file reader - using as a database
    |--------------------------------------------------------------------------
    |
    |
    */
class Csv
    { 
    private $fp; 
    private $parse_header; 
    private $header; 
    private $delimiter; 
    private $length;

    function __construct($file_name, $delimiter=';', $parse_header=true, $length=1000) {
        $this->fp = fopen(ROOT."/storage/".$file_name.".csv", 'r'); 
        $this->parse_header = $parse_header; 
        $this->delimiter = $delimiter; 
        $this->length = $length; 
        if ($this->parse_header) { 
            $this->header = fgetcsv($this->fp, $this->length, $this->delimiter); 
            $this->header = array_map('trim',$this->header ); // // $array=array_map('trim',$array); fait un trim sur chaque val du tableau
            }
        } 

    function __destruct() { 
        if ($this->fp) { 
            fclose($this->fp); 
            } 
        }

    function headerExists($h) {
        if ($this->parse_header) {
            if(in_array($h,$this->header)) {return true;}
            }
        return false;
        }


    function getall() {

        while (($row = fgetcsv($this->fp, $this->length, $this->delimiter)) !== FALSE) { 
            if ($this->parse_header) { 
                foreach ($this->header as $i => $heading_i) {
                    if(!isset($row[$i])) {$row[$i]='';}
                    $row_new[$heading_i] = trim($row[$i]);
                    } 
                $data[] = $row_new;
                } 
            else { 
                $data[] = array_map('trim',$row);  // $array=array_map('trim',$array); fait un trim sur chaque val du tableau
                }
        }
        return $data; 
    } // getall()

        function getOne($id) { 
            $data = array(); 
            $line_count = 1;
            while ($line_count <= $id && ($row = fgetcsv($this->fp, $this->length, $this->delimiter)) !== FALSE) {
                if($line_count == $id){
                    if ($this->parse_header) {
                        foreach ($this->header as $i => $heading_i) {
                            if(!isset($row[$i])) {$row[$i]='';}
                                $row_new[$heading_i] = trim($row[$i]);
                            }
                        $data[] = $row_new;
                        } else {
                            $data[] = array_map('trim',$row);  // $array=array_map('trim',$array);
                        }
                        break;
                }
                $line_count++;
            }
            return $data; 
        } // getone()
    }
    