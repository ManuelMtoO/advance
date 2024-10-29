<?php 
//@session_start( );	//error_reporting(0);
//print_r("888".CIA);
class Db{
	var $user="";
	var $pass="";
	var $host="localhost";
	var $database="";
	var $con="";
	var $tab="";
	var $source='//192.168.1.236/IHDATDB/ian/a3/';	//"T:/ian/a3/";

	function connect(){
		if(CIA == 'eyh'){
			$this->source = '//192.168.1.238/EYHDATDB/ian/a3/';
		}
		if(is_dir($this->source)){
			$conn = new COM("ADODB.Connection");		//"Provider=vfpoledb.1;Data Source=T:\ian\a3\st300\Notas.dbc;Collating Sequence=MACHINE"
			$xpath = "Provider=vfpoledb.1;Data Source=".$this->source.";Exclusive=NO;BackGroundFetch=NO;NULL=NO;Mode=ReadWrite|Share Deny None;Collating Sequence=SPANISH";
			$conn->Open($xpath);
			$this->con = $conn;
			$xreturn = true;
		}else{
			$xreturn = null;
		}
		return $xreturn;
	}
	
	function disconnect(){
		$res->Close();
	} 
	
	function exe_sql($xsql,$xpar=null){
		$xarray = null;
		if($this->connect()){
			$res = $this->con->Execute($xsql);
			if($res != null){
				if($xpar == 1){	//	insert
					$xarray = true;
				}else if($xpar == 2){	//	update
				
				}else if($xpar == 3){	//	delete
					
				}else if($xpar == 4){	//	select
					$ncol = $res->Fields->Count();
					$i=0;
					while(!$res->EOF){//echo $ncol.'</br>';
						for($x=0;$x<$ncol;$x++){
							/*if($x==0)$reg = $res->fields[0];if($x==1)$reg = $res->fields[1];if($x==2)$reg = $res->fields[2];if($x==3)$reg = $res->fields[3];if($x==4)$reg = $res->fields[4];
							if($x==5)$reg = $res->fields[5];if($x==6)$reg = $res->fields[6];if($x==7)$reg = $res->fields[7];if($x==8)$reg = $res->fields[8];if($x==9)$reg = $res->fields[9];
							if($x==10)$reg = $res->fields[10];if($x==11)$reg = $res->fields[11];if($x==12)$reg = $res->fields[12];if($x==13)$reg = $res->fields[13];if($x==14)$reg = $res->fields[14];
							if($x==15)$reg = $res->fields[15];if($x==16)$reg = $res->fields[16];if($x==17)$reg = $res->fields[17];if($x==18)$reg = $res->fields[18];if($x==19)$reg = $res->fields[19];
							if($x==20)$reg = $res->fields[20];if($x=='21')$reg = $res->fields[21];if($x==22)$reg = $res->fields[22];if($x==23)$reg = $res->fields[23];if($x==24)$reg = $res->fields[24];
							if($x==25)$reg = $res->fields[25];if($x==26)$reg = $res->fields[26];if($x==27)$reg = $res->fields[27];if($x==28)$reg = $res->fields[28];if($x==29)$reg = $res->fields[29];
							*/
							$reg = $res->fields[$x];
							$k = $reg->name;
							$v = $reg->value;
							//$v = rtrim($reg->value);
							//$v=str_replace(' ', '', $v); 
							//print_r($v);die; 
							$xarray[$i][$k] = mb_convert_encoding($v, "UTF-8", "ISO-8859-1");
						}
						$i++;
						$res->MoveNext();
					}//echo '<pre>';PRINT_R($array);echo '</pre>';
				}
			}
		}else{
			echo '</br></br>NoConnDB';
		}
		//$res->close();
		$this->con->Close();
		$res = null;
		$this->con = null;
		//$this->disconnect();
		//echo '<pre>';PRINT_R($array);echo '</pre>';
		return $xarray;
	}
}
?>
