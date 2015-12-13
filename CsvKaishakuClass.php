<?php
class CsvKaishakuClass
{
	function getAryAry($txt, $dlm = ',')
	{
		$ary = explode ( "\r\n", $txt );
		$aryAry = array ();
		for($i = 0; $i < count ( $ary ); $i ++)
		{
			if ($ary [$i] == null)
			{
				continue;
			}
			$bufAry = array ();
			$bry = explode ( $dlm, $ary [$i] );
			
			for($b = 0; $b < count ( $bry ); $b ++)
			{
				$cel = $bry [$b];
				if (substr ( $cel, 0, 1 ) == '"' && substr ( $cel, - 1, 1 ) != '"')
				{
					// またがっている
					while ( $b <= count ( $bry ) - 2 )
					{
						$cel_next = $bry [++ $b];
						$cel .= $dlm . $cel_next;
						if (substr ( $cel_next, - 1, 1 ) == '"')
						{
							break;
						}
					}
				}
				array_push ( $bufAry, $cel );
			}
			array_push ( $aryAry, $bufAry );
		}
		return $aryAry;
	}
}
?>
