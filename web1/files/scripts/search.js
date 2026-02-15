function onFocusSearchTextArea() {
    var search_ta = document.getElementById("web_search");
    
    if(search_ta.value === "Введите запрос для поиска в Интернете...") {
      search_ta.value = "";
    }
}