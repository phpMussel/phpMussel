
function $(c,i,d,r,a,m){if('POST'===c||'GET'===c){var x=new XMLHttpRequest;x.onreadystatechange=function(){null!==r&&3==this.readyState&&200==this.status&&r(x.responseText),null!==a&&4==this.readyState&&200==this.status&&a(x.responseText),null!==m&&4==this.readyState&&200!==this.status&&m(x.responseText)},'POST'===c?x.open('POST',i,!0):x.open('GET',i,!0),x.responseType='text',null===d?x.send():(fd=new FormData,d.forEach(function(c){fd.append(c,null===window[c]?1:window[c])}),fd.append('ASYNC',1),x.send(fd))}}
function showid(e){b=document.getElementById(e),b.style.display='inline'}function hideid(e){b=document.getElementById(e),b.style.display='none'}
function show(e){b=document.getElementsByClassName(e);for(var s=0;s<b.length;s++)b[s].style.display="inline"}function hide(e){b=document.getElementsByClassName(e);for(var s=0;s<b.length;s++)b[s].style.display="none"}
function r(e){return document.getElementById(e).innerHTML}function w(e,x){document.getElementById(e).innerHTML=x}
