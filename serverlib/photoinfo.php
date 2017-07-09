<?php

class PhotoInfo {
      function __construct($filePath,$width,$height,$filedate,$description) {
        $this->FilePath=$filePath;
        //$this->ThumbPath=$thumbPath;
        $this->Width=$width;
        $this->Height=$height;
        $this->FileDate=$filedate;
        $this->Description=$description;
        $this->HrefId = date ("mdY", $filedate);
        
   }
    
    public $FilePath='';
    public $Width=0;
    public $Height=0;
    //public $ThumbPath=0;
    public $FileDate;
    public $Description;
    public $HrefId;
    

}

?>