//This is the javascript that is used to assist with the DiagPickerParent, the widget that lets us add DX's to
//a field on a form. If this file is alone in a form, it is most likely the only form in a project that uses it.
// Otherwise, it should be placed in a folder called "formAssets" and should be put in a folder in its own directory.



//
function DiagPickerParent(id, diagString, pid, func, formdir){


    //Members
    //this is the id  of the textfield we are clicking, populating, and getting info from
    this.id = id;

    //This is the contents of the string. i.e. Dx's
    this.diagString = diagString;

    //patient ID (this is self explaintory, but notes here for the N00Bs
    this.pid = pid;

    //This is the function call that we use in the ajax call.  This tells the PrintoutHelper which queries to run
    //In the case of Dx's we send it 'getIssues'
    this.func = func;

    //We need a form dir if we are going to make this re-usable
    this.formdir = formdir;

    //this is the listener that listens for the changes.
    //When the change happens we update the member diagString
    this.handleChange = function() {
        let self = this; // Save reference to the DiagPickerParent object
        console.log("handle Change!");
        $('#' + this.id).on('change', function() {
            self.diagString = $(this).val(); // Update the diagString property with the new value
            console.log("The ID to change is " + self.id + ". The new value is " + self.diagString);
        });
    };

    //This is the click listener.  We listen for a click, we trigger / dispatch a 'change'
    //save the info to the member diagString, and populate the DiagPickerParent.
    this.handleClick = function() {
        let self = this; // Capture the reference to 'this'
        console.log("Handle Click!");
        $('#' + this.id).on('click', function() {
            console.log("Made it into the handleClick Method");
            $(this).trigger('change');
            $.ajax({
                type: "POST",
                url: "../../../library/classes/PrintoutHelper.class.php",
                data: {
                    func: self.func, // Use 'self' instead of 'this'
                    pid: self.pid, // Use 'self' instead of 'this'
                    id: self.id // Use 'self' instead of 'this'
                },
                success: function(result) {
                    console.log(result);
                    let URL = encodeURI("../../forms/form_picker/view_diagPicker.php?&string=" + result + "&diagString=" + self.diagString + "&formdir=" + self.formdir);
                    dlgopen(URL, '_blank', 750, 600);
                },
                error: function(result) {
                    alert('error');
                }
            });
        });
    };

    //We initalize the DiagPickerParent.
    console.log("Inititalization of the DiagPickerParent");
    this.handleChange();
    this.handleClick();

}

function DiagPickerPopup(diagString, pid, title){

    //we are reading the array, a json object
    this.diagString = diagString;
    this.pid = pid;
    this.title = title;

    this.setTitle = function() {
        let self = this; // Save reference to the DiagPickerParent object
        $('#title').text(title);
    };


    this.setTitle();

}
