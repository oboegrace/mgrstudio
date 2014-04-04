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
		// 把陣列全部用','串起來，輸出成一個字串
		// 再塞進去data內回傳
		$tags = $this->getWorkTagArray( $dataMag, $id );

		$data[0]['tags'] = implode(',', $tags);

		return $data[0];

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

		// init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));//already defined in config.php

		$id 	 	 = $_POST['id'];
		$title 	 	 = $_POST['title'];
		$title_cn 	 = $_POST['title_cn'];
		$description = $_POST['description'];
		$vimeo_id	 = $_POST['vimeo_id'];
		$youtube_id	 = $_POST['youtube_id'];
		$tags 		 = $_POST['tags'];
		$img         = null;

		// upload image file
		$img_name	    = $_FILES['img']['name'];		// origin file name
		$img_tempPath   = $_FILES['img']['tmp_name'];	// tmp folder which oploaded file exists

		$target_rand 	 = time();
		$target_fileEx   = strtolower(end(explode('.', $img_name)));
		$target_fileName = $target_rand.'.'.$target_fileEx;
		$folder_origin   = 'main/workImg/';
		$folder_medium   = 'main/workImg/medium/';
		$folder_thumb    = 'main/workImg/thumb/';
		$img_path_origin = $folder_origin.$target_fileName;
		$img_path_medium = $folder_medium.$target_fileName;
		$img_path_thumb  = $folder_thumb.$target_fileName;

		// Check file type
		if ( $target_fileEx == 'jpg' ) {
			// copy temp file to target folder
			if ( move_uploaded_file( $img_tempPath, $img_path_origin ) ) {

				// db value
				$img = $target_fileName;

				// resizes
				$this->ImageResize( $img_path_origin, $img_path_medium, 360, 200, 100 );
				$this->ImageResize( $img_path_origin, $img_path_thumb,  72, 40, 100 );

				// remove
				// get origin file name from db
				$dbTemp = $dataMag->getDataList( array(
					'from' => 'work',
					'target' => 'id='.$id,
					'column' => 'img' ));

				$oFileName = $dbTemp[0]['img'];
				
				if ( is_file($folder_origin.$oFileName) ) {
					unlink( $folder_origin.$oFileName );
				}
				if ( is_file($folder_medium.$oFileName) ) {
					unlink( $folder_medium.$oFileName );
				}
				if ( is_file($folder_thumb.$oFileName) ) {
					unlink( $folder_thumb.$oFileName );
				}

			} else {
				$this->errorMsg = 'File Upload Error.';
			}
		} else {
			$this->errorMsg = 'File Type Error.';
		}




		// Setup Data Values
		$dataArray = array(
				'title' 	=> $title,
				'title_cn' 	=> $title_cn, 
				'description' => $description,
				'vimeo_id'	=> $vimeo_id,
				'youtube_id'=> $youtube_id );

		if ( $img ) {
			$dataArray['img'] = $img;
		}
		
		
		// DB
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
		

		/*if ( $this->errorMsg == null )
			header("Location: ../works");*/
	}
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

		// init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));

		$dataMag->addData(
			array(
				'to' => 'work'), 
			array(
				'title' 	=> $title,
				'title_cn' 	=> $title_cn, 
				'description' => $description,
				'vimeo_id'	=> $vimeo_id,
				'youtube_id'=> $youtube_id
			)
		);
		header("Location: ../works");
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
}



?>