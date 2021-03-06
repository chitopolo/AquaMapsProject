
function queryTable(query, table, apiKey, responseFunction) {
	
	requestOptions = {
		async: true,
		url: queryUrl(query, table, apiKey),
	}
	
	if (typeof responseFunction == 'function') {
		requestOptions.success = responseFunction;
	}
	
	$.ajax(requestOptions);
}

function queryUrl(query, table, apiKey) {
	return "https://www.googleapis.com/fusiontables/v1/query?sql=" + checkQuery(query, table) + "&key=" + apiKey;
}

function checkQuery(query, table) {
	if (typeof query != 'undefined') {
		query = query.replace(" ", "+");
		query = query.replace("\"", "'");
		query = query.replace("TABLE", table);
	} else {
		query = '';
	}
	return query;
}

function parseJason(data) {
	if (typeof data != 'object') {	
		if (data != "") {
			try {
				return $.parseJSON(data);
			} catch (e) {
				return false;
			}
		} else {
			return false;
		}	
	} else {
		return data
	}
}

/* MT:
 * si la fila tiene más de 2 columnas, usar la 1ra y 2da como valor y nombre respectivamente
 * si la fila tiene una columna, se usa como valor y nombre
 * */
function populateSelect(data, elementSelector, emptyOption) {
	result = false;
	if (data != '') {
		$(elementSelector).empty();
		
		if (typeof emptyOption == "undefined") {
			emptyOption = "";
		}
		
		$(elementSelector).append('<option value="">' + emptyOption + '</option>');
		result = true;
	}
	
	if (data != null) {		
		$.each(data.rows, function(i, row) {
			if (row != '') {
				if (row.length > 1) {
					$(elementSelector).append('<option value="' + row[0] + '">' + row[1] + '</option>');				
				} else {
					$(elementSelector).append('<option value="' + row + '">' + row + '</option>');				
				}
			}		
		});
	}
	
	return result;
}

function editAnchor(event, element) {		
	event.preventDefault();
	var selectedHash = element.hash;
	var topDistance = 56;
	
	$("html,body").animate({scrollTop:$(selectedHash).offset().top - topDistance}, 1500);
}