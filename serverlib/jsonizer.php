<?php
require_once('photoinfo.php');

class Jsonizer {
    public function getFiles($imagesDir){
        echo json_encode($this->getFilesAsArray($imagesDir),JSON_UNESCAPED_SLASHES);
        }
    
    public function getFilesAsArray($imagesDir){
        $configs = include('../configs.php');
        $iDir = ROOT .$configs['imagesDir'];
       date_default_timezone_set('America/Los_Angeles');
        $files = array();
        //$fileBinary = array();

        $fileBinaries= glob($iDir . '/*.jpg');
        //$fileBinaries= glob($imagesDir . '/*.jpg');
        usort($fileBinaries, function($a, $b) {
            return filemtime($a) < filemtime($b);
        });
        foreach ( $fileBinaries as $fileBinary ) {
            if($fileBinary != "." && $fileBinary != ".." && strpos($fileBinary, 'Number-') !== false){
                list($width, $height, $type, $attr) = getimagesize($fileBinary);
                $ft = filemtime($fileBinary);
                preg_match("/Number-.*/", $fileBinary, $matches);
                $localUrl ='/'. $configs['imagesDir'].'/'.$matches[0];
                $files[] = new PhotoInfo( $localUrl,$width,$height,$ft, date ("F d, Y", $ft));
            }
        }

        return $files;
    }
    
    public function putSelectedImageOnTop($images, $onTopImagePath){
        $imageToMove = null;
        $newArray = array();
        if($onTopImagePath != null){
            foreach( $images as $image ) {
                if( $image->FilePath == $onTopImagePath) {
                    $imageToMove = $image;
                }else{
                    $newArray[] =  $image;
                }
            }
            if( $imageToMove != null){
                array_unshift($newArray,$imageToMove);

                return $newArray;
            }
        }

        return $images;
    }
}
?>