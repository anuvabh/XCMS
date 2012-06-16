var i=1;
            var roleCount = <?php if(isset($roles)) echo count($roles); else echo "0";?>;
            var rc = roleCount;
            function validate()
            {
                var f = 1, err="";
                dd = parseInt(document.getElementsByName("dd")[0].value);
                mm = parseInt(document.getElementsByName("mm")[0].value);
                yy = parseInt(document.getElementsByName("yy")[0].value);
                dd1 = parseInt(document.getElementsByName("dd1")[0].value);
                mm1 = parseInt(document.getElementsByName("mm1")[0].value);
                yy1 = parseInt(document.getElementsByName("yy1")[0].value);
                
                //var chk = (document.getElementsByName("eName")[0].value.length)*(document.getElementsByName("dd")[0].value.length)*(document.getElementsByName("mm")[0].value.length)*(document.getElementsByName("yy")[0].value.length)*(document.getElementsByName("dd1")[0].value.length)*(document.getElementsByName("mm1")[0].value.length)*(document.getElementsByName("yy1")[0].value.length);
                if(document.getElementsByName("eName")[0].value.length==0)
                {
                    f = 0;
                    err += "Please enter the Event Name\n";
                }
                if(dd==0 || mm==0 || yy==0)
                {
                    f = 0;
                    err += "Please enter the Starting Date\n";
                }
                if(dd1==0 || mm1==0 || yy1==0)
                {
                    f = 0;
                    err += "Please enter the End Date\n";
                }
                if(roleCount<1)
                {
                    f=0;
                    err += "There has to be atleast one role for an event";
                }
                if (f == 1)
                {
                    err = "";
                    var flag = 0;
                    
                    if(check(dd, mm, yy)!=1)
                    {
                        flag = 1;
                        err += "Please enter a valid start date\n";
                    }
                    if(check(dd1, mm1, yy1)!=1)
                    {
                        flag = 1;
                        err += "Please enter a valid end date\n";
                    }
                    if(flag == 0)
                    {
                        err = "";
                        if(yy > yy1)
                        {
                            err = "Starting date should be earlier than or same as end date";
                            flag = 1;
                        }
                        if(yy ==yy1 && mm > mm1)
                        {
                            err = "Starting date should be earlier than or same as end date";
                            flag = 1;
                        }
                        if(yy ==yy1 && mm == mm1 && dd > dd1)
                        {
                            err = "Starting date should be earlier than or same as end date";
                            flag = 1;
                        }
                    }
                    if(flag==0)
                    {
                        var i;
                        for(i=1; i<=rc && flag==0; i++)
                        {
                            var index="role"+i;
                            roleElem = document.getElementsByName(index)[0];
                            if(roleElem)
                            {
                                index = "credit"+i;
                                creditElem = document.getElementsByName(index)[0];
                                if(roleElem.value.length==0 || creditElem.value.length==0)
                                {
                                    err = err+"\nNo role/credit field can be empty";
                                    flag = 1;
                                }
                                if(isNaN(creditElem.value))
                                {
                                    err = err+"\nEnter a number for each credit field";
                                    flag = 1; 
                                }
                            
                                var j;
                                for(j=i+1; j<=rc && flag==0; j++)
                                {                                
                                    var index1="role"+j;
                                    roleElem1 = document.getElementsByName(index1)[0];
                                    if(roleElem1)
                                    {
                                        if(roleElem1.value==roleElem.value)
                                        {
                                            err = err+"\nRole names should be unique";
                                            flag=1;
                                        }
                                    }
                                }
                            }
                        }
                        
                        if(flag == 0)
                        {
                            var roleNum = document.getElementsByName('roleCount')[0];
                            roleNum.value = rc;
                            
                            document.forms[0].submit();
                        }
                        
                    }
                    if(flag != 0)
                    {
                        alert(err);
                    }
                   
                }
                else
                {
                    alert(err);
                }
            }
            function check ( d, m ,y )
            {
                var months = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
                if(y%100 == 0)
                {
                    if(y%400 == 0)
                    {
                        months[1]++;
                    }
                }
                else
                {
                    if(y%4 == 0)
                    {                        
                        months[1]++;
                    }
                }
                
                if(d <= months[m-1])
                {
                    return 1;
                }
                return 0;
            }
            function addRole()
            {
                var table = document.getElementById('eventInfo');
                var newRow;
                var elem;
                if(roleCount==0)
                {         
                    newRow = document.createElement('tr');
                    elem = "<td>Role Name</td><td>Credit</td>";
                    newRow.innerHTML = elem;
                    table.appendChild(newRow);
                }
                roleCount++;
                rc++;
                newRow = document.createElement('tr');
                elem = "<td><input type='text' name='role"+rc+"'/></td><td><input type='text' name='credit"+rc+"'/></td><td><input type='button' value='Remove Role' name='remove"+rc+"'onClick='remove("+rc+");'/></td>";
                newRow.innerHTML = elem;
                table.appendChild(newRow);                
            }
            function remove(c)
            {
                role = document.getElementsByName("role"+c)[0];
                credit = document.getElementsByName("credit"+c)[0];
                button = document.getElementsByName("remove"+c)[0];
                p = role.parentNode;
                
                role.parentNode.removeChild(role);
                credit.parentNode.removeChild(credit);
                button.parentNode.removeChild(button);
                p.parentNode.parentNode.removeChild(p.parentNode);//to remove the empty row
                roleCount--;
                <?php if(isset($roles))
                {?>
                    if(roleCount==0)
                    {
                        y = document.getElementById('heading');
                        y.parentNode.removeChild(y);
                    }
                <?php
                }
                ?>

            }