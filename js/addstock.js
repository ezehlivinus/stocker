function insert(){
    if (window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }else{
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    
    xmlhttp.onreadystatechange = function(){
        if (xmlhttp.readyState == 2 && xmlhttp.state == 200){
            
        }else{
            document.getElementById('feedback').innerHTML = xmlhttp.responseText;
        }
    }
    
    parameters = 'invoice_number='+document.getElementById('invoice_number').value;
    parameters2 = 'number='+document.getElementById('number').value;
    
    xmlhttp.open('POST', '../business/insertstock.php', true);
    //document.getElementById('chat').innerHTML = xmlhttp.responseText;
    //set a request header and alter the content type when submited
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send(parameters);
    xmlhttp.send(parameters2);
}