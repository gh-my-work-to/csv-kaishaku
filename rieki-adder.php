<?php
$ME = $_SERVER['PHP_SELF'];
$mOutput = "";

$f_input = null;
$f_dlm = null;

if(isset($_POST['dlm']) == false || trim($_POST['dlm']) == null || trim($_POST['dlm']) == ',')
{
	$f_dlm = ',';
}
else
{
	$f_dlm = "\t";
}

if(isset($_POST['input']) == true)
{
	$f_input = trim($_POST['input']);
	include_once dirname(__FILE__) . '/./CsvKaishakuClass.php';
	$ck = new CsvKaishakuClass();
	$aryAry = $ck->getAryAry($f_input, $f_dlm);

	// output
	if(count($aryAry) > 0)
	{
		$aryAry = add_riekis($aryAry);
		
		for($i = 0; $i < count($aryAry); $i++)
		{
			$mOutput .= join($f_dlm, $aryAry[$i]) . "\n";
		}
	}
}
//-------
function get_safed($txt)
{
	return str_replace('<', '&lt;', 
				str_replace('>', '&gt;', 
					str_replace('&', '&amp;', $txt)));
}
function add_riekis($aryAry)
{
	$ret = array();
	for($i = 0; $i < count($aryAry); $i++)
	{
		$bry = $aryAry[$i];
		// 利益、利益率
		if($i == 0)
		{
			array_push($bry, '"利益"', '"利益率"');
		}
		else
		{
			$urn = $bry[8];
			$orn = $bry[6];
			
			$rieki = $urn - $orn;
			$ritsu = floor($rieki * 100 / $urn);
			
			array_push($bry, $rieki, $ritsu);
		}
		array_push($ret, $bry);
	}
	return $ret;
}
//---------------------------------------------------------------
echo <<< EOF
<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<title>moshimo-rieki-adder</title>
	<style>
	textarea{ width:90%; height:20em; white-space:pre; overflow:auto; }
	input:focus, textarea:focus, button:focus{ background-color:yellow; }
	
	td, th{ border-right:1px solid gray; border-bottom:1px solid gray; }
	tr.header{ background-color:rgba(222,222,222,0.5); }
	table{ table-layout:fixed; }
	</style>
</head>
<body>

<form action="$ME" method="post">
	input<br />
	<textarea name="input">$f_input</textarea>
	<br />
	
	dlm <input type="text" name="dlm" size="1" value="$f_dlm" />
	<input type="submit" value="go" />
</form>
	<hr />
output<br />
<textarea readonly >$mOutput</textarea>

</body>
</html>
EOF;
?>
