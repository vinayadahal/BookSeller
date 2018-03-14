$(document).ready(function () {
    var container_height = $("#container").height();
    setFooter(container_height);

    $("#img").change(function () {
        var filesize = this.files[0].size;
        if (filesize >= 2097152) {
            alert('File size should be less than 2 MB.');
            this.value = '';
        } else {
            showImg(this);
        }
    });
});

function setFooter(container_height) {
    if (container_height < 500) {
        $(".footerWrap").css({position: "fixed"});
    } else {
        $(".footerWrap").css({position: "relative"});
    }
}

function showImg(img) {
    if (img.files && img.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imgLocation').attr('src', e.target.result);
        },
                reader.readAsDataURL(img.files[0]);
    }
}
