<html>
    <head>
        <title>Category</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://malsup.github.com/jquery.form.js"></script> 
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>  
        <script type="text/javascript" src="./js/main.js"></script>
        <link rel="stylesheet" href="./css/style.css"/>
    </head>
    <body>
        <br/>
        <h2>Item List</h2>
        <div id="ajax_list">
        <table class="list_table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Category</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
	            <tr id="list_tr">
                    <td> </td>
                    <td> </td>
                    <td> </td>
                </tr>
            </tbody>
        </table>
        </div>
        <br />

        <h3>Add / Modify</h3>
        <form id="category_form" name="category_form" method="POST" >
            <input type="hidden" id="cmd" name="cmd" value="add"/><!-- add/mod/del -->
            <input type="hidden" id="id" name="id" value=""/>
            <table class="input_table">
            	<tr>
            		<td>Item: </td><td><input type="text" id="category" name="category" required /> <input type="submit" id="submit" value="Submit" /></td><td>
            	</tr>
            </table>
        </form>

    </body>
</html>