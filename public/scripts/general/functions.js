function generalError(text){
    swal("Error!", text, "error")
    var snd = new Audio("../../assets/sound/error_sfx.wav"); // buffers automatically when created
	snd.play();
}

function generalSuccess(text){
	swal("Success!", text, "success")
    var snd = new Audio("../../assets/sound/success_sfx.wav"); // buffers automatically when created
	snd.play();
}

function playError(){
    var snd = new Audio("../../assets/sound/error_sfx.wav"); // buffers automatically when created
	snd.play();
}
function playSuccess(){
    var snd = new Audio("../../assets/sound/success_sfx.wav"); // buffers automatically when created
	snd.play();
}

function remove_duplicates(objectsArray) {
    var usedObjects = {};

    for (var i=objectsArray.length - 1;i>=0;i--) {
        var so = JSON.stringify(objectsArray[i]);

        if (usedObjects[so]) {
            objectsArray.splice(i, 1);

        } else {
            usedObjects[so] = true;
        }
    }

    return objectsArray;

}
