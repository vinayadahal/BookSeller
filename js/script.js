$(document).ready(function () {

    showOverView();//loadsOverView
    console.log($("#overview").height());

//    console.log($("#container").width());

    $(window).resize(function () {
        console.log($("#footerWrap").width());
//        console.log($("#side_bar").width());
//        console.log($("#slider_wrap").width());
    });
//    alert("bla");
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

