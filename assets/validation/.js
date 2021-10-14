 /**************** desing form validation ***************/
 $("#designapplicationform").validate({    
        rules: {  
            name: {
                required: true
            },
            design_name: {
                required: true
            },
            design_content: {
                required: true
            },
            design_description: {
                required: true
            },
            cell_phone: {
                required: true,
                number: true 
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
			email: {
                email: "Please enter a valid email address"
            }            
        },
        submitHandler: function (form){	
			 $('#sendbtn').prop("disabled", true); 
			  $( "#designapplicationform" ).submit();
		}                
  });
 
/* $("#sendbtn").click(function (e) {
			$('#sendbtn').prop("disabled", true);
	});*/
  /********************** close ******************************/
  

 /**************** Trademark form validation ***************/
 
  
  
 /**************** Trademark Application form validation ***************/
 $(document).ready(function(){
	//var ck_box = $('input[type="checkbox"]:checked').length;
	
	/*if(ck_box > 0){
			$('.error_msg').css('display','block');
			return true;
		} else{
			error_msg = "PLEASE CHECK AT LEAST ONE.";
			$('.error_msg').text(error_msg);
			//return false;
		}	
	*/
	
	
	/*$("#applicationFrom").submit(function(){
		       
		       if($("input[name*='comod']:checked").length <1 ){ alert("checke th ckeckbox"); return false;}
		       if($("#w_add").val() == '' ){ 
				   if(/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test($("#url").val())){
								alert("valid URL");
							} else {
								alert("invalid URL");
							}
				   alert("field is reqired"); return false;
				}
		       return true;
		       
		
		});*/
	
	
	  //~ $("#applicationFrom12").validate({
		//~ //alert("dsfg");
		//~ errorPlacement: function(error, element) {
        //~ error.appendTo(element.parent());
      //~ }, 
		//~ rules: {  
			//~ web_add: {
				//~ required: true,
				//~ url: true
			//~ }
		//~ },
		//~ messages: {
		     
		//~ },
		//~ errorPlacement: function(error, element) {
		  //~ var placement = $(element).data('error');
		  //~ if (placement) {
			//~ $(placement).append(error)
		  //~ } else {
			//~ error.insertAfter(element);
		  //~ }
       //~ },
		//~ submitHandler: function (form){
			
			//~ $('#appbtn').prop("disabled", true);
			//~ $( "#applicationFrom").submit();
		//~ }             
	  //~ }); 
 });
  
  /********************** close ******************************/
  
  /**************** patent form validation and other js ***************/
  
  var count = 1;
	/* $("#patentapplicationform").validate({    
        // Specify the validation rules
        rules: { 
            refrence_link: {
                required: true,
            },
			applicant_info: {
                required: true,
            }
        },   
            
        // Specify the validation error messages
        messages: {
            refrence_link: {
                required: "This field is required",
            },
        },
    }); */
    
    
	 $(document).on('click', ".addmore", function() {	
		
		if(count != 1)
		{
	    	$("#more_"+count).text('Delete');
			$("#more_"+count).removeClass("addmore");
            $("#more_"+count).addClass("deleterow");
		}
		count++;
		//alert(count);
		
		var addnew = '<div class="col-sm-12 col-xs-12 p-left-25 p-right-0 text-left p-bottom-20" id="indinew_'+count+'"><div class="form-group"  style="max-width:295px;width:100%;display:inline-block;"><input type="text" id="" name="ind_name[]" class="form-control name1"  placeholder="Name"  data-error="#errind_name"><span id="errind_name" class="error_manager"></span></div><div class="form-group" style="max-width:295px;width:100%;display:inline-block;margin-left: 5px;"><input type="text" id="" name="ind_eng_name[]" class="form-control name1"  placeholder="Eng name"  data-error="#errind_eng_name"><span id="errind_eng_name" class="error_manager"></span></div><div class="form-group" style="max-width:295px;width:100%;display:inline-block;"><input type="text" id="" name="ind_id_card_num[]" class="form-control name1"  placeholder="ID card number" data-error="#errind__id_card_num"><span id="errind__id_card_num" class="error_manager"></span></div><div class="form-group" style="max-width:295px;width:100%;display:inline-block;margin-left: 5px;"><input type="text" id=""    name="ind_nationality[]" class="form-control name1"  placeholder="Nationality" data-error="#errind_nationality"><span id="errind_nationality" class="error_manager"></span></div><div class="form-group" style="max-width:295px;width:100%;display:inline-block;"><input type="text" id="" name="ind_cell_phone[]" class="form-control name1"  placeholder="Cellphone number" data-error="#errind_cell_phone"><span id="errind_cell_phone" class="error_manager"></span></div> <div class="form-group" style="max-width:295px;width:100%;display:inline-block;margin-left: 5px;"><input type="text" id=""        name="ind_zipcode[]" class="form-control name1"  placeholder="zip code" data-error="#errind_zipcode"><span id="errind_zipcode" class="error_manager"></span></div> 	<div class="form-group" style="max-width:295px;width:100%;display:inline-block;"><input type="text" id="" name="ind_address[]" class="form-control name1"  placeholder="Address" data-error="#errind_address"><span id="errind_address" class="error_manager"></span></div><a name="" class="btn add_dlt_btn deleterow" id="more_'+count+'">Delete</a></div>';
		  
		  
		
		$( "#individual_add" ).append(addnew); 
			
	 });
	 
	 
	  $(document).on('click', ".deleterow", function() {	
		  
		  var delbtn = $(this).attr('id'); 
          var delbtnarr = delbtn.split("_");
          var id = delbtnarr[1];
/*
          alert(delbtn);
          alert(id);
*/
		  $("#indinew_"+id).remove();
      });
  /********************** close ******************************/

/**************** Trademark application step 2 form validation and other js ***************/
  
  var count = 1;
	/* $("#patentapplicationform").validate({    
        // Specify the validation rules
        rules: { 
            refrence_link: {
                required: true,
            },
			applicant_info: {
                required: true,
            }
        },   
            
        // Specify the validation error messages
        messages: {
            refrence_link: {
                required: "This field is required",
            },
        },
    }); */
    
    
    $(document).on('click', ".appaddmoreerer", function() {	
		var numItems = $('#ind_add #customadditional div.additional').length;
		alert(numItems+' jkj');
		if(numItems==0){ numItems=1; }
		alert(numItems);
		$.ajax({
			type: "POST",
			url: base_url+"trade/StepTwoIndividualField",
			data:{ setval:numItems,delet:''},
			success: function(data){
				console.log(data);
				$('#ind_add #customadditional').html(data)
				  
				 // folder = data;
			},
			error: function (xhr, desc, err)
			{
			  console.log("error");
			}
		  });
	  });
			  
	 $(document).on('click', ".appaddmore", function() {	
		
		var scount = parseInt($("#countsame").val());
		var samecount = scount+1;
		$("#countsame").val(samecount);
			
		if(count != 1)
		{
	    	$("#appmore_"+count).text('삭제');
			$("#appmore_"+count).removeClass("addmore");
            $("#appmore_"+count).addClass("deleterow");
		}
		count++;
		//alert(count);
		//var samecount = $("#countsame").val(scount);
		 
		var addnew = '<div class="col-sm-12 col-xs-12 text-left col_adj additional" id="indivi_'+count+'">\
		                   <div class="form-group" style="max-width:312px;width:100%;display:inline-block;margin-bottom:5px;">\
		                    <input type="text" id="ap_nam" name="app_name[]" class="form-control" placeholder="출원인명 ( 한글 )">\
		                    <span class="errmng"></span> \
		                   </div>\
		                   <div class="form-group" style="max-width:312px;width:100%;display:inline-block;margin-left: 2px;margin-bottom:5px;">\
		                     <input type="text" id="al_nam" name="al_name[]" class="form-control" placeholder="출원인명 ( 영문 )">\
		                     <span class="errmng"></span> \
		                   </div>\
		                   <div class="form-group" style="max-width:312px;width:100%;display:inline-block;margin-bottom:5px;">\
		                       <input type="text" id="rg_num" name="r_num[]" class="form-control" placeholder="주민등록번호">\
		                       <span class="errmng"></span> \
		                   </div>\
		                   <div class="form-group" style="max-width:312px;width:100%;display:inline-block;margin-left: 2px;margin-bottom:5px;">\
		                     <input type="text" id="a_con" name="app_con[]" class="form-control" placeholder="출원인 연락처">\
		                     <span class="errmng"></span> \
		                   </div> \
		                   <div class="form-group" style="max-width:312px;width:100%;display:inline-block;margin-bottom:5px;">\
		                     <input type="text" id="ap_email" name="ap_mail[]" class="form-control" placeholder="출원인 E-mail 주소">\
		                     <span class="errmng"></span> \
		                    </div>\
		                    <div class="form-group" style="max-width:312px;width:100%;display:inline-block;margin-left: 2px;margin-bottom:5px;">\
		                       <input type="text" id="add_r" name="add_app[]" class="form-control" placeholder="주민등록등본상 주소">\
		                       <span class="errmng"></span> \
		                    </div>\
		                    <div class="form-group" style="max-width:312px;width:100%;display:inline-block;margin-bottom:5px;">\
		                        <input type="text" id="mail_add" name="m_add[]" class="form-control" placeholder="우편물 수령 주소 ( 상표등록증 수령주소 )">\
		                        <span class="errmng"></span> \
		                    </div>\
		                    <a class="btn add_dlt_btn deleterow" id="appmore_'+count+'">삭제</a> \
		                    <small class="radiobox-image">*  주민등록등본상의 주소와 동일합니다.  \
										<input type="hidden" class="rg_add" name="rg_addval[]" value="0">	<input id="r_a1'+count+'" data-id="1" value="1" name="rg_add'+samecount+'" class="form-control chkrgadd" type="radio">\
												<label for="r_a1'+count+'" class=""> 예   </label>\
											<input id="r_a2'+count+'" name="rg_add'+samecount+'" value="0" class="form-control chkrgadd" checked="" type="radio">\
												<label for="r_a2'+count+'" class="">아니오</label>\
										</small></div>';
        $( "#ind_add" ).append(addnew); 
			
	 });
	
	 
	  $(document).on('click', ".deleterow", function() {	
		  var samecount = parseInt($("#countsame").val())-1;
		  $("#countsame").val(samecount);
		  var reversecnt = $("#countsame").val();  
		  		  
		  var delbtn = $(this).attr('id'); 
          var delbtnarr = delbtn.split("_");
          var id = delbtnarr[1];
          
		  $("#indivi_"+id).remove();
		  
		var numItems = $('#ind_add .additional').length;
		
		$.ajax({
			type: "POST",
			url: base_url+"trade/StepTwoIndividualField",
			data:{ setval:numItems,delet:'delete'},
			success: function(data){
				console.log(numItems);
				$('#ind_add #customadditional').html(data)
				  
				 // folder = data;
			},
			error: function (xhr, desc, err)
			{
			  console.log("error");
			}
		  });
		  
      });
      
      $(document).on('click', ".chkrgadd", function() {
		  
		  $(this).parent('.radiobox-image').find('.rg_add').val($(this).val());
		 });
      
      
  /********************** close ******************************/
  
  
  /**************** trademark step 1 image upload form validation ***************/
 $("#applicationform").validate({    
        rules: {  
            trad_str: {
                required: true
            }
        },
        
        messages: {
			/*email: {
                email: "Please enter a valid email address"
            } */           
        },
        submitHandler: function (form){	
			 $('#sub_data').prop("disabled", true); 
			  $( "#applicationform" ).submit();
		}                
  });
 
/* $("#sendbtn").click(function (e) {
			$('#sendbtn').prop("disabled", true);
	});*/
  /********************** close ******************************/
  


