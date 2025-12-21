var searchSelected = false;

function setSearchFocus() {
    if(!searchSelected) {
        document.getElementById("web_search").value = "";
        searchSelected = true;
    }
}
