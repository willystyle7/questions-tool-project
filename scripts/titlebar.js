function titlebar(val) {
    var msg = "Questions Tool";
    var speed = 1500;
    var pos = val;
    var msg1 = "?_" + msg + "...";
    var msg2 = "__" + msg + " ?";
    if (pos == 0) {
        masg = msg1;
        pos = 1;
    } else if (pos == 1) {
        masg = msg2;
        pos = 0;
    }
    document.title = masg;
    timer = window.setTimeout("titlebar(" + pos + ")", speed);
}
titlebar(0);