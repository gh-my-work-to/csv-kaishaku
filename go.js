$('#btn').click(function()
{
	// get
	var aryAry = makeCsvToAry($('#input').val().trim());
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
