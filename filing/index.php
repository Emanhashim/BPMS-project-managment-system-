
 <?php 
//$active = "home";
// include_once '../template/header.php';

// $active = "home";
// include_once '../template/header.php';
 ?>
<html>
 <head>
  <title>Reference</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://www.jqueryscript.net/demo/Dialog-Modal-Dialogify/dist/dialogify.min.js"></script>
 </head>
 <body >
   
  <div class="container">
   <br />
   <h3 align="center">Bazra Moters, letters and reference number</h3>
   <br />
   <div class="panel panel-default">
    <div class="panel-heading">
     <div class="row">
      <div class="col-md-6">
       <h3 class="panel-title">reference and letters </h3>
      </div>
      <div class="col-md-6" align="right">
       <button type="button" name="add_data" id="add_data" class="btn btn-success btn-xs">Add</button>
      </div>
     </div>
    </div>
    <div class="panel-body">
     <div class="table-responsive">
      <span id="form_response"></span>
      <table id="user_data" class="table table-bordered table-striped">
       <thead>
        <tr>
         <td>Ref num</td>
         <td>letter title</td>
         <td>date</td>
         <td>View</td>
        </tr>
       </thead>
      </table>
      
     </div>
    </div>
   </div>
  </div>
 </body>
</html>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 var dataTable = $('#user_data').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"fetch.php",
   type:"POST"
  },
  "columnDefs":[
 
   {
    "targets":[3],
    "orderable":false,
   },
   {
    "targets":[2],
    "orderable":false,
   },
   {
    "targets":[1],
    "orderable":false,
   },
   {
    "targets":[0],
    "orderable":false,
   },
  ],

 });

 $(document).on('click', '.view', function(){
  var id = $(this).attr('id');
  var options = {
   ajaxPrefix: '',
   ajaxData: {id:id},
   ajaxComplete:function(){
    this.buttons([{
     type: Dialogify.BUTTON_PRIMARY
    }]);
   }
  };
  new Dialogify('fetch_single.php', options)
   .title('View files Details')
   .showModal();
 });
 
 $('#add_data').click(function(){
  var options = {
   ajaxPrefix:''
  };
  new Dialogify('add_data_form.php', options)
   .title('Add New Reference')
   .buttons([
    {
     text:'Cancle',
     click:function(e){
      this.close();
     }
    },
    {
     text:'Insert',
     type:Dialogify.BUTTON_PRIMARY,
     click:function(e)
     {
      var image_data = $('#images').prop("files")[0];
      var form_data = new FormData();
      form_data.append('images', image_data);
      form_data.append('Ref_num', $('#Ref_num').val());
      form_data.append('Letter_title', $('#Letter_title').val());
      form_data.append('date', $('#date').val());
      $.ajax({
       method:"POST",
       url:'in_data.php',
       data:form_data,
       dataType:'json',
       contentType:false,
       cache:false,
       processData:false,
       success:function(data)
       {
        if(data.error != '')
        {
         $('#form_response').html('<div class="alert alert-danger">'+data.error+'</div>');
        }
        else
        {
         $('#form_response').html('<div class="alert alert-success">'+data.success+'</div>');
         dataTable.ajax.reload();
        }
       }
      });
     }
    }
   ]).showModal();
 });
 
 
});
</script>
