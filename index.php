<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add Invoice</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/main.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</head>
<body>

  <div class="container">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-xs-5">
                        <h2>Add <b>Invoice</b></h2>
                    </div>
                    <div class="col-xs-7 ">
                        <a href="#" class="btn btn-primary generateinvoice" style="display: none;" onclick="generate();" data-toggle="modal" data-target="#exampleModal"><i class="material-icons">&#xE147;</i> <span>Generate Invoice</span></a>
                                   
                    </div>
                </div>
            </div>
            <h4>Add Item</h4>
<form>
  <div class="form-row align-items-center">

    <div class="col-auto">
      <label >Name</label>
      <input type="text" class="form-control mb-2" id="name" required="required">
    </div>
     <div class="col-auto">
      <label >Quantity</label>
      <input type="number" class="form-control mb-2" id="quantity" value="1" required="required">
    </div>
     <div class="col-auto">
      <label >Unitprice</label>
      <input type="number" class="form-control mb-2" id="unitprice" value="1" step="0.01" required="required">
    </div>
     <div class="col-auto">
      <label >Tax</label>
      <select class="form-control mb-2" id="tax" required="required">
      <option selected value="0">0%</option>
      <option value="1">1%</option>
      <option value="5">5%</option>
      <option value="10">10%</option>
     </select> 
    </div>
      
    <div class="col-auto">
         </br>
      <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </div>
  </div>
</form>
</br>
<div class="invoice" style="display: none;">
<table class="table table-striped table-hover table-responsive-sm ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>           
                        <th width="180px">Quantity</th>
                        <th>Unit price</th>
                        <th>Total (Without-Tax)</th>
                        <th>Total (With-Tax)</th>
                        <th class="action">Action</th>
                    </tr>
                </thead>
                <tbody id="orders"></tbody>
            </table>
 <table class="float-sm-right">
            <tr >
                 <td><h5>Total $</h5></td><td><h5><span id="totalvalnotax" class="text-danger"></span></h5></td>
            </tr>

            <tr >
                 <input type="hidden" class="form-control mb-2" id="totalvalhidden">
                 <td><h5>Total withtax $</h5></td><td><h5><span id="totalval" class="text-danger"></span></h5></td>
            </tr>

            <tr class="discountdiv">
                <td colspan="2">
                    <div class="float-sm-right">Discount
                   <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  <label class="btn btn-secondary active">
                  <input type="radio" name="options" id="price" class="discount" autocomplete="off" checked> Price
                   </label>
              <label class="btn btn-secondary">
                <input type="radio" name="options" id="percent" class="discount" autocomplete="off"> Percentage
              </label>
              
            </div>
             </div></td>
             </tr>

            <tr class="discountdiv">
                 <td colspan="2">
                    <div class="col-auto">
                      <label >Discount Value</label>
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text priceclass">$</span>
                          </div>
                          <input type="number"  class="form-control" id="discountvalue"  onkeyup="calculategrandtotal()">
                          <div class="input-group-append">
                            <span class="input-group-text percentclass" style="display: none;">%</span>
                          </div>
                        </div>
                    
                    </div>
                </td>
            </tr>

             <tr class="discountdivinvoice" >
                
                <td><h5 id="text"> Discount $</h5></td><td><h5><span id="discountinvoice"></span></h5></td>
               
                </tr>
                 <tr >
                
                <td><h5>Grand Total $</h5></td><td><h5><span id="grandtotalval" class="text-danger"></span></h5></td>
               
            </tr>
  </table>
    
</div>
    <div class="clearfix"></div>
        </div>
            
            
        </div>
    </div>        
</div>     
</body>
</html>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Invoice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="company-address">
            Bharath ltd
            <br />
            489 Road Street
            <br />
            Mumbai, India.
            <br />
        </div>
    
        <div class="invoice-details">
            Invoice No: 564
            <br />
            Date: 1/06/2012
        </div>
        
        <div class="customer-address">
            To:
            <br />
            Mr. Mohanlal
            <br />
            123 Long Street
            <br />India. 
            <br />
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="showdata();" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<script>
 var rowCount = 0;
 var siNum = 0;

$( "form" ).submit(function( event ) {
//=--------calculation-----------//
      var taxprice=0;
      var tax         =$('#tax').find(':selected').val();
      var name        =$('#name').val();
      var quantity    =$('#quantity').val();
      var unitprice   =$('#unitprice').val();
      var total_price = parseFloat(quantity*unitprice);
      
      if(tax!=0){
       taxprice    = parseFloat(total_price *(tax/100));
      }
      var total_price_tax = parseFloat(total_price+taxprice);

//=-------------end calculation-----------//      
      rowCount++;
      siNum++
      var htmlRows = '';
        htmlRows += '<tr id="row'+rowCount+'">';
        htmlRows += '<td style="padding:8px;">'+siNum+'</td> ';
        htmlRows += '<td  class=" names"> '+name+'</td>';
        htmlRows += '<td  ><input class="form-control quantity" type="number" min="1"  id="quantity_'+rowCount+'" name="quantity[]" for="'+rowCount+'" value="'+quantity+'" readonly/> </td>'; 
        htmlRows += '<td > <input class="form-control product_price'+rowCount+'" type="text" step="0.01" style="color: #0e0e0e"   id="product_price_'+rowCount+'" name=price[]"  value="'+unitprice+'" readonly/> </td>';
        htmlRows += '<td > <input class="form-control total_product_price" type="text" step="0.01" style="color: #0e0e0e"   id="total_product_price'+rowCount+'" name=total_price[]" value="'+total_price+'" readonly/> </td>';
        htmlRows += '<td > <input class="form-control total_product_price_tax" type="text" step="0.01" style="color: #0e0e0e"   id="total_product_price_tax'+rowCount+'" name=total_price_tax[]" value="'+total_price_tax+'" readonly/> </td>';
        htmlRows += '<td  class="action"><a href="#" class="delete" title="Delete" id="'+rowCount+' "data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a></td>'; 
        htmlRows += '</tr>'; 
      $('#orders').append(htmlRows);
       $('.invoice').show();
       $('.generateinvoice').show();
      calculateTotal();
      return false;
   
});

$(document).on('click', '.delete', function()
  {
    if($('.total_product_price_tax').length==1)
    {
        $('#discountvalue').val('');
        $('.invoice').hide();
         $('.generateinvoice').hide();
    }
    var button_id = $(this).attr('id');
    $('#row'+button_id+'').remove();
    
    siNum = $(".names").length;
    calculateTotal();
    reorderSlNos();
});

$('input:radio').change(function() 
  {
    
    var optionselected = $(this).attr('id');
   
    if(optionselected=="price")
    {
       $('.priceclass').show();
       $('.percentclass').hide(); 
    }
    else
    {
       $('.priceclass').hide();
       $('.percentclass').show(); 
    }
    calculategrandtotal();
   
});

function reorderSlNos()
 {
    var newSINo= 1;
    $('.total_product_price_tax').each(function() {
       
      $(this).parent().siblings(":first").text(newSINo);
      newSINo++;
      });
  }

  function calculateTotal()
  {
    var Totalwithtax=0;
    var Totalwithouttax=0;
    $('.total_product_price_tax').each(function() {
    if($(this).val()!="")
    {
     Totalwithtax += parseFloat($(this).val());
    }
  });
    $('.total_product_price').each(function() {
    if($(this).val()!="")
    {
     Totalwithouttax += parseFloat($(this).val());
    }
  });
    
    $('#totalval').text(Totalwithtax.toFixed(2));
    $('#totalvalhidden').val(Totalwithtax.toFixed(2));
    $('#totalvalnotax').text(Totalwithouttax.toFixed(2));
    calculategrandtotal();
  }

   function calculategrandtotal()
  {
    var total= parseFloat($('#totalvalhidden').val());
    var discount=($('#discountvalue').val()=="")? 0 : $('#discountvalue').val();
    var grandtotal= 0;
    $('#discountinvoice').text(discount);
    if($('input:radio:checked').attr('id')=="price")
    {
        $('#text').text("Discount $");
        
          grandtotal= total-discount;
    }
    else
    {
        $('#text').text("Discount %");
       
         grandtotal= parseFloat(total-(discount/100));

    }
    
    $('#grandtotalval').text(grandtotal.toFixed(2));
  }

function generate()
{
    $('.discountdivinvoice').show();
     $('.action').hide();
     $('.discountdiv').hide();
   var details= $('.invoice').html();

   $('.modal-body').append(details);

}
function showdata()
{
     $('.action').show();
      $('.discountdiv').show();
      $('.discountdivinvoice').hide();
}


</script>