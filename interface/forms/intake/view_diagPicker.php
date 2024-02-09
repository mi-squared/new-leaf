<?php





require_once("../../globals.php");
require_once("$srcdir/sql.inc.php");

use OpenEMR\Core\Header;
$issues = json_decode($_GET['string']);
$title = $issues -> title;

$diag_string = explode('|', $_GET['diagString']);

?>

<head>

    <link rel="stylesheet" href="<?php echo $GLOBALS['css_header'];?>" type="text/css">
    <style>
        body{
            margin: 50px 50px 50px 50px;
        }


        input{
            grid-column: 1;
        }
        label {
            grid-column: 2/5;
        }
        form {
            padding-top:25px;
            display: grid;
            grid-template-columns: 15px repeat(5, 1fr);
            grid-gap: 15px;
        }

        .button-row{
            display: inline-grid;
            grid-template-columns: 50px 50px;
            grid-gap: 50px;
        }



    </style>
    <link rel="stylesheet" href="<?php echo $GLOBALS['webroot']; ?>/interface/main/messages/css/reminder_style.css?v=<?php echo $GLOBALS['v_js_includes']; ?>" type="text/css">
    <link rel="stylesheet"  href="<?php echo $GLOBALS['web_root']; ?>/library/css/bootstrap_navbar.css?v=<?php echo $GLOBALS['v_js_includes']; ?>" type="text/css">


    <?php Header::setupHeader(['opener', 'dialog', 'jquery', 'report-helper']); ?>
</head>
<body class="body_top" ' >
<h4 class="title"><?php echo $title ?></h4>
<form>
    <div></div>
    <div></div>
    <div class="three"></div><div class="four"></div><div class="five"></div><div class="six"></div>
    <?php if ($issues -> type == "problems") { ?>
        <?php foreach($issues as $index => $issue){
            if ($index == "id" || $index == "type" || $index == "title" )
                continue;
            ?>
            <div class="one"><input id="<?php echo $issue->diag ?>"  class="checkbox" type="checkbox"  value="<?php echo  $issue->diag ." " . $issue->title   ?>"  ></div>
            <div class="two"><label for ="<?php echo $issue->diag  ?>"><?php echo $issue->diag ." " . $issue->title  ?></label></div>
            <div class="three"></div><div class="four"></div><div class="five"></div><div class="six"></div>
        <?php } ?>
    <?php } else if ($issues -> type == "allergies") { ?>
        <?php foreach($issues as $index => $issue){
            if ($index == "id" || $index == "type" || $index == "title" )
                continue;
            ?>
            <div><input id="<?php echo $issue->title ?>"  class="checkbox" type="checkbox"  value="<?php echo " " . $issue->title   ?>"  ></div>
            <div><label for ="<?php echo $issue->title  ?>"><?php echo $issue->title  ?></label></div>
            <div class="three"></div><div class="four"></div><div class="five"></div><div class="six"></div>
        <?php }

    }  else if ($issues -> type == "speechIssues") { ?>

        <?php

        foreach ($issues as $index=> $issue){

            if ($index == "id" || $index == "type" || $index == "title" ||  $index == "encounter" ||  $index == "date" ) {
                continue;
            }
            ?>
            <div><input id="<?php echo $issue->field_id ?>"  class="checkbox" type="checkbox"  value="<?php echo " " . $issue->title   ?>"  ></div>
            <div><label for ="<?php echo $issue->field_id  ?>"><?php echo $issue->title  ?></label></div>
            <div class="three"></div><div class="four"></div><div class="five"></div><div class="six"></div>
        <?php }
    }else if ($issues -> type == "hearing") { ?>

        <?php

        foreach ($issues as $index => $issue){

            if ($index == "id" || $index == "type" || $index == "title" ) {
                continue;
            }
            ?>
            <div><input id="<?php echo $index ?>"  class="checkbox" type="checkbox"  value='<?php echo str_replace("_", " ", $index) .": " . $issue   ?>'  ></div>
            <div><label for ="<?php echo $index  ?>"><?php echo str_replace("_", " ", $index) .": " . $issue ?></label></div>
            <div class="three"></div><div class="four"></div><div class="five"></div><div class="six"></div>
        <?php }
    }

    ?>


    <div class="one"></div>
    <div class="two">
        <label for="text">Please include extra info here:</label>
        <input id = "extraInfo" type="text" name="extraInfo" size = "50">
    </div>
    <div class="three"></div><div class="four"></div><div class="five"></div> <div class="six"></div>

    <div class="one"></div><div class="two"></div>
    <div class="three"></div><div class="four"></div><div class="five"></div><div class="six"></div>

    <div class = "one" ></div>
    <div  class="two">
        <span class ="button-row">
        <span><button class="formbutton btn btn-primary" id="send_button" name="send_button">Save</button></span>
        <span><button class="formbutton btn btn-primary" id="cancel_button" name="cancel_button">Cancel</button></span>
        </span>
    </div>
    <div class="three"></div><div class="four"></div><div class="five"></div><div class="six"></div>
</form>
<?php echo ''; ?>
<script>

    $(document).ready(function() {
        var diagStringArray = <?php echo json_encode($diag_string); ?>;

        if (typeof diagStringArray === 'string') {
            diagStringArray = [diagStringArray]; // Convert to array if it's a single string value
        }

        $('input[type="checkbox"]').each(function() {
            var checkboxValue = $(this).val().trim();

            if (diagStringArray.some(function(item) {
                return item.trim() === checkboxValue;
            })) {
                $(this).prop('checked', true);
            }
        });




        $("#send_button").click(function(e) {
            e.preventDefault();
            console.log("send button presses");
            let event = new Event('change');
            let pid = "<?php  echo $_GET['pid']; ?>";
            let type = "<?php echo $issues->type; ?>"
            let id = "<?php  echo  $issues->id; ?>";
            console.log("The id is " + id);
            let boxes = document.getElementsByClassName('checkbox');
            let extraInfo = document.getElementById("extraInfo").value;
            console.log(extraInfo);
            let checked = [];
            for(let i=0; boxes[i]; ++i){
                if(boxes[i].checked){
                    checked.push(boxes[i].value);

                }
            }

            if(extraInfo.length > 0) {
                checked.push("  " + extraInfo);
            }
            let checkedStr = checked.join(' | ');

            if (window.opener != null && !window.opener.closed) {

                let txtName = window.opener.document.getElementById(id);
                txtName.value = checkedStr;
                txtName.dispatchEvent(event);
            }
            window.close();
        });

        $("#cancel_button").click(function(e){
            e.preventDefault();
            console.log("cancel button presses");
            window.close();


        });

    });

</script>
</body>



