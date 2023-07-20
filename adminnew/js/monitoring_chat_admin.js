var isInput=0;
var isLoadRekap=0;
var arrayMessageRoom=[];
var roomListID=[];
$(document).ready(function() {
  $('#chat_room').hide();	
 
  window.setInterval(function(){
	   loadChatRoom();
	}, 5000);//1000 milliseconds from server.
});

function startMessageMonitoring(){
	window.setInterval(function(){
	    if(isInput==0){			
			roomListID.forEach(function(element) {
					console.log(element);
					selectMessageRealtime(element);
			})
		}		
	}, 5000);//1000 milliseconds from server.
}

function removeBox(id){
//destroy box
	$('#sb_'+id).remove();
	$('#btnTambah'+id).show();
}
function closeBox(id){
	//get CSS display state of .toggle_chat element
	console.log('try close '+ id);
		var toggleState = $('#toggle_chat_' + id).css('display');		
		//toggle show/hide chat box
		//$('#toggle_chat_' + id).slideToggle();
		console.log('toggle state ' + toggleState);
		//use toggleState var to change close/open icon image
		if(toggleState == 'block')
		{
			//$("#header_"+ id +" div").attr('class', 'open_btn');
			$("#close_tbn_"+ id).attr('class', 'open_btn');
			
			$('#toggle_chat_' + id).hide();
			$('#sb_'+id).css('height','33px');
		}else{
			//$("#header_"+ id +" div").attr('class', 'close_btn');
			$("#close_tbn_"+ id).attr('class', 'open_btn');
			$('#toggle_chat_' + id).show();
			$('#sb_'+id).css('height','300px');
		}
}

function getChatRoom(id){
   var user_dest=$('#user_dest_'+id).text();
	if($.trim(user_dest)==""){
		console.log('no User dest log');
	     return;	
	}
   
   var username=$('#username_'+id).val();
	if($.trim(username)==""){
		console.log('no User name log');
	     return;	
	}
   var message=$('#message_'+id).val();
   $.ajax({
		url:"../chat.php",
		type:"POST",
		cache: false,
		dataType:'text',
		data:{j:'gcr','ud':user_dest,u:username},
		success: function(data) {
		  console.log('chating room ' + data);		
		  $('#chat_room_'+ id).val(data);
		  selectMessageRekap(id);
		  //sendMessage(username,user_dest,data,message,id);
		
		},
		error:function(jqXHR,textStatus,errorThrow){
				console.log('Erro '+ textStatus); 
		}				
	});	
}

function sendMessage(user,user_dest,chat_room,message,id,image_link){
	isInput=1;//digunakan untuk menstop sementara tarik data
	$.ajax({
		url:"../chat.php",
		type:"POST",
		cache: false,
		dataType:'text',
		data:{j:'sm','ud':user_dest,u:user,msg:message,cr:chat_room,img:image_link},
		success: function(data) {	
		   console.log(data);
		   isInput=0;
		   //$('.message_box').append(data);
		    //$(data).hide().appendTo('#message_box_'+ id).fadeIn();
			
			 $('#message_box_'+ id).append(data);
			 //$('#message_box_'+ id).append(data);
		   
		   //$('#message_box_'+ id).append(data);
	       //keep scrolled to bottom of chat!
			var scrolltoh = $('#message_box_'+ id)[0].scrollHeight;
			$('#message_box_'+ id).scrollTop(scrolltoh);					
			//reset value of message box
			$('#message_'+ id).val('');
		
		},
		error:function(jqXHR,textStatus,errorThrow){
			isInput=0;
				console.log('Erro '+ textStatus); 
		}				
	});
}

function sendMessageClick(id){
	var evt = new Object();
	evt.keyCode=13; //inject
	enterMessage(evt,id);	
}
function enterMessage(evt,id){
	console.log(evt);
	if(evt.keyCode == 13) {			
		var username = $('#username_'+ id).val();
		var message = $('#message_'+ id).val();
		var chat_room=$('#chat_room_'+ id).val();			
		
		
		console.log('message '+ message);
		var user_dest=$('#user_dest_'+ id).text();
		
		
		if(username==''){
		    alert('user name cannot empty')	;
			return;
		}
		if(user_dest==''){
		    alert('user destination cannot empty')	;
			return;
		}
		
		if(message==''){
		    alert('message cannot empty')	;
			return;
		}
		if(chat_room==''){
		   getChatRoom(id,username,user_dest,message);
		   return;	
		}
		sendMessage(username,user_dest,chat_room,message,id,'');		
	
	}
}
function selectMessageRekap(id){	
	var chat_room=$('#chat_room_'+ id).val();	
	if($.trim(chat_room)==""){
		getChatRoom(id);
		return;	
	}
	
	console.log('try get user ');
	$.ajax({
		url:"../chat.php",
		type:"POST",
		cache: false,
		dataType:'text',
		data:{j:'gm',cr:chat_room,tgl:'today'},
		success: function(data) {	
		   $('#message_box_'+ id).html(data);
		   var scrolltoh = $('#message_box_'+ id)[0].scrollHeight;
		   $('#message_box_'+ id ).scrollTop(scrolltoh);
		
		}				
	});
}
function selectMessageRealtime(id){	
	var chat_room=$('#chat_room_'+ id).val();	
	if($.trim(chat_room)==""){
		getChatRoom(id);
		return;	
	}
	var userName =$('#username_'+id).val();
	console.log('try get user ');
	$.ajax({
		url:"../chat.php",
		type:"POST",
		cache: false,
		dataType:'text',
		data:{j:'gmrt',cr:chat_room,ud:userName},
		success: function(data) {	
		   console.log('rt : ' + data);
		   if(data==""){
		     return;	   
		   }
		   $('#message_box_'+ id).append(data);
		   var scrolltoh = $('#message_box_'+ id)[0].scrollHeight;
		   $('#message_box_'+ id ).scrollTop(scrolltoh);
		
		}				
	});
}

function chat(newID,id_room,self,partner){	
    $('#btnTambah'+newID).hide();
	var initStore=partner;
	var initUser=self;
	var rightPos=(100 * (newID -1)) + 2 ;//lebar shout//isi 260 berjejer
	arrayMessageRoom.push(newID);
    var box='<div class="shout_box" id="sb_'+ newID +'">' +
				'<div class="header" id="header_'+newID+'"> ' +
					'<span id="user_dest_'+newID+'" class="destination_label">'+ initStore+ '</span>' +
					'<input name="chat_room" id="chat_room_'+newID+'" type="text" placeholder="chatroom" value="'+ id_room +'" maxlength="12" />' +
					
					'<div class="remove_btn" id="remove_btn_'+newID+'" onClick="removeBox(\''+ newID +'\')">&nbsp;</div>'+	
					'<div class="close_btn" id="close_btn_'+newID+'" onClick="closeBox(\''+ newID +'\')">&nbsp;</div>'+
									
				'</div>' +
				'<div class="toggle_chat" id="toggle_chat_'+newID+'" >' +
				   '<div class="message_box" id="message_box_'+newID+'"></div>' +
				       
						'<div class="user_info">' +						   
							'<input name="username_'+newID +'" id="username_'+newID+'" type="hidden" placeholder="Your Name" value="'+initUser+'" maxlength="15" readonly/>' +    
'<input name="message_'+newID+'" id="message_'+newID+'" class="message_text" type="text" placeholder="Type Message Hit Enter" maxlength="100" onKeyPress="enterMessage(event,\''+ newID +'\');" /> ' +
                           '<span class="send_button" id="send_button_'+newID+'" onClick="sendMessageClick(\''+ newID +'\')">&nbsp;</span>'+
						'</div>' +
						
					'</div>' +
				'</div>';
				
	//$('#myBody').append(box);
	$(box).appendTo(document.body);
	//$(selector).css(property)
	//$('#sb_'+newID).addclass('shout_box2');
	//var pos1 = $('#sb_'+newID).position();
	
	//kunci
    $('#sb_'+newID).css('height','300px');
    $('#sb_'+newID).animate({ 'bottom': 0 + 'px', 'right': rightPos + 'px'}, 200, function(){
        //end of animation.. if you want to add some code here
		//alert('test');
		$('#chat_room_'+newID).hide('slow');
		getChatRoom(newID);
		startMessageMonitoring();
		 $('#sb_'+newID).draggable({
		   handle: '#header_'+newID	
		});
		 roomListID.push(newID);
		//selectMessageRekap(newID);
		
    });
	//alert($('.shout_box').css('right'));	
}

function loadChatRoom(){
	var row='';
	var self='';
	var partner='';
	$.ajax({
		url:"../chat.php",
		type:"POST",
		cache: false,
		dataType:'json',
		data:{j:'gcrbo',on:store_name,lac:last_access},
		success: function(data) {	
		 
		  last_access=data.last_access;
		  $.each(data.results, function(key, val) {
			   if(val.user1==store_name){
					 self=val.user1;	     
					 partner=val.user2;
				}else{
					 self=val.user2; 
					 partner=val.user1;
				}
			 
			  if($('#dr_'+val.chat_room ).length>0){
				  $('#no_'+ val.chat_room).css('background-color','#0F0');
				  if($('#sb_'+ $('#no_'+ val.chat_room).text()).length>0){
					  
				  }else{
					  
					  if($('#cbAutoOpen').is(':checked')){
						   console.log('#btnTambah_'+ $('#no_'+ val.chat_room).text() +'.click()');
					 		$('#btnTambah'+ $('#no_'+ val.chat_room).text()).click(); 
					  }
					 
					 
				  }
			  }else{
				  no++;
				  row='<tr class="isi-tabel" id="dr_'+ val.chat_room +'"> '+
						'<td id="no_'+ val.chat_room +'">'+no+'</td>'+
						'<td  class="sembunyi" id="cr_'+ val.chat_room+'">'+ val.chat_room +'</td>'+
						'<td id="sl_'+ val.chat_room+'">'+ self+'</td>'+
						'<td id="ptnr_'+ val.chat_room+'">'+partner+'</td>'+
						'<td id="ptnr_'+ val.chat_room+'">'+ val.user_last_access+'</td>'+
						'<td id="ptnr_'+ val.chat_room+'">'+ val.updatedate +'</td>'+    
						'<td><input type="button" name="btnTambah'+no +'" id="btnTambah'+no +'" value="chat" onClick="chat(\''+ no +'\',\''+ val.chat_room +'\',\''+ self +'\',\''+ partner +'\');"></td>'+
					 '</tr>';
				  $('#myTable tr:first').after(row);
				  if($('#sb_'+ no).length>0){
					  
				  }else{
					  if($('#cbAutoOpen').is(':checked')){
					    console.log('#btnTambah_'+no+'.click()');
					    $('#btnTambah'+no).click(); 
					  }
				  }
			  }
			  
			  //console.log(row);
		  });

		}				
	});
}


/*function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}
*/