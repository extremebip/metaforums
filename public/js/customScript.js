function formArrayToObject(formArray) {
    var returnArray = {};
    for (var i = 0; i < formArray.length; i++) {
        returnArray[formArray[i]['name']] = formArray[i]['value'];
    }
    return returnArray;
}

function getErrorMessageFromResponse(response) {
    return response.responseJSON.errors;
}

function stringReplaceAll(str, mapObj) {
    var re = new RegExp(Object.keys(mapObj).join("|"), "gi");

    return str.replace(re, function (matched) {
        return mapObj[matched.toLowerCase()];
    });
}