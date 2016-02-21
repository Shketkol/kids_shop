/**
 * Created by Nick on 17.02.2016.
 */
$(document).ready(function(){
    $("#category").change(function(){
        var categoryval = parseInt(("#category").val());
        selectType(categoryval);
    });
});

function selectType(categoryval){
    var type = $("#type");

    if (categoryval <= 0) {
    } else {
        type.load(
            "/admin/tovary/index",
            {categoryval: categoryval}
        );
    }
}
