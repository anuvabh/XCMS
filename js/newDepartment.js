var c=0;
function hide()
{
    if(document.create.type.value == "0")
    {
        document.getElementById("years").style.display="none";
        document.getElementById("yearsPrompt").style.display="none";
        if(c!=0)
        {
            parent = document.getElementById("myTable");
            var i = 1;
            while(i<=c)
            {
                var t = "tr"+i;
                parent.removeChild(document.getElementById(t));
                i++;
            }
            c=0;
        }
    }
    else
    {
        document.getElementById("years").style.display="block";
        document.getElementById("yearsPrompt").style.display="block";
    }
}
function validate()
{
    var err = new Array();
    var count = 0; 
    if(document.getElementsByName("dname")[0].value.length==0)
    {
        err[count++] = "Department Name";
    }
    if(document.getElementsByName("dcode")[0].value.length==0)
    {
        err[count++] = "Department Code";
    }
    if(document.getElementsByName("Email")[0].value.length==0)
    {
        err[count++] = "Email";
    }
    else
    {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        var address = document.getElementsByName("Email")[0].value;
        //var address = document.forms[form1].elements[Email].value
        if(reg.test(address) == false) 
        { 
            err[count++] = "Enter correct Email Address";
        }
    }
    if(document.getElementsByName("type")[0].value == "-1")
    {
        err[count++] = "Department type";
    }
    if(document.getElementsByName("type")[0].value == "1" && document.getElementById("years").value.length == 0)
    {
        err[count++] = "Years";
    }


    var yr = 1;
    while(yr<=c)
    {
        var textName;

        textName = "room"+yr;

        if(document.getElementsByName(textName)[0].value.length==0)
        {
            err[count++] = "Room number of Year "+yr;

        }
        yr++;

    }
    if(document.getElementsByName("Password1")[0].value.length == 0 || (document.getElementsByName("Password1")[0].value != document.getElementsByName("Password")[0].value))
    {
        err[count++] = "Check Password";
    }
    if(isNaN(document.getElementById("years").value))
    {
        err[count++] = "Years has to be a numeric value";
    }
    if(document.getElementsByName("type")[0].value==1 && (document.getElementById("years").value>5||document.getElementById("years").value<1))
    {
        err[count++] = "Years should be in the range 1-5";
    }
    if(count==0)
    {
        document.forms[0].submit();
    }
    else
    {
        var disp = "Enter the following:\n";
        for(var i=0; i<count;i++)
        {
            disp = disp  + err[i] + "\n";
        }
        alert(disp);
    }

}
function newDeptYear()
{
    var no = document.getElementById("years").value;
    if(no>5 || no<1)
    {
        alert("Years have to be in the range 1-5");
    }
    else
    {
        if(c!=0)
        {
            parent = document.getElementById("myTable");
            var i = 1;
            while(i<=c)
            {
                var t = "tr"+i;
                parent.removeChild(document.getElementById(t));
                i++;
            }
        }
        c=no;
        parent = document.getElementById("myTable");

        var yr = 1;
        while(yr<=c)
        {                    

            prompt = "roomPrompt"+yr;
            textName = "room"+yr;
            x = "<td id=\""+prompt+"\"> Enter Room Number for Year "+yr+": </td>";
            x = x + "<td> <input type=\"text\" name=\""+textName+"\"/></td>";
            newRow = document.createElement("tr");
            t = "tr"+yr;
            newRow.setAttribute('id',t);
            newRow.innerHTML = x;
            parent.appendChild(newRow);

            yr++;
        }
    }
}