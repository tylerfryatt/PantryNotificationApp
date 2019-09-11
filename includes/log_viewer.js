/*

Autor: Stanislav Vysotskiy
Description: Handling events and data pagination.
Version: 06082019

*/

var JSONdata;
var itemsPerPage = 1;
var tableId = "#paginate";
var currentPage = 1;

/*

Receives JSON from get_JSON.php
Setting up variable JSONdata

*/

function getJSON() {
	return JSONdata;
}
function getData() {
	
    from_date = $('#from_date').val();
    to_date = $('#to_date').val();

    if (from_date != '' && to_date != '') {
        $.ajax({
            url: "./includes/actions/get_JSON.php",
            method: "POST",
            data: {from_date: from_date, to_date: to_date},
            success: function (data) {
                JSONdata = JSON.parse(data);
                
				itemsPerPage = parseInt($("#showNumber").children("option:selected").val());
			return JSONdata;
			console.log("test");
            }
            
        });

    } else {
        
        alert("Please specify \"From\" and \"To\" dates!");
        
    }

}

/*

Removing record from LOG table based on record_id

*/

function deleteRecord(rId) {   

    $.ajax({
            url: "./includes/actions/removeRecordHandler.php",
            method: "POST",
            data: {record_id: rId},
            success: getData
        })
}

/*

Makes page navigation based on JSONdata and items per page

*/

function page_nav(data, itemsPerPage) {
	
    $("nav#paginate_nav ul").empty();
    var rowCount = data.length;
    var pageSize = itemsPerPage;
    var pageCount = Math.ceil(rowCount/pageSize);
	

    for (i = 1; i <= pageCount; i++) { 
        
        $("nav#paginate_nav ul").append('<li class="page-item"><a class="page-link" href="#" id="' + i + '">' + i + '</a></li>');

    }
}

/*

Displays page of rows based on JSONdata, items per page and page number.

*/

function drawRows(data, itemsPerPage, pageNum) {

    $( tableId + " tbody").empty();

    var rowCount = data.length;
    var firstRow = 0 + (pageNum - 1)*itemsPerPage
    var lastRow = (rowCount < firstRow + itemsPerPage) ? rowCount :firstRow + itemsPerPage;
	

    for (i = firstRow; i < lastRow; i++) { 
		
		var message = data[i].message.replace(/\n/g,"<br>");

        $(tableId).append('<tr><th scope="row" class="d-none d-sm-table-cell">'+ data[i].record_id +'</th><td class="d-none d-sm-table-cell">' + data[i].name + ' (' + data[i].username + ')</td>' +
		'<td>'+ data[i].date + ' <b>'+ data[i].time +'</b></td>' + 
		'<td>' + data[i].sent_count + '</td>' + 
		'<td><div class="btn-group" role="group">' +
		
		// Modal Buttons
		'<button type="button" class="btn btn btn-info" data-toggle="modal" data-target="#id_' + data[i].record_id + '">View</button>' +
		'<button type="button" class="btn btn btn-danger" data-toggle="modal" data-target="#id_' + data[i].record_id + '_delete">Delete</button></div>' +
		
			// View modal
			'<div class="modal fade" id="id_'+ data[i].record_id +'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
						'<div class="modal-dialog" role="document">' +
							'<div class="modal-content">' +
								'<div class="modal-header">' +
									'<h5 class="modal-title" id="exampleModalLabel">By: ' + data[i].name + ' (' + data[i].username + ')</h5>' +
									'<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
										'<span aria-hidden="true">&times;</span>' +
									'</button>' +
								'</div>' +
								'<div class="modal-body">' +
								message +
								'</div>' +
								'<div class="modal-footer">' +
									'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close' +
									'</button>' +
								'</div>' +
							'</div>' +
						'</div>' +
					'</div>' + 



		// Delete modal
		'<div class="modal fade" id="id_'+ data[i].record_id +'_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
		'<div class="modal-dialog" role="document">' +
			'<div class="modal-content">' +
				'<div class="modal-header">' +
					'<h5 class="modal-title" id="exampleModalLabel">Delete?</h5>' +
					'<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
						'<span aria-hidden="true">&times;</span>' +
					'</button>' +
				'</div>' +
				'<div class="modal-body">' +
					'Do you want to delete this record?' +
				'</div>' +
				'<div class="modal-footer">' +
					'<button type="button" class="btn btn btn-danger delete" data-dismiss="modal" id="'+data[i].record_id+'">Delete</button>' +
					'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>' +
				'</div>' +
			'</div>' +
		'</div>' +
	'</div>' + 
		
		'</td></tr>');
        

    }
	
	page_nav(data, itemsPerPage);
	setActivePage(pageNum);
}

/*

Sets active page number on page navigation
@param pageNumber page number to set active

*/

function setActivePage(pageNumber) {
	
	currentPage = pageNumber
	
	$("nav ul li").removeClass("active"); 
	$("#" + pageNumber).parent().addClass("active") 
	
}

// LISTENERS

/*

Triggered on page load

*/


$( document ).ready(function() {
    
	getData();
	
	
});

/*

Triggered on "view" button click event

*/

$(document).on("click", "#view",function() {
	setActivePage(1);
    getData();
});

/*

Triggered when delete button clicked

*/

$(document).on("click", ".delete",function() {
			
			
		deleteRecord(event.target.id);
		getData();
		
		//handling modal fade...

		$(".modal-backdrop").remove();
});

/*
 
Triggered when page navigation element clicked

*/

$(document).on("click", ".page-link",function() {
    
    var pageNumber = event.target.id;
    
    drawRows(JSONdata,itemsPerPage,pageNumber);
	console.log(itemsPerPage,pageNumber);
});

/*

Pagenav click even

*/

$(document).on("change", "#showNumber",function() {
    
	itemsPerPage = parseInt($(this).children("option:selected").val());
	
	drawRows(JSONdata,itemsPerPage,1);

 
});

$( document ).ajaxComplete(function() {
	console.log('ajaxComplete event!');
	drawRows(JSONdata,itemsPerPage,currentPage);
});




