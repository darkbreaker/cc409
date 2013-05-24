function crearTabla(objArray, dir) {
 
    // If the returned data is an object do nothing, else try to parse
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
 
    var str = '<table class="table-hover" id="jtable" name="jtable">';
 
    // table head
        str += '<thead><tr>';
        for (var index in array[0]) {
            str += '<th scope="col">' + index + '</th>';
        }
        str += '</tr></thead>';
    
 
    // table body
    str += '<tbody>';
    for (var i = 0; i < array.length; i++) {
        str += (i % 2 == 0) ? '<tr class="alt">' : '<tr>';
		var id=0;
        for (var index in array[i]) {
			if(id==0)
				str += '<td><a '+ "onmouseover=\"this.innerHTML = 'Click para reservar'\" onmouseout=\"this.innerHTML = '"+array[i][index] +"'\" "  + ' href="index.php?accion='+dir+array[i][index] +'">' + array[i][index] + '</a></td>';
			else
				str += '<td>' + array[i][index] + '</td>';
				id++;
        }
        str += '</tr>';
    }
    str += '</tbody>'
    str += '</table>';
    return str;
}

function crearCitas(objArray, dir) {
 
    // If the returned data is an object do nothing, else try to parse
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
 
    var str = '<table class="table-hover" id="jtable" name="jtable">';
 
    // table head
        str += '<thead><tr>';
        for (var index in array[0]) {
            str += '<th scope="col">' + index + '</th>';
        }
        str += '</tr></thead>';
    
 
    // table body
    str += '<tbody>';
    for (var i = 0; i < array.length; i++) {
        str += (i % 2 == 0) ? '<tr class="alt">' : '<tr>';
		var id=0;
        for (var index in array[i]) {
			if(id==0)
				str += '<td><a '+ "onmouseover=\"this.innerHTML = 'Click para reservar'\" onmouseout=\"this.innerHTML = '"+array[i][index] +"'\" "  + ' href="index.php?accion='+dir+array[i][index] +'">' + array[i][index] + '</a></td>';
			else
				str += '<td>' + array[i][index] + '</td>';
				id++;
        }
        str += '</tr>';
    }
    str += '</tbody>'
    str += '</table>';
    return str;
}
