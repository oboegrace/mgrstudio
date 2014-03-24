<?php

abstract class DataManager {
	
	public function __construct() {

	}
	// $r = $dataMag->getDataList( array(
	// 			'from' => 'product_coffee',
	// 			'sortBy' => 'price:LARGE,id:SMALL'
	// 		));
	// return: 
	// array(
	// 	[0] = {'column', 'value', ...},
	// 	[1] = {'column1', 'value1', ...},
	// 	...
	// )
	abstract public function getDataList( array $attrs  );

	// $dataMag->updateData( 
	//	 array(
	// 		'from' => 'product_coffee',
	// 		'target' => 'id=19'),
	//	 array(
	// 		'name' => 'test',
	// 		'price' => '999'
	// 	));
	abstract public function updateData( array $attrs, array $data );

	// $dataMag->addData( 
	// 	array('to' => 'product_coffee'),
	// 	array(
	// 		'name' => 'test',
	// 		'price' => '999'
	// 	));
	// return: true/false;
	abstract public function addData( array $attrs, array $data  );

	// $dataMag->deleteData( array(
	// 	'from' => 'product_coffee',
	// 	'target' => 'id=33'));

	abstract public function addMultiData( array $attrs, array $datas );

	abstract public function search( array $attrs );

	abstract public function deleteData( array $attrs );

	abstract public function getDataCount( array $attrs );

	abstract public function getLastId();
}