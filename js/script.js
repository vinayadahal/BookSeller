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
