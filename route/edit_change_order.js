function orderUp (){
    if (element.previousElementSibling)
        element.parentNode.insertBefore(element, element.previousElementSibling);

}

function orderDown (){
    if (element.nextElementSibling)
        element.parentNode.insertBefore(element.nextElementSibling, element);
}