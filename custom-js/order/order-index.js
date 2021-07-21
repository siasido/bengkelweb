base_url = 'http://localhost/restoapp/';

$("#add_row").unbind('click').bind('click', function() {
    var table = $("#product_info_table");
    var count_table_tbody_tr = $("#product_info_table tbody tr").length;
    var row_id = count_table_tbody_tr + 1;
    console.log(row_id);

    $.ajax({
        url: base_url + 'menu/getItems/',
        type: 'get',
        dataType: 'json',
        success:function(response) {
          
            console.log(response);

            var html = '<tr id="row_'+row_id+'">'+
                            '<td>'+ 
                            '<select class="form-control" data-row-id="'+row_id+'" id="item_'+row_id+'" name="items[]" onchange="getDetailItemData('+row_id+')">'+
                                '<option value="-">- Select Item -</option>';
                                $.each(response, function(index, value) {
                                    html += '<option value="'+value.idmenu+'">'+value.namaMenu+'</option>';             
                                });
                            html += '</select>'+
                            '</td>'+ 
                            '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getSubtotal('+row_id+')"></td>'+
                            '<td><input type="text" name="harga[]" id="harga_'+row_id+'" class="form-control" disabled><input type="hidden" name="harga_value[]" id="harga_value_'+row_id+'" class="form-control"></td>'+
                            '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" disabled><input type="hidden" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control"></td>'+
                            '<td class="text-center"><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fas fa-trash"></i></button></td>'+
                        '</tr>';

            if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  
            }
            else {
                $("#product_info_table tbody").html(html);
            }

             
        }
      });

    return false;
  });

  function getSubtotal(row = null) {
    if(row) {
      var total = Number($("#harga_value_"+row).val()) * Number($("#qty_"+row).val());
      total = total.toFixed(2);
      $("#amount_"+row).val(total);
      $("#amount_value_"+row).val(total);
      
      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }

  function getDetailItemData(row_id)
  {
    var idmenu = $("#item_"+row_id).val();    
    if(idmenu == "") {
      $("#harga_"+row_id).val("");
      $("#harga_value_"+row_id).val("");

      $("#qty_"+row_id).val("");           

      $("#amount_"+row_id).val("");
      $("#amount_value_"+row_id).val("");

    } else {
      $.ajax({
        url: base_url + 'menu/getDetailItemById',
        type: 'post',
        data: {idmenu : idmenu},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
          
          $("#harga_"+row_id).val(response.harga);
          $("#harga_value_"+row_id).val(response.harga);

          $("#qty_"+row_id).val(1);
          $("#qty_value_"+row_id).val(1);

          var total = Number(response.harga) * 1;
          total = total.toFixed(2);
          $("#amount_"+row_id).val(total);
          $("#amount_value_"+row_id).val(total);
          
          subAmount();
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }

  function subAmount() {
    // var service_charge = <?php echo ($company_data['service_charge_value'] > 0) ? $company_data['service_charge_value']:0; ?>;
    var tax_charge = 10;

    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);

    // sub total
    $("#gross_amount").val(totalSubAmount);
    $("#gross_amount_value").val(totalSubAmount);

    // vat
    var tax_amount = (Number($("#gross_amount").val())/100) * tax_charge;
    tax_amount = tax_amount.toFixed(2);
    $("#tax_charge").val(tax_amount);
    $("#tax_charge_value").val(tax_amount);
    
    // total amount
    var totalAmount = (Number(totalSubAmount) + Number(tax_amount));
    totalAmount = totalAmount.toFixed(2);
    // $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);

    var discount = $("#discount").val();
    if(discount) {
      var grandTotal = Number(totalAmount) - Number(discount);
      grandTotal = grandTotal.toFixed(2);
      $("#net_amount").val(grandTotal);
      $("#net_amount_value").val(grandTotal);
    } else {
      $("#net_amount").val(totalAmount);
      $("#net_amount_value").val(totalAmount);
      
    } // /else discount 

  } // /sub total amount

  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }

  function getSisaKembalian(){
    var totalPayment = Number($("#totalpayment").val());
    var grandTotal = Number($("#net_amount_value").val());
    
    var sisaKembalian = totalPayment - grandTotal;
    sisaKembalian = sisaKembalian.toFixed(2);
    
      $("#sisakembalian").val(sisaKembalian);
      $("#sisakembalian_value").val(sisaKembalian);
   
    
  }

  // var finalSisaKembalian = $("#sisakembalian_value").val();
  // if (sisaKembalian < 0){
  //   $('#submit').prop("disabled", true);

  // }