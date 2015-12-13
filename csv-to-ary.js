function makeCsvToAry(txt, dlm)
{
	var ary = txt.split("\n");
	var aryAry = [];
	for(var i = 0; i < ary.length; i++)
	{
		var bufAry = [];
		var bry = ary[i].split(dlm);
		for(var b = 0; b < bry.length; b++)
		{
			var cel = bry[b];
			if(cel.substr(0, 1) == '"' && !(cel.substr(-1, 1) == '"' && !cel.match(/[^"]""$/)))
			{
				// またがっている
				while(b <= bry.length - 2)
				{
					var cel_next = bry[++b];
					cel += dlm + cel_next;
					if(cel_next.substr(-1, 1) == '"' && !cel_next.match(/[^"]""$/))
					{
						break;
					}
				}
			}
			bufAry.push(cel);
		}
		aryAry.push(bufAry);
	}
	return aryAry;
}
