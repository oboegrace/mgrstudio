<?php 

include_once( 'admin/model/adminModel.php' );
include_once( 'system/DataManagers/MysqlManager.php' );

class newsEditModel extends adminModel {

	public function getNewsData() {

		// get id from url
		$id = 0 ; // 因為index 不會 = 0
		if (isset($_GET['id'])){
			$id = $_GET['id'];
		}else{	//add news
			return null;
		}
		// init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));//already defined in config.php

		// get data
		$data = $dataMag->getDataList( array(
			'from' => 'news',
			'target' => 'id='.$id));	//只取要的欄位
		// var_dump($data[0]);
		return $data[0];
	}
	public function saveData(){
		// init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));//already defined in config.php

		//== get data from front-end form
		$id 	 = $_POST['id'];
		$title 	 = $_POST['title'];
		$content = $_POST['content'];
		$img 	 = null;

		// ======== upload IMAGE ========== //
		// upload image file
		if(isset($_FILES['img'])){
			$img_name	    = $_FILES['img']['name'];		// get original file name
			$img_tempPath   = $_FILES['img']['tmp_name'];	// get tmp folder which oploaded file exists

			$target_rand 	 = time();						//generate random number for file name
			$target_fileEx   = strtolower(end(explode('.', $img_name)));	//附檔名
			//取得的檔名可能會是image/jpg或IMAGE/JPG str_to_lower轉換成小寫＆end只取最後一的part, 用.來分開
			$target_fileName = $target_rand.'.'.$target_fileEx;	//設定存檔檔名rand.jpg
			
			// create folders for 3 different size of images
			$folder_origin   = 'main/newsImg/';
			$folder_medium   = 'main/newsImg/medium/';
			$folder_thumb    = 'main/newsImg/thumb/';
			
			// set file path & name
			$img_path_origin = $folder_origin.$target_fileName;
			$img_path_medium = $folder_medium.$target_fileName;
			$img_path_thumb  = $folder_thumb.$target_fileName;

			// Check file type
			if ( $target_fileEx == 'jpg') {
				// copy temp file to target folder
				if ( move_uploaded_file( $img_tempPath, $img_path_origin ) ) {

					// db value 記錄存檔檔名在data base的img欄位
					$img = $target_fileName;

					// resizes
					$this->ImageResize( $img_path_origin, $img_path_medium, 360, 200, 100 );
					$this->ImageResize( $img_path_origin, $img_path_thumb,  72, 40, 100 );

					// === remove original file if there is one ===//
					// get origin file name from db
					$dbTemp = $dataMag->getDataList( array(
						'from' => 'work',
						'target' => 'id='.$id,
						'column' => 'img' ));

					// original file name: $oFileName
					$oFileName = $dbTemp[0]['img'];
					
					// remove original file if there is one
					if ( is_file($folder_origin.$oFileName) ) {	//incase it's a folder not a file
						unlink( $folder_origin.$oFileName );	//use 'unlink' to remove the file
					}
					if ( is_file($folder_medium.$oFileName) ) {
						unlink( $folder_medium.$oFileName );
					}
					if ( is_file($folder_thumb.$oFileName) ) {
						unlink( $folder_thumb.$oFileName );
					}

				} else {
					$this->errorMsg = 'File Upload Error:Has problem to move image file from tmp file.';
				}
			} else {
				$this->errorMsg = 'File Type Error. or No file uploaded.';
			}
		}// enf of if img file is set
		// setup data values
		$dataArray = array(
				'title' => $title,
				'content' => $content);

		if( $img ){
			$dataArray['img'] = $img;
		}

		$dataMag->updateData(
			array(
				'from' => 'news',
				'target' => 'id='.$id
			), 
			$dataArray
		);

		if ( $this->errorMsg == null ){
			header("Location: ../news");
		}else{
			echo $this->errorMsg;
		}
		//header("Location: ../news");

	}//end saveData

	public function addData(){
		// default value
		$title 	 = '';
		$content = '';
		$img 	 = null;

		// init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));

		// check post value
		if ( isset($_POST['title']) ) {
			$title = $_POST['title'];
		}
		if ( isset($_POST['content']) ) {
			$content = $_POST['content'];
		}

		// ======== upload IMAGE ========== //
		if(isset($_FILES['img'])){
			$img_name	    = $_FILES['img']['name'];		// get original file name
			$img_tempPath   = $_FILES['img']['tmp_name'];	// get tmp folder which oploaded file exists

			$target_rand 	 = time();						//generate random number for file name
			$target_fileEx   = strtolower(end(explode('.', $img_name)));	//附檔名
			//取得的檔名可能會是image/jpg或IMAGE/JPG str_to_lower轉換成小寫＆end只取最後一的part, 用.來分開
			$target_fileName = $target_rand.'.'.$target_fileEx;	//設定存檔檔名rand.jpg
			
			// create folders for 3 different size of images
			$folder_origin   = 'main/newsImg/';
			$folder_medium   = 'main/newsImg/medium/';
			$folder_thumb    = 'main/newsImg/thumb/';
			
			// set file path & name
			$img_path_origin = $folder_origin.$target_fileName;
			$img_path_medium = $folder_medium.$target_fileName;
			$img_path_thumb  = $folder_thumb.$target_fileName;

			// Check file type
			if ( $target_fileEx == 'jpg') {
				// copy temp file to target folder
				if ( move_uploaded_file( $img_tempPath, $img_path_origin ) ) {

					// db value 記錄存檔檔名在data base的img欄位
					$img = $target_fileName;

					// resizes
					$this->ImageResize( $img_path_origin, $img_path_medium, 360, 200, 100 );
					$this->ImageResize( $img_path_origin, $img_path_thumb,  72, 40, 100 );

				} else {
					$this->errorMsg = 'File Upload Error:Has problem to move image file from tmp file.';
				}
			} else {
				$this->errorMsg = 'File Type Error. or No file uploaded.';
			}
		}
		// Setup Data Values
		$dataArray = array(
				'title' 	=> $title,
				'content' 	=> $content);

		if ( $img ) {
			$dataArray['img'] = $img;
		}

		// add data by data manager
		$dataMag->addData(
			array(
				'to' => 'news'), 
			$dataArray
		);
		if ( $this->errorMsg == null ){
			header("Location: ../news");
		}else{
			echo $this->errorMsg;
		}
	}
	private function ImageResize($from_filename, $save_filename, $in_width=400, $in_height=300, $quality=100) {
	    $sub_name = $t = '';

	    // Get new dimensions
	    $img_info = getimagesize($from_filename);
	    $width    = $img_info['0'];
	    $height   = $img_info['1'];
	    $imgtype  = $img_info['2'];
	    $imgtag   = $img_info['3'];
	    $bits     = $img_info['bits'];
	    $channels = $img_info['channels'];
	    $mime     = $img_info['mime'];

	    list($t, $sub_name) = split('/', $mime);
	    if ($sub_name == 'jpg') {
	        $sub_name = 'jpeg';
	    }

	    // Ratio
	    $percent    = $this->getResizePercent($width, $height, $in_width, $in_height);
	    $new_width  = $width * $percent;
	    $new_height = $height * $percent;

	    // Resample
	    $image_new = imagecreatetruecolor( $in_width, $in_height );
	    $image = imagecreatefromjpeg( $from_filename );
		$offsetX = ($new_width - $in_width) / 2 * (-1);
		$offsetY = ($new_height - $in_height) / 2 * (-1);
			
	    imagecopyresampled( $image_new, $image, $offsetX, $offsetY, 0, 0, $new_width, $new_height, $width, $height );

	    return imagejpeg($image_new, $save_filename, $quality);
	}

	private function getResizePercent($source_w, $source_h, $inside_w, $inside_h) {
		$percent = 1;
		if ($source_w / $source_h > $inside_w / $inside_h) {
			// widther
			$percent = $inside_h / $source_h;
			
		} else {
			// higher
			$percent = $inside_w / $source_w;
		}
		return $percent;
		/*
	    if ($source_w < $inside_w && $source_h < $inside_h) {
	        return 1; // Percent = 1, 如果都比預計縮圖的小就不用縮
	    }

	    $w_percent = $inside_w / $source_w;
	    $h_percent = $inside_h / $source_h;

	    return ($w_percent > $h_percent) ? $h_percent : $w_percent;
	    */
	}
	public function uploadTempImage( $FILE ){
		// ======== upload IMAGE ========== //
		$img_name	    = $FILE['name'];		// get original file name
		$img_tempPath   = $FILE['tmp_name'];	// get tmp folder which oploaded file exists
		$target_fileEx   = strtolower(end(explode('.', $img_name)));	//附檔名
		$folder_temp   = 'temp/';
		// set file path & name
		$img_targetPath  = $folder_temp.$img_name;
		

		// Check file type
		if ( $target_fileEx == 'jpg') {
			// copy temp file to target folder
			if ( move_uploaded_file( $img_tempPath, $img_targetPath ) ) {
				return $img_targetPath;

			} else {
				//$this->errorMsg = 'File Upload Error:Has problem to move image file from tmp file.';
				return 'error_upload';
			}
		} else {
			//$this->errorMsg = 'File Type Error. or No file uploaded.';
			return 'error_filetype';
		}
	}
	
}

?>