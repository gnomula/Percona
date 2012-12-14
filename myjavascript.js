    var oldone = null;
    var anchor="";
    function show(id) {
        var obj = document.getElementById(id);
        obj.className = 'visible';
        document.getElementById("headername").innerHTML=id;
        // FIXME do it via css class
    }
    function hide(id) {
        var obj = document.getElementById(id);
        obj.className = 'hidden';
        // FIXME do it via css class
    }
    function toggle(id) {
        if (oldone!=null)
        hide(oldone);
        show(id);
        oldone = id;

    }    
            
   