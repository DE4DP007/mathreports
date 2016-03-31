function equalizeHeights(siblingsClass, containerId) {
    //whether class name starts with dot
    if  (siblingsClass[0] != ".") {siblingsClass = "."+siblingsClass; }
    //whether container defined
    if (containerId === undefined) {
        var choser = siblingsClass;
    } else {
        //whether container name starts with #
        if  (containerId[0] != "#") {siblingsClass = "#"+containerId; }
        var choser = containerId+" "+siblingsClass;
    }
    var heights = $(choser).map(function() {
            return $(this).height();
        }).get(),

        maxHeight = Math.max.apply(null, heights);
    $(choser).height(maxHeight);
    return 0;
}