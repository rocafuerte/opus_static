<?php
#An image class
class Image{
	function __construct(){
	}
	
	/** 
	 * Returns true if the image is broad
	 */
	static function get_width($width, $maxWidth){
		if($width<=$maxWidth){
			return $width;
		}
		return $maxWidth;	
	}
	  
    public function createThumb($source,$dest,$thumb_size){
	
		  $image_properties = getimagesize($source);
			  
		  Header ("Content-type: image/jpeg");
          $width = $size[0];
          $height = $size[1];

          if($width> $height) {
              $x = ceil(($width - $height) / 2 );
              $width = $height;
          } elseif($height> $width) {
              $y = ceil(($height - $width) / 2);  
              $height = $width; 
          }
		  
          $new_im = ImageCreatetruecolor($thumb_size,$thumb_size); 
          $im = imagecreatefromjpeg($source);
          imagecopyresampled($new_im,$im,0,0,$x,$y,$thumb_size,$thumb_size,$width,$height);
          imagejpeg($new_im,$dest,100);
	}
	
	static function img($filename,$width){
		$image_properties = getimagesize($source);	  
        $w = $image_properties[0];
        $h = $image_properties[1];
		echo '<img src="'.Settings::getUploadedImages().'/$filename" alt="$filename" width="$width"/>';
	}
	
	static function displayImage($filename,$width,$class,$alt){
		$size = getimagesize(Settings::getUploadedImages()."/".$filename);
		if($size[0]>$width){
			return '<img src="'.Settings::getUploadedImages()."/".$filename.'" alt="'.$alt.'" class="'.$class.'" width="'.$width.'"/>';
		}else{
			return '<img src="'.Settings::getUploadedImages()."/".$filename.'" alt="'.$alt.'" class="'.$class.'" />';
		}
	}
}