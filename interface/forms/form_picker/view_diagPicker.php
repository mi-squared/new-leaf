<?php





require_once("../../globals.php");
require_once("$srcdir/sql.inc.php");

use OpenEMR\Core\Header;
$issues = json_decode($_GET['string']);
$title = $issues -> title;

$diag_string = explode('|', $_GET['diagString']);
$form_folder = $_GET['formdir'];
$form_folder= " ../../forms/form_picker/formHelper.js"
?>

<head>

    <link rel="stylesheet" href="<?php echo $GLOBALS['css_header'];?>" type="text/css">
    <script src="<?php echo $form_folder; ?>"></script>
    <style>
        body {
            margin: 50px;
            background-color:#ece2e2;
        }

        form {
            padding-top: 25px;
            display: grid;
            grid-template-columns: 15px repeat(5, 1fr);
            grid-gap: 15px;
            border:thin ridge;
            padding: 1cm;

        }

        label {
            grid-column: 2/5;
        }

        .button-row {
            display: flex;
            justify-content: space-between;
            gap: 50px;
            margin-top: 10px;
        }

        .formbutton {
            padding: 5px 20px;
        }

        #outer-container{
            background-color: #068406;
            border:thin ridge;
            padding: 10px;
        }

        #inner-container{
            padding: 20px;
            background-color:#E0E3DC;

        }


    </style>
    <?php Header::setupHeader(['opener', 'dialog', 'jquery', 'report-helper']); ?>
</head>
<body class="body_top" ' >
<div id="outer-container">
    <div id="inner-container">
<div class="title" id="title"></div>
    <form>

        <div class="three"></div><div class="four"></div><div class="five"></div><div class="six"></div>

            <?php foreach($issues as $index => $issue){
                if ($index == "id" || $index == "type" || $index == "title" )
                    continue;
                ?>
                <div class="one"><input id="<?php echo $issue->diag ?>"  class="checkbox" type="checkbox"  value="<?php echo  $issue->diag ." " . $issue->title   ?>"  ></div>
                <div class="two"><label for ="<?php echo $issue->diag  ?>"><?php echo $issue->diag ." " . $issue->title  ?></label></div>
                <div class="three"></div><div class="four"></div><div class="five"></div><div class="six"></div>
            <?php } ?>



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
</div>
</div>
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

    let diagPickerPopup = new DiagPickerPopup("test", <?php echo $pid ?>, "Intake Form Diagnoses");
</script>
</body>



