function deleteItem(id) {
    $("#cmd").val("del");
    $("#id").val(id);
    console.log(id);
    var ajaxOptions = {
                    type: 'POST',
                    data: {},
                    url: './applyAjax.php?action=del-category',
                    error: function(jqXHR, textStatus, errorThrown) {
                        //console.log('Error: ' + errorThrown);
                        //console.log('jqXHR: ' + jqXHR);
                        //console.log('textStatus: ' + textStatus);
                        alert("An error has occured");
                    },
                    success: function(returned, status, xhr) {
                        loadCategory(returned);
                        //console.log(returned);
                    }
                };
    $('#category_form').ajaxSubmit(ajaxOptions);
    $("#id").val("");

}

function modifyItem(id, value) {
    $("#cmd").val("mod");
    $("#id").val(id);
    $("#category").val(value);
}

function loadCategory(result){
    if(result != '') {
                    var jsondata = JSON.parse(result);
                    //console.log(data);
                    
                    var htmlList, html;
                    htmlList = '<table>';
                    htmlList += '<thead>';
                    htmlList += '<tr><th>ID</th><th>Item</th><th></th></tr>';
                    htmlList += ' </thead><tbody>';

                    $.each(jsondata.rows, function(index, item) {

                        html = '<tr id="list_tr">';
                        html += '<td>' + item.category_id + '</td>';
                        html += '<td>' + item.category + '</td>';
                        html += '<td><a href="javascript:modifyItem(\'' + item.category_id + '\',\'' + item.category + '\')"><input type="button" value="Modify"></a>';
                        html += '    <a href="javascript:deleteItem(\'' + item.category_id + '\')"><input type="button" value="Delete"></a></td>';
                        html += '</tr>';

                        htmlList += html;
                    });
                    htmlList += '</tbody></table>';
                    //console.log(htmlList);

                    $('#ajax_list').html(htmlList);

                }
}

$(function() {
        // form population
        $.ajax({
            type: 'POST',
            data: {},
            url: './applyAjax.php?action=get-category',
            success: function(result){
                loadCategory(result);
            }
        });

        var validator = $('#category_form').validate({
            rules: { 
               },
               messages: {
               },
            ignore: '.ignore-this',
            submitHandler: function(form) {
                var ajaxOptions = {
                    type: 'POST',
                    data: {},
                    url: './applyAjax.php?action=submit-category',
                    error: function(jqXHR, textStatus, errorThrown) {
                        //console.log('Error: ' + errorThrown);
                        //console.log('jqXHR: ' + jqXHR);
                        //console.log('textStatus: ' + textStatus);
                        alert("An error has occured");
                    },
                    success: function(returned, status, xhr) {
                        loadCategory(returned);
                        //console.log(returned);
                    }
                };
                $(form).ajaxSubmit(ajaxOptions);
                $("#id").val("");
                $("#category").val("");
        }
    
    });
});
