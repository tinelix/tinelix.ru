function getJSONfrom(url) {
    var http;
  
    if(isMSIESpecified(1, 6)) {
        http = new ActiveXObject('Microsoft.XMLHTTP');
    } else if(isMSIESpecified(7, 10)){
        http = new XMLHttpRequest();
    }
    
    http.onreadystatechange = function() { 
        if(http.readyState == 4)
            alert(http.status);
    }
    
    http.open("GET", url, false); // false for synchronous request
    http.send(null);
}

function onPageLoad() {
    var sitemap_link = document.getElementById("sitemap_link");

    if(isMSIESpecified(1, 8)) {
        sitemap_link.attachEvent('onclick', onSitemapLinkClick);
    } else {
        sitemap_link.addEventListener('click', onSitemapLinkClick);
    }
}

function onSitemapLinkClick() {
    getJSONfrom("http://192.168.0.22/test.json");
    /*document.body.insertAdjacentHTML("afterbegin", "" +
      "<TABLE>" +
        "<TR>" +
          "<TD>123" +
          "</TD>" +
        "</TR>" +
      "</TABLE>"
    );*/
}