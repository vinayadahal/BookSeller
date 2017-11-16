$(document).ready(function () {
    showOverView();//loadsOverView
//    showReview();
//    showBidding();
    console.log($("#overview").height());
    $("#review_count").html('(' + $("#review .reviewBox").length + ')');
    $("#bidding_count").html('(' + $("#bidding .reviewBox").length + ')');
});

function showOverView() {
    $("#overview").fadeIn(600);
    $("#review").hide();
    $("#bidding").hide();
}

function showReview() {
    $("#review").fadeIn(600);
    $("#overview").hide();
    $("#bidding").hide();
}

function showBidding() {
    $("#bidding").fadeIn(600);
    $("#review").hide();
    $("#overview").hide();
}

