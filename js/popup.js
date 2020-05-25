$(document).ready(function(){   
    PopUpHide();
    SuccessPopUpHide();
});

function PopUpShow(){
    $("#popup1").show();
}

function PopUpHide(){
    $("#popup1").hide();
    SuccessPopUpShow();
}