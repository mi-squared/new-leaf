//This is the javascript that is used to assist with the diagPicker, the widget that lets us add DX's to
//a field on a form. If this file is alone in a form, it is most likely the only form in a project that uses it.
// Otherwise, it should be placed in a folder called "formAssets" and should be put in a folder in its own directory.



//Lets create an object that we can use with methods to make this code reusable

function DiagPicker(id, diagString, pid, func){

    //members:
    this.id = id;
    this.diagString = diagString;
    this.pid = pid;
    this.func = func;

    this.handleChange= function() {

    }


    DiagPicker.prototype.handleChange = function() {
        var self = this; // Save reference to the DiagPicker object

        $('#' + this.id).on('change', function() {
            self.diagString = $(this).val(); // Update the diagString property with the new value
            console.log("Diag String using method: " + self.diagString);
        });
    };



}

//We need to update the diag string.
function handleChange(id, diagString) {
    $('#' + id).on('change', function() {
        diagString = $(this).val(); // Update the diagString variable with the new value
        console.log("Diag String using function: " + diagString);
    });
}


function handleClick(id, pid) {
    $('#' + id).on('click', function(){
        $(this).trigger('change');
        $.ajax({
            type: "POST",
            url: "../../../library/classes/PrintoutHelper.class.php",
            data: {
                func: 'getIssues',
                pid: pid,
                id: id
            },
            success: function(result) {
                console.log(result);
                let URL = encodeURI("../../forms/intake/view_diagPicker.php?&string=" + result + "&diagString=" + diagString);
                dlgopen(URL, '_blank', 750, 600);
            },
            error: function(result) {
                alert('error');
            }
        });
    });
}



