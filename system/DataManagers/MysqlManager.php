<?php

require_once( 'system/DataManager.php' );

//implement dataManager for MySQL
class MysqlManager extends DataManager {
	
	private $dbhost  = '';
	private $dbuser  = '';
	private $dbpass  = '';
	private $dbname  = '';
	private $dbtable = '';

	private $idColumn = 'id';
	private $lastId = 0;

	/*
	__construct ( $attrs )
	$attrs = {
		'host' => '',
		'user' => '',
		'pass' => '',
		'name' => ''
	}
	*/
	public function __construct( array $attrs ) {
		// Check attrs
		if( isset( $attrs['host'] ) )
			$this->dbhost = $attrs['host'];
		if( isset( $attrs['user'] ) )
			$this->dbuser = $attrs['user'];
		if( isset( $attrs['pass'] ) )
			$this->dbpass = $attrs['pass'];
		if( isset( $attrs['name'] ) )
			$this->dbname = $attrs['name'];
	}
	/*
	getDataList ( $attrs )
	$attrs = {
		'from' => 'product',
		'target' => 'price<800,price>500',!!!
		'sortBy' => 'price:LARGE,id:SMALL',
		('query' => 'SELECT * FROM test WHERE price < 500' )  !!! (overall)
	}

	return: 
	array(
		[0] = {'column', 'value', ...},
		[1] = {'column1', 'value1', ...},
		...
	)
	*/
	public function getDataList( array $attrs  ) {

		// Check attr (from):table
		if( isset( $attrs['from'] ) )
			$this->dbtable = $attrs['from'];

		// Check attr (column)
		$column = '*';
		if( isset( $attrs['column'] ) )
			$column = $attrs['column'];

		// Check attr (target):where
		$where = '';
		if( isset( $attrs['target'] ) ) {
			$tem = explode( '&', $attrs['target'] );
			$n = 0;
			$where .= " WHERE ";
			for ( $i=0; $i<count($tem); $i++ ) {
				$vtemp = explode( '=', $tem[$i]);
				$wcolumn = $vtemp[0];
				$values = $vtemp[1];

				if ( $n != 0 ) {
					$where .= ' AND ';
				}
				$n++;

				// check = multi data
				if ( count(explode(',', $values)) > 1 ) {
					$where .= " `".$wcolumn."` IN (".$values.")";
				} else {
					$where .= " `".$wcolumn."` = ".$values;
				}
			}
		}

		// Check attr (sortBy):order by
		$sort = '';
		if( isset( $attrs['sortBy'] ) ) {
			$stemp = explode( ',', $attrs['sortBy'] );
			$sort = " ORDER BY ";

			for ( $i = 0, $len = count($stemp); $i < $len ; $i++ ) { 
				
				$pos = strrpos( $stemp[$i], ':' );
				if ( $pos === false ) {
					$sort .= $stemp[$i];
				} else {
					$temp = explode( ':', $stemp[$i] );
					if ( $temp[1] == 'SMALL' )
						$sort .= $temp[0]." ASC";
					else if ( $temp[1] == 'LARGE' )
						$sort .= $temp[0]." DESC";
					else
						$sort .= $temp[0];
				}

				if ( $i < $len -1 )
					$sort .= ',';
			}
		}

		// Check attrs (limit)
		$limit = '';
		if( isset( $attrs['limit'] ) ) {
			$limit = ' LIMIT '.$attrs['limit'];
		}

		// Check attrs (query)
		if( isset( $attrs['query'] ) ) {
			// Custom SQL
			$sql = $attrs['query'];
		} else {
			// SQL
			$sql = "SELECT ".$column." FROM `".$this->dbtable."`".$where.$sort.$limit;
		}
		//echo $sql;

		// PDO
		try {
			$pdo = new PDO( 'mysql:host='.$this->dbhost.';dbname='.$this->dbname.';charset=utf8', $this->dbuser, $this->dbpass );
		} catch (PDOException $e) {
			//echo 'Connection failed: ' . $e->getMessage();
    		return false;
		}
		$pdo->query( 'set names utf8;' ); 
		$rs = $pdo->query( $sql );
		if ( !$rs ) {
			//echo 'No data (DataMag.getDataList)';
			return null;
		}
		$result = $rs->fetchAll( PDO::FETCH_ASSOC );

		// htmlentitle (for safe)
		for ( $i=0; $i<count($result); $i++) {
			foreach ( $result[$i] as $key => $value ) {
				if ( is_string( $value ) ) {
					$result[$i][$key] = htmlentities( $value, ENT_NOQUOTES, 'UTF-8' );
				}
			}
		}
		$pdo = null;

		//htmlentities( , ENT_NOQUOTES, 'UTF-8' );

		return $result;
	}
	public function getDataAssoList( array $attrs, $match, $value ) {

		$attrs['column'] = '`'.$match.'`,`'.$value.'`';
		$temp = $this->getDataList( $attrs );

		$r = array();
		for ( $i=0; $i < count($temp) ; $i++) { 
			$m = $temp[$i][$match];
			$v = $temp[$i][$value];
			$r[$m] = $v;
		}
		return $r;
	}
	/*
	$dataMag->updateData( 
		array(
			'from' => $this->category,
			'target' => 'id='.$id ),
		array(
			'title' => $value )
	);
	*/
	public function updateData( array $attrs, array $data ) {

		// Check attr (from)
		if( isset( $attrs['from'] ) )
			$this->dbtable = $attrs['from'];

		// Check attr (target):where
		$where = " WHERE";
		if( isset( $attrs['target'] ) ) {
			$vtemp = explode( '=', $attrs['target']);
			$column = $vtemp[0];
			$values = $vtemp[1];
			
			$where.= " ".$column." IN (".$values.")";
		}

		// Check attr (update)
		$columnString = '';
		$columnDatas = array();
		$len = count($data);
		$n = 0;
		foreach ( $data as $key => $value ) {
			
			array_push( $columnDatas, $value );
			$columnString .= '`'.$key.'`=?';
			
			if ( $n < $len-1) {
				$columnString .= ',';
			}
			$n++;
		}
		

		// SQL
		$sql = "UPDATE ".$this->dbtable.' SET '.$columnString.$where;
		//echo $sql;

		// PDO
		try {
			$pdo = new PDO( 'mysql:host='.$this->dbhost.';dbname='.$this->dbname.';charset=utf8', $this->dbuser, $this->dbpass );
			$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
			$pdo->query( 'set names utf8;' ); 
			$sth = $pdo->prepare( $sql );
			$r = $sth->execute( $columnDatas );
			return $r;
		} catch ( PDOException $e ) {  
		    echo $e->getMessage();  
		    return false;
		}  
	}
	/*
	$dataMag->addData( 
		array('to' => 'product_coffee'),
		array(
			'name' => 'test',
			'price' => '999'
		));
	*/
	public function addData( array $attrs, array $data ) {

		// Check attr (to)
		if( isset( $attrs['to'] ) )
			$this->dbtable = $attrs['to'];

		// Data
		$columns = '(';
		$valueNames = '(';
		$valueArray = array(); // new value array (index add : to front )
		$i = 0;
		$len = count( $data );
		foreach ( $data as $key => $value ) {
			//$value = str_replace("'", "\'", $value);
			$columns .= "`".$key."`";
			$valueNames .= ":".$key;
			$valueArray[ ":".$key ] = $value;

			if ( $i < $len -1 ) {
				$columns .= ',';
				$valueNames .= ',';
			}
			$i++;
		}
		$columns .= ')';
		$valueNames  .= ')';

		// SQL
		$sql = "INSERT INTO `".$this->dbtable."` ".$columns." VALUES ".$valueNames;

		// PDO
		try {
			$pdo = new PDO( 'mysql:host='.$this->dbhost.';dbname='.$this->dbname.';charset=utf8', $this->dbuser, $this->dbpass );
			$pdo->query( 'set names utf8;' ); 
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sth = $pdo->prepare( $sql );
			$r = $sth->execute( $valueArray );
			$this->lastId = $pdo->lastInsertId( $this->idColumn );
			$pdo = null;
			return $r;
		} catch ( PDOException $e ) {  
		    echo $e->getMessage();  
		    return false;
		}  
		
	}
	public function addMultiData( array $attrs, array $datas ) {

		// Check attr (to)
		if( isset( $attrs['to'] ) )
			$this->dbtable = $attrs['to'];

		// Check datas exist
		if ( count($datas) < 0 ) {
			return false;
		}

		// Columns (use the first data)
		$firstData = reset( $datas );
		$columns = '(';
		$clen = count($firstData);
		$c = 0;
		foreach ( $firstData as $key => $value ) {
			$columns .= "`".$key."`";
			if ( $c < $clen -1 ) {
				$columns .= ',';
			}
			$c++;
		}
		$columns .= ')';

		// Datas
		$valueArray = array(); // new value array (index add : to front )
		$valueNames = '';
		$dlen = count($datas);
		for ( $i=0; $i < $dlen; $i++ ) {
			
			$valueNames .= '(';
			$len = count( $datas[$i] );
			$n = 0;

			foreach ( $datas[$i] as $key => $value ) {

				//$value = str_replace("'", "\'", $value);
				$valueNames .= ":_".$i."_".$key;
				$valueArray[ ":_".$i."_".$key ] = $value;

				if ( $n < $len -1 ) {
					$valueNames .= ',';
				}
				$n++;
			}
			
			$valueNames  .= ')';
			if ( $i < $dlen -1 ) {
				$valueNames  .= ',';
			}
		}


		// SQL
		$sql = "INSERT INTO `".$this->dbtable."` ".$columns." VALUES ".$valueNames;

		//echo $sql;
		//echo var_dump($valueArray);
		//exit();

		// PDO
		
		try {
			$pdo = new PDO( 'mysql:host='.$this->dbhost.';dbname='.$this->dbname.';charset=utf8', $this->dbuser, $this->dbpass );
			$pdo->query( 'set names utf8;' ); 
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sth = $pdo->prepare( $sql );
			$r = $sth->execute( $valueArray );
			$this->lastId = $pdo->lastInsertId( $this->idColumn );
			$pdo = null;
			return $r;
		} catch ( PDOException $e ) {  
		    echo $e->getMessage();  
		    return false;
		}
	}
	/*
	$dataMag->deleteData( array(
		'from' => 'product_coffee',
		'target' => 'id=33'));
	*/
	public function deleteData( array $attrs ) {

		// Check attr (from)
		if( isset( $attrs['from'] ) )
			$this->dbtable = $attrs['from'];

		// Check attr (target):where
		$where = " WHERE";
		if( isset( $attrs['target'] ) ) {
			$vtemp = explode( '=', $attrs['target']);
			$column = $vtemp[0];
			$values = $vtemp[1];
			
			$where.= " ".$column." IN (".$values.")";
		}

		// Sql
		$sql = "DELETE FROM ".$this->dbtable.$where;

		// PDO
		try {
			$pdo = new PDO( 'mysql:host='.$this->dbhost.';dbname='.$this->dbname.';charset=utf8', $this->dbuser, $this->dbpass );
			$pdo->query( 'set names utf8;' ); 
			$sth = $pdo->prepare( $sql );
			$r = $sth->execute();
			return $r;
		} catch ( PDOException $e ) {  
		    echo $e->getMessage();  
		    return false;
		}  
	}

	public function search( array $attrs ) {

		// Check attr (from)
		if( isset( $attrs['from'] ) )
			$this->dbtable = $attrs['from'];

		$columns  = $attrs['columns'];
		$keywords = $attrs['keywords'];

		$sql = "SELECT * FROM `".$this->dbtable."` WHERE MATCH($columns) AGAINST ('".$keywords."' IN BOOLEAN MODE)";
		//echo $sql;

		try {
			$pdo = new PDO( 'mysql:host='.$this->dbhost.';dbname='.$this->dbname.';charset=utf8', $this->dbuser, $this->dbpass );
			$pdo->query( 'set names utf8;' ); 
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sth = $pdo->prepare( $sql );
			$sth->execute();
			$result = $sth->fetchAll( PDO::FETCH_ASSOC );
			return $result;

		} catch ( PDOException $e ) {  
		    echo $e->getMessage();  
		}
	}

	public function getDataCount( array $attrs ) {
		// Check attr (from)
		if( isset( $attrs['from'] ) )
			$this->dbtable = $attrs['from'];

		if( isset( $attrs['target'] ) ) {
			$where = str_replace( "&", " AND ", $attrs['target'] );
			$sql = 'SELECT count(*) FROM `'.$this->dbtable.'` WHERE '.$where;
		} else {
			$sql = 'SELECT count(*) FROM '.$this->dbtable;
		}

		

		// PDO
		try {
			$pdo = new PDO( 'mysql:host='.$this->dbhost.';dbname='.$this->dbname.';charset=utf8', $this->dbuser, $this->dbpass );
			$pdo->query( 'set names utf8;' ); 
			$sth = $pdo->prepare( $sql );
			$sth->execute();
			return (int)$sth->fetchColumn();

		} catch ( PDOException $e ) {  
		    return false;
		}  
	}


	public function getLastId() {
		return $this->lastId;
	}
}

?>