<!DOCTYPE html>
<html>
<head>
<script>
function togglecheckboxes(master,group){
    var cbarray = document.getElementsByName(group);
    for(var i = 0; i < cbarray.length; i++){
        cbarray[i].checked = master.checked;
    }
}
</script>
</head>
<body>
<input type="checkbox" id="cb1" onchange="togglecheckboxes(this,'cbg1[]')"> Toggle All
<br><br>
<input type="checkbox" id="cb1" class="cbgroup1" name="cbg1[]" value="1"> Item 1<br>
<input type="checkbox" id="cb1" class="cbgroup1" name="cbg1[]" value="2"> Item 2<br>
<input type="checkbox" id="cb1" class="cbgroup1" name="cbg1[]" value="3"> Item 3<br>
<input type="checkbox" id="cb1" class="cbgroup1" name="cbg1[]" value="4"> Item 4<br>
</body>
</html>

<!-- <script>
$(document).ready(function(){
 
 $('#country').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"index.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
   })
  }
 });
 
});
</script> -->


<script>
  $(document).ready(function(){
    $("#country").change(function(){
      a=$(this).val()
      if(a=="HTML"){
        $("#code").val("1")
      }
      else if(a=="CSS"){
        $("#code").val("2")
      }
      else if(a=="JavaScript"){
        $("#code").val("3")
      }
      else if(a=="Java"){
        $("#code").val("4")
      }
      else if(a=="Ruby"){
        $("#code").val("5")
      }
    })
  })
</script>