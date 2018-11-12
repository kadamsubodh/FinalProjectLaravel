$(document).ready(function(){
	$("#add").click(function(){
	
	var container = $(".container-fluid");
	var divlength=$(".container-fluid > .row ").length +1;
	
	var div=document.createElement("div");
	var id="div"+divlength;
	div.setAttribute("id",id);
	div.setAttribute("class","row");
	container.append(div);
	var token = $('meta').attr('content');
	$.ajax({
			type:"POST",
			data:{"_token": token ,"length":divlength, '_method': 'POST' },
	       	url :'/selectAjax',
	        success : function(response) {	                    
	                        $('#'+id).html(response);
	                 }
	    });	
	});

	/*$("#submit").click(function(e){
	
		// var v;
		// var em=$('input').filter(function(){
  //   		return !$(this).val();
		// }).length;
		// 	// v=$('form').serialize();
		// alert(em);
		var count=0;
		$('#productForm :input').each(function(){
			if($(this).val()=="")
			{
				$(this).parent().addClass("alert-danger");
				$(this).focus();
				count++;
			}
			else{
				$(this).parent().removeClass("alert-danger");
			}
		});
		if(count>0)
			{
				alert("All field are required!!");
					e.preventDefault();
			}				
	});*/

});

// $(document).ready(function(){
// $("#remove").click(function(){
// deleteSelect($(this));
// });
// });

function deleteAttributeValue(event){
$(this).parent().parent().remove();
};

function getCode()
{
	$.ajax({
			type:"GET",
			url: "/getCouponCode",
			success:function(responce){
					$('#code').val(responce);
					}
	});
};


// ----------------------------------------------------------------------------
// else{
		// var Attributes="";
		// 	var select_data={ selectData: [] };
		// 	var div=$("#selectDiv > .row").length;
		// 	$("#selectDiv > .row").each(function(){
		// 		if($(this).find("select").val()=="" || $(this).find('#Attribute_value').val()=="")
		// 		{
		// 			alert("all fields required");
		// 			return false;
		// 		}
		// 		else{
		// 			var key1=$(this).find("select").val();				
		// 			var value1=$(this).find('#Attribute_value').val()
		// 			select_data.selectData.push( {key:key1, value:value1} );
		// 			 Attributes+="&"+key1+ "=" +value1; 
		// 		}
				
				
		// 	});
		// 	console.log();
		// 	var formData=$("#productForm").serializeArray();
		
		// 	// var Attributes = JSON.stringify(select_data);
		// 	// for(var key in select_data.selectData)
		// 	// 	{
		// 	// 		Attributes=select_data.selectData[key];
		// 	// 		// var v1=select_data.selectData[key].key;
		// 	// 		// var v2=select_data.selectData[key].value;
		// 	// 		// console.log(v1,v2);
		// 	// 		console.log(Attributes);
		// 	// 	}

		// 	var token = $('meta').attr('content');
		// 	console.log(formData);
		// 	return false;
		// 	$.ajax({
		// 			type : "POST",
		// 			data: $("#productForm").serialize(),
	 //              	url : '/admin/products',
	 //                    success : function(response) {
	                    
	 //                       alert(response);
	 //                    }
		// });
	
				
		// }