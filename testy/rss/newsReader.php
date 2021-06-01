<?php
/*
 +--------------------------------------------------+
 | Author: Allan Irvine  <ai@ayrsoft.com>           |
 +--------------------------------------------------+
 | Date: WED 03 MARCH 2004                          |
 +--------------------------------------------------+
 | Origin: Scotland, United kingdom                 |
 +--------------------------------------------------+
 | Script: newsReader.php                           |
 +--------------------------------------------------+
 | No License                                       |
 | free to use for personal and commercial purposes |
 +--------------------------------------------------+
*/

//+++++++++++++++++++++++++++++++++++++++++++++++++++
// CHANGES
//---------------------------------------------------
// Added a property $ampReplace, this is a quick fix
// it is used to replace ampersands bfore php get a hold of
// the rss file, and replace it once PHP has dealt with it
// I was getting lines split by an ampersand, pointed out by
// Mathew Clark of Divergent Systems, cheers.
// I will need to address this later on as I deem this fix
// as a bit of a kludge, not nice.
// Allan Irvine <airvine@ayrsoft.com>
// 29th April 2004
//----------------------------------------------------
//
//++++++++++++++++++++++++++++++++++++++++++++++++++++



class newsReader{

	var $content  =   array();
	var $openTag  =   array();
	var $closeTag =   array();
	var $currentTag;
	var $rss;
	var $level;
	var $startCollecting;
	var $wantedElements;
	var $cacheData;
	var $ampReplace;

	function newsReader(){
		$this->rss = xml_parser_create();
		xml_set_object($this->rss, $this);
		xml_parser_set_option($this->rss,XML_OPTION_CASE_FOLDING,1);
		xml_set_element_handler($this->rss,_startElement,_endElement);
		xml_set_character_data_handler($this->rss,_parseData);
		$this->wantedElements['CHANNEL']   =    array("TITLE","DESCRIPTION","LINK","IMAGES");
		$this->wantedElements['IMAGE']     =    array("URL");
		$this->wantedElements['ITEM']      =    array("TITLE","DESCRIPTION","LINK");
	}

	function _findLevel($n){
		if(eregi("(CHANNEL)|(IMAGE)|(ITEM)",$n,$regs)){
			$this->level = $regs[0];
		}
	}

	function _startToCollect($n){
		$this->startCollecting = (@in_array($n,$this->wantedElements[$this->level]))?1:0;
	}

	function _startElement($t,$name,$attribs){
		$this->currentTag = $name;
		$this->_findLevel($name);
		$this->_startToCollect($name);
		if($this->startCollecting){
			$this->openTag[]="<tr><td>\n";
		}
	}

	function _endElement($t,$name){
		if($this->startCollecting)
			$this->closeTag[]="</td></tr>\n";
	}

	function _parseData($t,$cData){
		$cData = str_replace($this->ampReplace,"&",$cData);// quick fix, will need to address later on
		if(strlen(trim($cData))&&($this->startCollecting)){
			if(eregi("link",$this->currentTag)){
				$this->content[]="<A HREF=\"".$cData."\" TARGET=\"_BLANK\">".$cData."</A>\n";
			}elseif(eregi("url",$this->currentTag)){
				$this->content[]="<IMG SRC=\"".$cData."\">\n";
			}else{
				$this->content[]=$cData;
			}
		}
	}

	function readNewsFeed($source){

		$this->_readCacheData();
		if($this->_useCache($source)){
			$this->_writeCacheEntry($source);
			$file = file("newsCache/".md5($source));
		}else{
			$file = file($source);
		}
			$file = implode("\n",$file);
			$this->ampReplace = md5(time());// quick fix, will need to address later on
			$file = str_replace("&",$this->ampReplace,$file);// quick fix, will need to address later on

			if(!xml_parse($this->rss,$file,1)){
				$ln =  xml_get_current_line_number($this->rss);
      			$msg =  xml_error_string(xml_get_error_code($this->rss));
      			return  ("An XML error occurred on line $ln: $msg");
			}else{
				$rtn = "<TABLE border=0>\n";
				for($i=0;$i<count($this->openTag);$i++){
					$rtn.= $this->openTag[$i].$this->content[$i].$this->closeTag[$i];
				}
				$rtn.="</TABLE>\n";

				if(!$this->_useCache($source)){
					$this->_writeCacheEntry($source);
				}

				return $rtn;

			}
	}


	function _checkCacheDir(){
		if(!is_dir("newsCache")){
			mkdir("newsCache");
		}
	}

	function _readCacheData(){
		$file = file("newsCache/newsReaderCache.php");
		if(strlen(trim($file[0]))){
			$this->cacheData = unserialize($file[0]);
		}
	}

	function _useCache($source){
		if($key = array_search($source,$this->cacheData)){
			$sec = explode(" ",$key);
			if((time() - $sec[1])>(3600)){
				return 0;
			}else{
				return 1;
			}
		}else{
			return 0;
		}
	}

	function _writeCacheEntry($source){
		$this->_checkCacheDir();
		$this->_updateCacheArray($source);
		$fp = fopen("newsCache/newsReaderCache.php","w");
		fwrite($fp,serialize($this->cacheData));
		fclose($fp);

		$data = file($source);
		$data = implode("\n",$data);
		$fp = fopen("newsCache/".md5($source),"w");
		fwrite($fp,$data);
		fclose($fp);

	}

	function _updateCacheArray($source){

		if(is_array($this->cacheData) && in_array($source,$this->cacheData)){
			foreach($this->cacheData as $key=>$val){
				if(trim($val) == trim($source)){
					$key =microtime();
				}
				$new[$key]= $val;
			}
			$this->cacheData = $new;
		}else{
			$this->cacheData[microtime()] = $source;
		}
	}

}

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// test data below once you are happy how it works just remove this stuff
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// bbc news stories

$newsSources['BBC']['Widzew']="http://widzewlodz.pl/rss.xml";
$newsSources['BBC']['uk']="http://news.bbc.co.uk/rss/newsonline_uk_edition/uk/rss091.xml";
$newsSources['BBC']['england']="http://news.bbc.co.uk/rss/newsonline_uk_edition/england/rss091.xml";
$newsSources['BBC']['norther ireland']="http://news.bbc.co.uk/rss/newsonline_uk_edition/northern_ireland/rss091.xml";
$newsSources['BBC']['scotland']="http://news.bbc.co.uk/rss/newsonline_uk_edition/scotland/rss091.xml";
$newsSources['BBC']['wales']="http://news.bbc.co.uk/rss/newsonline_uk_edition/wales/rss091.xml";
$newsSources['BBC']['business']="http://news.bbc.co.uk/rss/newsonline_uk_edition/business/rss091.xml";
$newsSources['BBC']['uk politics']="http://news.bbc.co.uk/rss/newsonline_uk_edition/uk_politics/rss091.xml";
$newsSources['BBC']['health']="http://news.bbc.co.uk/rss/newsonline_uk_edition/health/rss091.xml";
$newsSources['BBC']['education']="http://news.bbc.co.uk/rss/newsonline_uk_edition/education/rss091.xml";
$newsSources['BBC']['science technology']="http://news.bbc.co.uk/rss/newsonline_uk_edition/sci/tech/rss091.xml";
$newsSources['BBC']['technology']="http://news.bbc.co.uk/rss/newsonline_uk_edition/technology/rss091.xml";
$newsSources['BBC']['entertainment']="http://news.bbc.co.uk/rss/newsonline_uk_edition/entertainment/rss091.xml";
$newsSources['BBC']['talking point']="http://news.bbc.co.uk/rss/newsonline_uk_edition/talking_point/rss091.xml";
$newsSources['BBC']['magazine']="http://news.bbc.co.uk/rss/newsonline_uk_edition/magazine/rss091.xml";
$newsSources['BBC']['week at a glance']="http://news.bbc.co.uk/rss/newsonline_uk_edition/week_at-a-glance/rss091.xml";
$newsSources['BBC']['programmes']="http://news.bbc.co.uk/rss/newsonline_uk_edition/programmes/rss091.xml";
?>
<style type=text/css><!--
td {
	font-family:arial,verdana,tahoma;
	font-size:12px;
	background-color:#f0f0f0;
	color:red;
}
--></style>
<?php


foreach($newsSources as $name=>$array){
echo 'aaaaa';
	echo $name;
	echo "<form method=post action=".$_SERVER['PHP_SELF'].">\n";
	echo "<select name=source>\n";
	foreach($array as $key=>$val){
		$sel = ($val == $source)? " SELECTED " : "";
		echo "<option $sel value=$val>$key\n";
	}
	echo "</select>\n";
	echo "<input type=submit name=go value=Go>\n";
	echo "</form>\n";
}

//++++++++++++++++
// script usage  |
//++++++++++++++++
#$source = "http://www.newscientist.com/syndication/news.rdf";
#$go = 1;
if($go){
	$feed = new newsReader;
	echo $feed->readNewsFeed($source);
}









?>
