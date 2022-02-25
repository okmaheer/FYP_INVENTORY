  var count = 2;
    var limits = 500;
   
    "use strict";
    //Add purchase input field
    function addpruduct(e) {
         var supplier = $("#supplier_list").val();
         console.log(supplier);
        var t = '<tr id="row"><td width="300"><div  class="col-sm-12"><select name="supplier_id[]" class="select2 form-control mb-3 custom-select float-right" ><option>Select option</option>'+supplier+'</select></div></td><td><input name="supplier_price[]" type="text" class="form-control text-right"  placeholder="0.00"/></td><td><button type="button"  class="btn btn-sm btn-success" id="add-row" onClick="addpruduct('+"proudt_item"+')"><i class="fa fa-plus-square"></i> </button>&nbsp;<button type="button" class=" delete-row btn btn-sm btn-danger" onclick="deleteRow(this)"><i class="fas fa-trash-alt"></i></button></td></tr>';
        count == limits ? alert("You have reached the limit of adding " + count + " inputs") : $("tbody#proudt_item").append("<tr>" + t + "</tr>")
        $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Select option",
                allowClear: true
            });
    }
        "use strict";
      function deleteRow(e) {
        var t = $("#product_table > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
       
    }

          window.onload = function () {
        var text_input = document.getElementById('product_id');
        text_input.focus();
        text_input.select();
    }