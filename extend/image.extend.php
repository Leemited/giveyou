<?php
	@ini_set('gd.jpeg_ignore_warning', 1);
	@ini_set('memory_limit','-1');
	function image_resize_update($src, $dst, $output, $resize_width, $resize_height=''){
		$uploadedfile = $src;
		$filename = str_replace("%","",$dst); 
		$filename = stripslashes($filename);
		$str = $filename;
		
		$i = strrpos($str,".");
		if (!$i)
			return false;
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		$extension = $ext;
		$extension = strtolower($extension);
		
		if (($extension != "jpg") && ($extension != "jpeg")
		&& ($extension != "png") && ($extension != "gif")) 
		{
			move_uploaded_file($src, $output);//return false;
		}
		else
		{
			$uploadedfile = $src;
			if($extension=="jpg" || $extension=="jpeg" ){
				$src = imagecreatefromjpeg($uploadedfile);
			}
			else if($extension=="png"){
				$src = imagecreatefrompng($uploadedfile);
			}else{
				$src = imagecreatefromgif($uploadedfile);
			}
			 
			list($width,$height)=getimagesize($uploadedfile);

			if($width<$resize_width){
				$newwidth=$width;
			}else{
				$newwidth=$resize_width;
			}

			if($resize_height)
				$newheight = $resize_height;
			else
				$newheight= ceil(($height/$width)*$newwidth);
			
			$tmp=imagecreatetruecolor($newwidth,$newheight);
			if($extension=="png"){
				imagealphablending($tmp, false);
				imagesavealpha($tmp, true);
				$white=ImageColorAllocate($tmp,255,255,255); 
				imagecolortransparent($tmp,$white);
				//$transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
				//imagefilledrectangle($tmp, 0, 0, $width, $height, $transparent);
			}
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			if($extension=="jpg" || $extension == "jpeg"){
				$exif = exif_read_data($uploadedfile);
				if(!empty($exif['Orientation'])) {
					switch($exif['Orientation']) {
						case 8:
							$tmp = imagerotate($tmp,90,0);
							break;
						case 3:
							$tmp = imagerotate($tmp,180,0);
							break;
						case 6:
							$tmp = imagerotate($tmp,-90,0);
							break;
					}
				}
			}
			$filename = $output;
			if($extension=="jpg" || $extension == "jpeg"){
				imagejpeg($tmp,$filename,100);
			}else if($extension=="png"){
				imagepng($tmp,$filename);
			}else{
				imagejpeg($tmp,$filename,100);
			}
			imagedestroy($src);
			imagedestroy($tmp);
			
			return true;
		}
	}
	/*function image_blur_update($src, $dst, $output, $resize_width, $resize_height=''){
		$uploadedfile = $src;
		$filename = stripslashes($dst);
		
		$str = $filename;
		
		$i = strrpos($str,".");
		if (!$i)
			return false;
		
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		
		$extension = $ext;
		$extension = strtolower($extension);
		
		if (($extension != "jpg") && ($extension != "jpeg")
		&& ($extension != "png") && ($extension != "gif")) 
		{
			return false;
		}
		else
		{
			/*$size=filesize($src);
			if ($size > 8388608){
				$msg = "You have exceeded the size limit";
				$errors=1;
				return false;
			}
			if($extension=="jpg" || $extension=="jpeg" ){
				$uploadedfile = $src;
				$src = imagecreatefromjpeg($uploadedfile);
			}
			else if($extension=="png"){
				$uploadedfile = $src;
				$src = imagecreatefrompng($uploadedfile);
			}else{
				$src = imagecreatefromgif($uploadedfile);
			}

			list($width,$height)=getimagesize($uploadedfile);
			
			if($width<$resize_width){
				$newwidth=$width;
			}else{
				$newwidth=$resize_width;
			}
			if($resize_height)
				$newheight = $resize_height;
			else
				$newheight=($height/$width)*$newwidth;
			

			$tmp=imagecreatetruecolor($newwidth,$newheight);
			if($extension=="png"){
				imagealphablending($tmp, false);
				imagesavealpha($tmp, true);
				$white=ImageColorAllocate($dst_img,255,255,255); 
				//$transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
				imagecolortransparent($tmp,$white);
				//imagefilledrectangle($tmp, 0, 0, $width, $height, $transparent);
			}
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

			$exif = exif_read_data($uploadedfile);

			if(!empty($exif['Orientation'])) {
				switch($exif['Orientation']) {
					case 8:
						$tmp = imagerotate($tmp,90,0);
						break;
					case 3:
						$tmp = imagerotate($tmp,180,0);
						break;
					case 6:
						$tmp = imagerotate($tmp,-90,0);
						break;
				}
			}

			$filename = $output;
			
			if($extension=="jpg" || $extension=="jpeg" ){
				imagejpeg($tmp,$filename,100);
			}else if($extension=="png"){
				imagepng($tmp,$filename);
			}else{
				imagejpeg($tmp,$filename,100);
			}
			imagedestroy($src);
			imagedestroy($tmp);
			
			return true;
		}
	}*/
?>