$(document).ready(function () {
    showOverView();//loadsOverView
//    showReview();
//    showBidding();
//    console.log($("#overview").height());
    $("#review_count").html('(' + $("#review .reviewBox").length + ')');
    $("#bidding_count").html('(' + $("#bidding .reviewBox").length + ')');
    $('#dropDownCategory, #dropDownItemCategory').mouseover(function () {
        menuListOn();
    });
    $('#dropDownCategory, #dropDownItemCategory').mouseout(function () {
        menuListOff();
    });
});

function menuListOn() {
    $('#dropDownItemCategory').css({
        "display": "block"
    });
}

function menuListOff() {
    $('#dropDownItemCategory').css({
        "display": "none"
    });
}

function showOverView() {
    $("#overview").fadeIn(600);
    $("#review").hide();
    $("#bidding").hide();
    $("#description").hide();
}

function showReview() {
    $("#review").fadeIn(600);
    $("#overview").hide();
    $("#bidding").hide();
    $("#description").hide();
}

function showBidding() {
    $("#bidding").fadeIn(600);
    $("#review").hide();
    $("#overview").hide();
    $("#description").hide();
}

function showDescription() {
    $("#description").fadeIn(600);
    $("#review").hide();
    $("#overview").hide();
    $("#bidding").hide();
}

function loadMainPreview(id) {
    $("#image_main_preview img").attr("src", $(id).attr("src"));
}

function validate(idArray) {
    var count = idArray.length;
    for (var i = 0; i <= count; i++) {
        if (idArray[i] === 'title') {
            countChars();
        }
        if (checkNull(idArray[i])) {
            continue;
        } else {
            alert('Please fill every fields.');
            return false;
        }
    }
    return true;
}

function checkNull(idName) {
    var id = $("#" + idName).val();
    if (id === '') {
        return false;
    } else {
        return true;
    }
}

function showPopup() {
    $("#popup").fadeIn('slow');
    setInterval(function () {
        $("#popup").fadeOut('slow');
    }, 7000);
}