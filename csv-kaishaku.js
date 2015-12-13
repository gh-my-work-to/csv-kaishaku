$('#btn').click(function()
{
	var ary = $('#input').val().trim().split("\n");
	var aryAry = [];
	for(var i = 0; i < ary.length; i++)
	{
		var bufAry = [];
		var bry = ary[i].split(",");
		for(var b = 0; b < bry.length; b++)
		{
			var cel = bry[b];
			
			if(cel.substr(0, 1) == '"' && cel.substr(cel.length - 1, 1) != '"')
			{
				// またがっている
				while(b <= bry.length - 2)
				{
					var cel_next = bry[++b];
					cel += ',' + cel_next;
					if(cel_next.substr(-1, 1) == '"')
					{
						break;
					}
				}
				bufAry.push(cel);
			}
			else
			{
				bufAry.push(cel);
			}
		}
		aryAry.push(bufAry);
	}
	
	// output
	var buf = "<table>\n";
	for(var i = 0; i < aryAry.length; i++)
	{
		var line = (i == 0) ? '<tr class="header">' : "<tr>";
		var tag = (i == 0) ? 'th' : 'td';
		
		var bry = aryAry[i];
		for(var b = 0; b < bry.length; b++)
		{
			line += '<' + tag + '>' + bry[b] + '</' + tag + '>';
		}
		buf += line + "</tr>\n";
	}
	$('#output').html(buf + "</table>\n");
});
