var c=0;
function hide()
{
    if(document.create.type.value == "0")
    {
        document.getElementById("years").style.display="none";
        document.getElementById("yearsPrompt").style.display="none";
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
    if(document.getElementsByName("type")[0].value == "-1")
    {
        err[count++] = "Department type";
    }
    if(document.getElementsByName("type")[0].value == "1" && document.getElementById("years").value.length == 0)
    {
        err[count++] = "Years";
    }

    var i = 1;
    while(i<=(c*2))
    {
        var textName;
        if(i%2!=0)
        {
            textName = "CR"+i;
        }
        else
        {
            textName = "room"+i;
        }

        if(document.getElementsByName(textName)[0].value.length==0)
        {
            if(i%2!=0)
            {
                err[count++] = "CR of Year "+i;

            }
            else
            {
                err[count++] = "Room number of Year "+i;
            }
        }
        i++;
    }
    if(document.getElementsByName("Password1")[0].value.length == 0 || (document.getElementsByName("Password1")[0].value != document.getElementsByName("Password")[0].value))
    {
        err[count++] = "Check Password";
    }
    if(isNaN(document.getElementById("years").value))
    {
        err[count++] = "Years has to be a numeric value";
    }
    if(document.getElementById("years").value>5||document.getElementById("years").value<1)
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
            while(i<=(c*2))
            {
                var t = "tr"+i;
                parent.removeChild(document.getElementById(t));
                i++;
            }
        }
        c=no;
        parent = document.getElementById("myTable");
        var i = 1;
        var yr = 1;
        while(i<=(c*2))
        {                    
            var prompt = "CRprompt"+i;
            var textName = "CR"+i;
            var x = "<td id=\""+prompt+"\"> Enter CR roll for Year "+yr+": </td>";
            x = x + "<td> <input type=\"text\" name=\""+textName+"\"/></td>";
            var newRow = document.createElement("tr");
            var t = "tr"+i;
            newRow.setAttribute('id',t);
            newRow.innerHTML = x;
            parent.appendChild(newRow);
            i++;

            prompt = "roomPrompt"+i;
            textName = "room"+i;
            x = "<td id=\""+prompt+"\"> Enter Room Number for Year "+yr+": </td>";
            x = x + "<td> <input type=\"text\" name=\""+textName+"\"/></td>";
            newRow = document.createElement("tr");
            t = "tr"+i;
            newRow.setAttribute('id',t);
            newRow.innerHTML = x;
            parent.appendChild(newRow);
            i++;
            yr++;
        }
    }
}