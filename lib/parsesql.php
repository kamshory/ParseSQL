<?php
function ParseSQL($sql_text) 
{
	$arr = explode("\n", $sql_text);
	foreach($arr as $key=>$val)
	{
		$arr[$key] = trim($val, "\r");
	}

	$append = 0;
	$skip = 0;
	$start = 1;
	$nquery = -1;
	$delimiter = ";";
	$query_array = array();
	$delimiter_array = array();
	
	foreach($arr as $line=>$text)
	{
		if($text == "")
		{
			continue;
		}
		if($append == 0)
		{
			if(stripos(ltrim($text, " \t "), "--") === 0)
			{
				$skip = 1;
				$nquery++;
				$start = 1;
				$append = 0;
			}
			else
			{
				$skip = 0;
			}
		}
		if($skip == 0)
		{
			if($start == 1)
			{
				$nquery++;
				$query_array[$nquery] = "";
				$start = 0;
			}
			$query_array[$nquery] .= $text."\r\n";
			$delimiter_array[$nquery] = $delimiter;
			$text = ltrim($text, " \t ");
			$start = strlen($text)-strlen($delimiter)-1;
			if(stripos(substr($text, $start), $delimiter) !== false)
			{
				$nquery++;
				$start = 1;
				$append = 0;
			}
			else
			{
				$start = 0;
				$append = 1;
			}
			
			if(stripos($text, "delimiter ") !== false)
			{
				$text = trim(preg_replace("/\s+/"," ",$text));
				$arr2 = explode(" ", $text);
				$delimiter = $arr2[1];
				$delimiter_array[$nquery] = $delimiter;
				$nquery++;
				$start = 1;
				$append = 0;
			}
			
		}
		
	}
	$result = array();
	foreach($query_array as $line=>$sql)
	{
		$delimiter = $delimiter_array[$line];
		if(stripos($sql, "delimiter ") !== false)
		{
			
		}
		else
		{
			if($delimiter != ";")
			{
				
				$sql = trim($sql, " \r\n\t ");
				$sql = substr($sql, 0, strlen($sql)-strlen($delimiter));
			}
			$result[] = array("query"=> $sql, "delimiter"=>$delimiter);
		}
	}
	
	return $result;
}
?>