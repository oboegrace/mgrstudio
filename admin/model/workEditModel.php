<?php 

include_once( 'admin/model/adminModel.php' );
include_once( 'system/DataManagers/MysqlManager.php' );

class workEditModel extends adminModel {

	private $errorMsg = null;

	public function getWorkData() {

		// get id from url
		$id = 0 ; // 因為index 不會 = 0
		if (isset($_GET['id'])){
			$id = $_GET['id'];
		}else{	//add work
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
			'from' => 'work',
			'target' => 'id='.$id));	//只取要的欄位
		// var_dump($data[0]);

		// // get tag
		// $tags_tmp = $dataMag->getDataList( array(
		// 	'from' => 'work_tag',
		// 	'target' => 'work_id='.$id,
		// 	'column' => 'tag'));	//只取要的欄位
		// // 回傳的資料 idealy 會是下面這樣
		// // [1]['tag'] = 'asus';
		// // [2]['tag'] = 'mv';

		// $tags = array();
		// for ( $i=0 ; $i< count($tags_tmp); $i++){
		// 	array_push($tags, $tags_tmp[$i]['tag']);
		// 	// 把$tag_tmp[i]['tag']轉存到 $tags[i]
		// }
		// 
		// 再塞進去data內回傳
		// ======== get tag data ========== //
		$tags = $this->getWorkTagArray( $dataMag, $id );
		// implode --- 將陣列的元素用','串起來，輸出成一個字串
		$data[0]['tags'] = implode(',', $tags);

		return $data[0];

	}
	public function getTagList(){
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));

		$temp = $dataMag->getDataList( array(
			'from' => 'work_tag',
			'query' => 'SELECT DISTINCT tag FROM work_tag',
			));
		// 過濾空字串
		$result = array();
		foreach ($temp as $item){
			$tag = $item["tag"];
			if (trim($tag) != ""){
				array_push( $result, $tag );
			}
		}

		return $result;

	}
	private function getWorkTagArray( $dataMag, $id ){
		// get tag
		$tags_tmp = $dataMag->getDataList( array(
			'from' => 'work_tag',
			'target' => 'work_id='.$id,
			'column' => 'tag'));	//只取要的欄位
		// 回傳的資料 idealy 會是下面這樣
		// [1]['tag'] = 'asus';
		// [2]['tag'] = 'mv';

		$tags = array();
		for ( $i=0 ; $i< count($tags_tmp); $i++){
			array_push($tags, $tags_tmp[$i]['tag']);
			// 把$tag_tmp[i]['tag']轉存到 $tags[i]
		}
		return $tags;
	}
	public function saveData(){

		//== init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));//already defined in config.php

		//== get data from front-end form
		$id 	 	 = $_POST['id'];
		$title 	 	 = $_POST['title'];
		$title_cn 	 = $_POST['title_cn'];
		$description = $_POST['description'];
		$vimeo_id	 = $_POST['vimeo_id'];
		$youtube_id	 = $_POST['youtube_id'];
		$tags 		 = $_POST['tags'];
		$seq		 = $_POST['seq'];
		$img         = null;

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
			$folder_origin   = 'main/workImg/';
			$folder_medium   = 'main/workImg/medium/';
			$folder_thumb    = 'main/workImg/thumb/';
			
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
		}
		// Setup Data Values
		$dataArray = array(
				'title' 	=> $title,
				'title_cn' 	=> $title_cn, 
				'description' => $description,
				'vimeo_id'	=> $vimeo_id,
				'youtube_id'=> $youtube_id,
				'seq' 		=> $seq );

		if ( $img ) {
			$dataArray['img'] = $img;
		}
		
		// DB manager call updateData function
		$dataMag->updateData(
			array(
				'from' => 'work',
				'target' => 'id='.$id
			), 
			$dataArray
		);

		// ======== TAG ======= //
		
		// remove & untag
		// 需要tag欄位的id
		/*
		$dataMag->deleteData( array(
			'from' => 'product_coffee',
			'target' => 'id=33'));
		*/
		// DELETE FROM `work_tag` WHERE work_id = aa AND tag = XXXX
		// remove 所有原來的
		
		$dataMag->deleteData(array(
			"from" 	=> "work_tag",
			"target" => "work_id=".$id
			) 
		);
		// 一樣的，不動
		// 少的，remove
		// $tags_remove = array();
		// 多的 addData
		// $tags_add = array();

		// 取得原本的 tag array
		// $exist_Tags = $this->getWorkTagArray( $dataMag, $id );
		// 做出欲save的 tag array


		// for ($i = 0 ; $i < count($tagArray); $i++){
		// 	if (!in_array($tagArray[$i], $exist_Tags)){
		// 		// 多的 addData
		// 		array_push($tags_add,$tagArray[$i]);
		// 	}
		// }
		// for ($i = 0 ; $i < count($exist_Tags); $i++){
		// 	if (!in_array($exist_Tags[$i], $tagArray)){
		// 		// 多的 addData
		// 		array_push($tags_remove,$exist_Tags[$i]);
		// 	}
		// }
		/*
		要把 tag_Add 做成下面這樣
		array(
			array(
				'work_id' => $id,
				'tag' => $tag),
			),
			array(
				'work_id' => $id, 
				'tag' => $tag),
			)
		)*/
		$tagArray = explode(',', $tags);
		$addArray = array();
		for ($i = 0 ; $i < count($tagArray); $i++){
			array_push($addArray, array('work_id'=>$id, 'tag'=> trim($tagArray[$i])));
		}

		if (count($addArray)){
			$dataMag->addMultiData(
				array('to' => 'work_tag'), 
				$addArray
			);
		}
		

		if ( $this->errorMsg == null ){
			header("Location: ../works");
		}else{
			echo $this->errorMsg;
		}
	}//end saveData
	public function getErrorMsg() {
		return $this->errorMsg;
	}
	public function addData(){
		
		// default value
		$title 			= '';
		$title_cn 		= '';
		$description 	= '';
		$vimeo_id 		= '';
		$youtube_id 	= '';
		$seq			= '';

		// check post value
		if ( isset($_POST['title']) ) {
			$title = $_POST['title'];
		}
		if ( isset($_POST['title_cn']) ) {
			$title_cn = $_POST['title_cn'];
		}
		if ( isset($_POST['description']) ) {
			$description = $_POST['description'];
		}
		if ( isset($_POST['vimeo_id']) ) {
			$vimeo_id = $_POST['vimeo_id'];
		}
		if ( isset($_POST['youtube_id']) ) {
			$youtube_id = $_POST['youtube_id'];
		}
		if ( isset($_POST['seq']) ){
			$seq = $_POST['seq'];
		}
		// ======== upload IMAGE ========== //
		if( isset($_FILES['img']) ){
			$img_name	    = $_FILES['img']['name'];		// get original file name
			$img_tempPath   = $_FILES['img']['tmp_name'];	// get tmp folder which oploaded file exists

			$target_rand 	 = time();						//generate random number for file name
			$target_fileEx   = strtolower(end(explode('.', $img_name)));	//附檔名
			//取得的檔名可能會是image/jpg或IMAGE/JPG str_to_lower轉換成小寫＆end只取最後一的part, 用.來分開
			$target_fileName = $target_rand.'.'.$target_fileEx;	//設定存檔檔名rand.jpg
			
			// create folders for 3 different size of images
			$folder_origin   = 'main/workImg/';
			$folder_medium   = 'main/workImg/medium/';
			$folder_thumb    = 'main/workImg/thumb/';
			
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
		// Setup Data Values
		$dataArray = array(
				'title' 	=> $title,
				'title_cn' 	=> $title_cn, 
				'description' => $description,
				'vimeo_id'	=> $vimeo_id,
				'youtube_id'=> $youtube_id,
				'seq' 		=> $seq );

		if ( $img ) {
			$dataArray['img'] = $img;
		}

		// init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));

		$dataMag->addData(
			array(
				'to' => 'work'), 
			$dataArray
		);

		// return to works list or send error message
		if ( $this->errorMsg == null ){
			header("Location: ../works");
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
			// wider
			$percent = $inside_h / $source_h;
			
		} else {
			// higher
			$percent = $inside_w / $source_w;
		}
		return $percent;
	}

	public function uploadTempImage( $FILE ){
		// ======== upload IMAGE for PREVIEW========== //
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