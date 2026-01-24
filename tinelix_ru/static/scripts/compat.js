function isMSIESpecified(g_ver, l_ver) {
    var ua, fullVersion, endChar, verOffset;
    var majorVer = 0;
    
    if(isMSIE()) {
        ua = navigator.userAgent;
        verOffset = ua.indexOf("MSIE");
        fullVersion = ua.substring(verOffset+5);
        
        if ((endChar = fullVersion.indexOf(";")) != -1)
           fullVersion = fullVersion.substring(0, endChar);
        else if ((endChar = fullVersion.indexOf(" ")) != -1)
           fullVersion = fullVersion.substring(0, endChar);
        
        majorVer = parseInt(fullVersion.split(".")[0]);
        return majorVer <= l_ver && majorVer >= g_ver;
    } else {
        return false;
    }
}

function isMSIE() {
    return navigator.appName.match("Microsoft Internet Explorer") 
           && navigator.appVersion.match("MSIE");
}