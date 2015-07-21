<?php

class UploadImage {

    /**
     * Author: tailm
     * @var CI_Controller
     */
    private $CI;
    private $_error;
    private $_dataimage;

    function __construct() {
        $this->CI = & get_instance();
    }

    public function do_upload($field) {
        //$config['upload_path'] = './assets/images/upload/';
        $config['upload_path'] = FCPATH . 'assets/images/upload/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

        $this->CI->load->library('upload', $config);
        if (!$this->CI->upload->do_upload($field)) {
            $this->_error = $this->CI->upload->display_errors();
            $result = 0;
        } else {
            $result = 1;
            //$data = array('upload_data' => $this->upload->data());
            $this->_dataimage = $this->CI->upload->data();
        }

        return $result;
    }

    public function getError() {
        return $this->_error;
    }

    public function getData() {
        return $this->_dataimage;
    }
    public function copyto($originalName, $dirUpload, $dirFix, $widthSize, $heightSize,$path) {
        if (!file_exists($dirFix)) {
            @mkdir($dirFix, 0777, TRUE);
            $this->CI->load->library('WriteFile');
            $fileName = $dirFix . '/index.html';
            $fileContent = "<html>\n";
            $fileContent .= "<body bgcolor='#FFFFFF'></body>\n";
            $fileContent .="</html>";
            $this->CI->writefile->_write_file($fileName, $fileContent);
        }
        
        $original = $path;
       
        $fix = $dirFix . $originalName;
              
        list($width, $height, $type) = getimagesize($original);
        if ($width <= $widthSize && $height <= $heightSize) {
            $ChoiceWith = $width;
            $ChoiceHeight = $height;
        } else {

            if ($width > $height && $width > $widthSize) {
                $radioWidth = $widthSize / $width;
                $ChoiceWith = $radioWidth * $width;
                $ChoiceHeight = $radioWidth * $height;
            }

            if ($width > $height && $width < $widthSize) {
                $ChoiceWith = $width;
                $ChoiceHeight = $height;
            }
            if ($height > $width && $height > $heightSize) {
                $radioHeight = $heightSize / $height;
                $ChoiceWith = $radioHeight * $width;
                $ChoiceHeight = $radioHeight * $height;
            }
            if ($height > $width && $height < $heightSize) {
                $ChoiceWith = $width;
                $ChoiceHeight = $height;
            }
        }
        if ($width == $height) {
            $radioWidth = $widthSize / $width;
            $ChoiceWith = $radioWidth * $width;
            $ChoiceHeight = $radioWidth * $height;
        }

        /*
          if($width > $height){
          $ChoiceWith = $height;
          $ChoiceHeight = $height;
          }
          if($width < $height){
          $ChoiceWith = $width;
          $ChoiceHeight = $width;
          }
          if($width == $height){
          $ChoiceWith = $width;
          $ChoiceHeight = $width;
          }
         */
        /*
          $ChoiceWith = $widthSize;
          $ChoiceHeight = $heightSize;
         */
        if ($type == 2) {
            //@header("Content-type: image/jpeg");
            $tn = imagecreatetruecolor($ChoiceWith, $ChoiceHeight);
            $image = imagecreatefromjpeg($original);
            imagecopyresampled($tn, $image, 0, 0, 0, 0, $ChoiceWith, $ChoiceHeight, $width, $height);
            imagejpeg($tn, $fix, 50);
        }
        if ($type == 1) {
            //@header("Content-type: image/gif");
            $tn = imagecreatetruecolor($ChoiceWith, $ChoiceHeight);
            $image = imagecreatefromgif($original);
            imagecopyresampled($tn, $image, 0, 0, 0, 0, $ChoiceWith, $ChoiceHeight, $width, $height);
            imagegif($tn, $fix);
        }
        if ($type == 3) {
            //@header("Content-type: image/png");
            $tn = imagecreatetruecolor($ChoiceWith, $ChoiceHeight);
            $image = imagecreatefrompng($original);
            imagecopyresampled($tn, $image, 0, 0, 0, 0, $ChoiceWith, $ChoiceHeight, $width, $height);
            imagepng($tn, $fix);
        }
    }
    public function copyandresize($originalName, $dirUpload, $dirFix, $widthSize, $heightSize) {
        if (!file_exists($dirFix)) {
            @mkdir($dirFix, 0777, TRUE);
            $this->CI->load->library('WriteFile');
            $fileName = $dirFix . '/index.html';
            $fileContent = "<html>\n";
            $fileContent .= "<body bgcolor='#FFFFFF'></body>\n";
            $fileContent .="</html>";
            $this->CI->writefile->_write_file($fileName, $fileContent);
        }
        
        $original = $dirUpload . $originalName;
       
        $fix = $dirFix . $originalName;
              
        list($width, $height, $type) = getimagesize($original);
        if ($width <= $widthSize && $height <= $heightSize) {
            $ChoiceWith = $width;
            $ChoiceHeight = $height;
        } else {

            if ($width > $height && $width > $widthSize) {
                $radioWidth = $widthSize / $width;
                $ChoiceWith = $radioWidth * $width;
                $ChoiceHeight = $radioWidth * $height;
            }

            if ($width > $height && $width < $widthSize) {
                $ChoiceWith = $width;
                $ChoiceHeight = $height;
            }
            if ($height > $width && $height > $heightSize) {
                $radioHeight = $heightSize / $height;
                $ChoiceWith = $radioHeight * $width;
                $ChoiceHeight = $radioHeight * $height;
            }
            if ($height > $width && $height < $heightSize) {
                $ChoiceWith = $width;
                $ChoiceHeight = $height;
            }
        }
        if ($width == $height) {
            $radioWidth = $widthSize / $width;
            $ChoiceWith = $radioWidth * $width;
            $ChoiceHeight = $radioWidth * $height;
        }

        /*
          if($width > $height){
          $ChoiceWith = $height;
          $ChoiceHeight = $height;
          }
          if($width < $height){
          $ChoiceWith = $width;
          $ChoiceHeight = $width;
          }
          if($width == $height){
          $ChoiceWith = $width;
          $ChoiceHeight = $width;
          }
         */
        /*
          $ChoiceWith = $widthSize;
          $ChoiceHeight = $heightSize;
         */
        if ($type == 2) {
            //@header("Content-type: image/jpeg");
            $tn = imagecreatetruecolor($ChoiceWith, $ChoiceHeight);
            $image = imagecreatefromjpeg($original);
            imagecopyresampled($tn, $image, 0, 0, 0, 0, $ChoiceWith, $ChoiceHeight, $width, $height);
            imagejpeg($tn, $fix, 50);
        }
        if ($type == 1) {
            //@header("Content-type: image/gif");
            $tn = imagecreatetruecolor($ChoiceWith, $ChoiceHeight);
            $image = imagecreatefromgif($original);
            imagecopyresampled($tn, $image, 0, 0, 0, 0, $ChoiceWith, $ChoiceHeight, $width, $height);
            imagegif($tn, $fix);
        }
        if ($type == 3) {
            //@header("Content-type: image/png");
            $tn = imagecreatetruecolor($ChoiceWith, $ChoiceHeight);
            $image = imagecreatefrompng($original);
            imagecopyresampled($tn, $image, 0, 0, 0, 0, $ChoiceWith, $ChoiceHeight, $width, $height);
            imagepng($tn, $fix);
        }
    }

    public function cropImage($originalName, $dirUpload, $dirFix, $iSize, $ImageType) {
        $Quality = 90; //jpeg quality

        $original = $dirUpload . $originalName;

        $fix = $dirFix . $originalName;

        switch (strtolower($ImageType)) {
            case 'png':
                //Create a new image from file 
                $SrcImage = imagecreatefrompng($original);
                break;
            case 'gif':
                $SrcImage = imagecreatefromgif($original);
                break;
            case 'jpg':
            case 'jpeg':
            case 'pjpeg':
                $SrcImage = imagecreatefromjpeg($original);
                break;
            default:
                die('Unsupported File!'); //output error and exit
        }

        list($CurWidth, $CurHeight) = getimagesize($original);

        if ($CurWidth <= 0 || $CurHeight <= 0) {
            return false;
        }

        //abeautifulsite.net has excellent article about "Cropping an Image to Make Square bit.ly/1gTwXW9
        if ($CurWidth > $CurHeight) {
            $y_offset = 0;
            $x_offset = ($CurWidth - $CurHeight) / 2;
            $square_size = $CurWidth - ($x_offset * 2);
        } else {
            $x_offset = 0;
            $y_offset = ($CurHeight - $CurWidth) / 2;
            $square_size = $CurHeight - ($y_offset * 2);
        }

        $NewCanves = imagecreatetruecolor($iSize, $iSize);
        if (imagecopyresampled($NewCanves, $SrcImage, 0, 0, $x_offset, $y_offset, $iSize, $iSize, $square_size, $square_size)) {
            switch (strtolower($ImageType)) {
                case 'image/png':
                    imagepng($NewCanves, $fix);
                    break;
                case 'image/gif':
                    imagegif($NewCanves, $fix);
                    break;
                case 'image/jpeg':
                case 'image/pjpeg':
                    imagejpeg($NewCanves, $fix, $Quality);
                    break;
                default:
                    return false;
            }
            //Destroy image, frees memory	
            if (is_resource($NewCanves)) {
                imagedestroy($NewCanves);
            }
            return true;
        }
    }

    //vinhtt
    public function reducePNG($path, $dir, $filename) {
        //$path = substr($path, 1, strlen($path));
        $m = microtime(true);
        $s = getimagesize($path);
        $w = $s[0];
        $h = $s[1];
        // Source
        $i = imagecreatefrompng($path);
        // Destination
        $d = imagecreatetruecolor($w, $h);
        // if this has no alpha transparency defined as an index
        // it could be a palette image??
        $palette = (imagecolortransparent($i) < 0);
        // If this has transparency, or is defined
        if (!$palette || (ord(file_get_contents($path, false, null, 25, 1)) & 4)) {
            // Has indexed transparent color
            if (($tc = imagecolorstotal($i)) && $tc <= 256)
                imagetruecolortopalette($d, false, $tc);
            imagealphablending($d, false);
            $alpha = imagecolorallocatealpha($d, 0, 0, 0, 127);
            imagefill($d, 0, 0, $alpha);
            imagesavealpha($d, true);
            //var_dump(microtime(true) - $m);
        }

        // Resample Image
        imagecopyresampled($d, $i, 0, 0, 0, 0, $w, $h, $s[0], $s[1]);
        //var_dump(microtime(true) - $m);
        // Did the original PNG supported Alpha?
        if ((ord(file_get_contents($path, false, null, 25, 1)) & 4)) {
            // we dont have to check every pixel.
            // We take a sample of 2500 pixels (for images between 50X50 up to 500X500), then 1/100 pixels thereafter.
            $dx = min(max(floor($w / 50), 1), 10);
            $dy = min(max(floor($h / 50), 1), 10);

            $palette = true;
            for ($x = 0; $x < $w; $x = $x + $dx) {
                for ($y = 0; $y < $h; $y = $y + $dy) {
                    $col = imagecolorsforindex($d, imagecolorat($d, $x, $y));
                    // How transparent until it's actually visible
                    // I reackon atleast 10% of 127 before its noticeable, e.g. ~13
                    if ($col['alpha'] > 13) {
                        //print_r($col);
                        $palette = false;
                        break 2;
                    }
                }
            }
            //var_dump(microtime(true) - $m);
            //var_dump(!$palette);
        }

        if ($palette) {
            imagetruecolortopalette($d, false, 256);
            //var_dump(microtime(true) - $m);
        }

        // Save file, quality=9, Add filters... although sometimes better without.
        imagepng($d, '' . $dir . $filename, 9, PNG_ALL_FILTERS);
    }
    public function crop_image($originalName,$dirUpload,$dirFix,$ImageType,$x,$y,$w,$h){
		$targ_w = $targ_h = 150;
		$jpeg_quality = 90;

		$src = $dirUpload . $originalName;
		$fix =  $dirFix . $originalName;
		
		switch(strtolower($ImageType))
		{
			case 'image/png':
				//Create a new image from file 
				$img_r =  @imagecreatefrompng($src);
				break;
			case 'image/gif':
				$img_r =  @imagecreatefromgif($src);
				break;			
			case 'image/jpeg':
			case 'image/pjpeg':
				$img_r = @imagecreatefromjpeg($src);
				break;
			default:
				die('Unsupported File!'); //output error and exit
		}
		list($CurWidth,$CurHeight)=@getimagesize($src);
		
		if($CurWidth > 700){
			$imgW = 700;
			$imgH = (700/$CurWidth)*$CurHeight;
		}else{
			$imgW = $CurWidth;
			$imgH = $CurHeight;
		}
		
		$resizedImage = @imagecreatetruecolor($imgW, $imgH);
		@imagecopyresampled($resizedImage, $img_r, 0, 0, 0, 0, $imgW,$imgH, $CurWidth, $CurHeight);	
		
		//$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
		
		$targ_w = $w;
		$targ_h = $h;
		
		$dst_r = ImageCreateTrueColor( $w, $h );

		if(@imagecopyresampled($dst_r,$resizedImage,0,0,$x,$y,$targ_w,$targ_h,$w,$h)){
			switch(strtolower($ImageType))
			{
				case 'image/png':
					@imagepng($dst_r,$fix);
					break;
				case 'image/gif':
					@imagegif($dst_r,$fix);
					break;			
				case 'image/jpeg':
				case 'image/pjpeg':
					@imagejpeg($dst_r,$fix,$jpeg_quality);
					break;
				default:
					return false;
			}
			//Destroy image, frees memory	
			if(is_resource($dst_r)) {@imagedestroy($dst_r);} 
			return true;
		}

		//header('Content-type: image/jpeg');
		//imagejpeg($dst_r,null,$jpeg_quality);
	}

}
