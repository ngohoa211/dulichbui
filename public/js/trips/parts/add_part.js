function initMap(){v_map.initMap();};

function m_point(status,mark_start,mark_end,start_date,end_date,activiti,moveby) {
	    this.status = status, 
	    this.start_latitude = mark_start.getPosition().lat(),
	    this.start_longitude = mark_start.getPosition().lng(),
	    this.end_latitude = mark_end.getPosition().lat(),
	    this.end_longitude= mark_end.getPosition().lng(),
	    this.start_date= start_date ,
	    this.end_date= end_date,
	    this.activiti= activiti,
	    this.moveby= moveby
		};
function m_ptbl(mark,element){
		this.mark=mark;
		this.element =element;
}
//php importent
// if (preg_match("/\bweb\b/i", "PHP is the web scripting language of choice.")) {
//     echo "A match was found.";
// } else {
//     echo "A match was not found.";
// }
// student = new m_part();
// var s =JSON.stringify(student);
// $.ajax({
//         type:"post",
//         url:'/test_json',
//         dataType:"json",
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         data: {'s': s} ,

//         success:function(res){

            

//             console.log('su');
//             console.log(res);

//         },
//         error: function( req, status, err ) {
//             console.log( 'Error: ' + err );
//             console.log( "Status: " + status );
//             console.log( "Response: " + req );
//         }
//     });
var m_arrayPoint = new Array();
var c_mapping = {
	///doi tuong controller - bang quan ly , mapping giua v_map va v_block 
	"blockId_number_current": -1,
	"numbers_block":0,
	"buttonId_number_current": -1,
	"button_type":null,
	"numbers_button":0,
	"prepare" : function(){
		c_mapping.combineData();
		c_mapping.namming();

	},
	"combineData": function(){
		//them input latitude va longtitude vao cac block
		for (index = 0; index < m_arrayPoint.length; ++index) {
			if(m_arrayPoint[index].element.find('#latitude').length==0){
			m_arrayPoint[index].element.append('<div class="form-group">'
    												+'<input type="hidden" class="form-control" id="latitude" value="'+m_arrayPoint[index].mark.getPosition().lat()+'">'
  												+'</div>'
  												+'<div class="form-group">'
    												+'<input type="hidden" class="form-control" id="longtitude" value="'+m_arrayPoint[index].mark.getPosition().lng()+'">'
  												+'</div>');
			}else {
				m_arrayPoint[index].element.find('#latitude').val()=m_arrayPoint[index].mark.getPosition().lat();
				m_arrayPoint[index].element.find('#longtitude').val()=m_arrayPoint[index].mark.getPosition().lat();
			}
		}
		//them ten cac block vao dau form
			
		$('#usrform').prepend('<div class="form-group">'
    						+'<input type="hidden" class="form-control" id="nameblocks" name="nameblocks" >'
  							+'</div>');
		for (index = 0; index < m_arrayPoint.length; ++index) {
			$('[name="nameblocks"]').val($('[name="nameblocks"]').val()+' '+m_arrayPoint[index].element.attr('id'));
		}

	},
	"namming" :function(){
		//them ten block vao name cua cac input . vd: id latitude -> name block1latitude
		for (index = 0; index < m_arrayPoint.length; ++index) {
			// confirm(m_arrayPoint[index].element.attr('id'));
			m_arrayPoint[index].element.find('input').each(function() {
           	  $(this).attr("name", m_arrayPoint[index].element.attr("id")+$(this).attr("id"));
	        });

		}
	}

}; 
var v_map = {
	//doi tuong view. quan ly map
	"geocoder" : null,
	"map":null,
	"directionsService" :null,
    "directionsDisplay" :null,
	"initMap": function initMap() {
	    this.map = new google.maps.Map(document.getElementById('map_canvas'), {
	        center: {lat: 21.0245, lng: 105.84117},
	        zoom: 8
	    });
	    this.geocoder = new google.maps.Geocoder();
	    this.directionsService = new google.maps.DirectionsService;
        this.directionsDisplay = new google.maps.DirectionsRenderer
        this.directionsDisplay.setMap(v_map.map);
		},
	"getadress" : function getadress(element,latLng){
		this.geocoder.geocode({'latLng': latLng},
			function (results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					if (results[0]) {
						element.val(results[0].formatted_address);
					} else {
						element.val("No results");
					}
				} else {
					if(status==OVER_QUERY_LIMIT)
            			window.alert('Ban nhap qua nhanh. binh tinh!' );
					else element.val(status);
				}
			});
		},
	"displayAllRoute" : function(m_arrayPoint){
		 v_map.directionsDisplay.setMap(null);
		 v_map.directionsDisplay.setMap(v_map.map);
		var waypts =[];
		if(m_arrayPoint.length>=2){
			
			for (index = 1; index < m_arrayPoint.length-1; ++index) {
				  waypts.push({
	        		location: m_arrayPoint[index].mark.getPosition(),
	        		stopover: true
	      			});
				}
			  v_map.directionsService.route({
			        origin: m_arrayPoint[0].mark.getPosition(),
			        destination: m_arrayPoint[m_arrayPoint.length-1].mark.getPosition(),
			        waypoints: waypts,
        			optimizeWaypoints: false,
			        travelMode: 'DRIVING'
			    }, function(response, status) {
			        if (status === 'OK') {
			            v_map.directionsDisplay.setDirections(response);
			        } else {
			        	if(status==OVER_QUERY_LIMIT)
            			window.alert('Ban nhap qua nhanh. binh tinh!' );
            			else window.alert('Directions request failed due to ' + status);
          			}
			    });
			}else{
				 v_map.directionsDisplay.setMap(null);
			}
		}
	};
var v_block = {
	//doi tuong view. quan ly bang thong tin
	"index": '<div id ="block'+'">',

	"html":'<div class="form-group" >'
				+'<label class="control-label col-sm-3" >Vị trí</label>'
					+'<div class="col-sm-9">'
						+'<input  class="form-control" id="vitri" readonly >'
					+'</div>'
				+'</div>'
			+'<div class="form-group" >'
				+'<label class="control-label col-sm-3" >Đi đến bằng:</label>'
					+'<div class="col-sm-6">'
						+'<input  class="form-control" id ="moveby" required>'
					+'</div>'
				+'</div>'
			+'<div class="form-group" >'
				+'<label class="control-label col-sm-3" >Đến nơi vào lúc:</label>'
					+'<div class="col-sm-6">'
						+'<input type="datetime-local" class="form-control" id="start_date" required>'
					+'</div>'
				+'</div>'
			+'<div class="form-group" >'
				+'<label class="control-label col-sm-3" >Rời đi vào lúc:</label>'
					+'<div class="col-sm-6">'
						+'<input type="datetime-local" class="form-control" id ="end_date" required>'
					+'</div>'
				+'</div>'
			+'<div class="form-group" >'
			+'<label class="control-label col-sm-3" >Hoạt động</label>'
					+'<div class="col-sm-9">'
						+'<button type="button" class="btn btn-default" aria-label="Left Align" id="addhd">'
  							+'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>'
						+'</button>'
					+'</div>'
			+'</div >'						
		+'</div>',
	"addBlock": function(){
		c_mapping.numbers_block++;
		this.index= '<div id ="block'+c_mapping.numbers_block+'">';
		return this.index+this.html;
		}
    };
var v_button_add = {
	//doi tuong view. quan ly button them block
	// <button type="button" class="btn btn-primary" id="#" >Thêm điểm</button>
	"index": '<button type="button" class="btn btn-primary" id="button">',
	"html": 'Thêm điểm</button>',
	"addButton": function(id_number){
		c_mapping.numbers_button++;
		this.index= '<button type="button" class="btn btn-primary" id="button'+id_number+'">';
		return this.index+this.html;
		}
	};
var c_event = {
	//them su kien click cho button add
	addClickEventForButtonAdd : function addClickEventForButtonAdd(button){
		button.click(function(){
		v_map.marker=null;
    	//sau khi click vao button phai click vao map
    	v_map.map.addListener('click', function(event) {
    		//danh dau tren ban do
    		if (v_map.marker== null ) {
    			//neu la 1 diem hoan toan moi: them block va dua vi tri vao #vitri
    			v_map.marker = new google.maps.Marker({ 
    				position: event.latLng, 
    				map: v_map.map,
    			});
    			
    			///
    			$('#tripinfo').append(v_block.addBlock());

    			c_mapping.blockId_number_current=c_mapping.numbers_block;

    			v_map.getadress($('#block'+c_mapping.blockId_number_current).find("#vitri"),event.latLng);
    			c_event.addClickEventForButtonPlush($('#block'+c_mapping.blockId_number_current).find("#addhd"));
    			//them xong. di chuyen button xuong duoi
    			c_mapping.numbers_button--;

    			$("#block"+c_mapping.blockId_number_current).prepend('<button type="button"  class="btn btn-warning" id="delete" >xóa điểm</button>');
    			c_event.addClickEventForButtonDelete($('#block'+c_mapping.blockId_number_current).find("#delete"));
    			//them vao model va noi cac diem
    			var m_pb = new m_ptbl(v_map.marker,$('#block'+c_mapping.blockId_number_current));
    			m_arrayPoint.push(m_pb);
    			v_map.displayAllRoute(m_arrayPoint);
    			//xoa diem do trem map
    			if(m_arrayPoint.length>1) v_map.marker.setMap(null);

    			$('#button'+c_mapping.buttonId_number_current).remove();
	    		c_mapping.buttonId_number_current=c_mapping.buttonId_number_current+1;
	    		$('#tripinfo').append(v_button_add.addButton(c_mapping.buttonId_number_current));
	    		addClickEventForButtonAdd($('#button'+c_mapping.buttonId_number_current));
	    		
    		}else{
    			//neu la mot diem da mark. chi thay doi, khong them moi
    			v_map.marker.setPosition(event.latLng);
    			v_map.getadress($('#block'+c_mapping.blockId_number_current).find("#vitri"),event.latLng);
    			v_map.displayAllRoute(m_arrayPoint);
    		}
    		}); 

 		});
	},
	addClickEventForButtonPlush : function(button){
		var textareahtml ='<textarea rows="4" cols="50" id="activiti"   form="usrform" style="height: 136px"> </textarea>'
							
		button.click(function(){
			if(button.parent().find("#activiti").length==0)
				button.parent().append(textareahtml);
		});
	},
	addClickEventForButtonDelete : function(button){
		button.click(function(){
			var markindex =-1;
			for (index = 0; index < m_arrayPoint.length; ++index){
				
				if(m_arrayPoint[index].element.attr('id')==button.parent().attr('id')){
					m_arrayPoint[index].mark.setMap(null);
					markindex= index;
				}
			}
			if(markindex!=-1) m_arrayPoint.splice(markindex, 1);
			v_map.displayAllRoute(m_arrayPoint);
			button.parent().remove();

		});
	}
}

$( document ).ready(function() {
//sau khi tai xong. thuc hien:
	//add button 
	c_mapping.buttonId_number_current=1;
	$('#tripinfo').append(v_button_add.addButton(c_mapping.buttonId_number_current));
	c_mapping.buttonId_number_current=c_mapping.numbers_button;
	c_mapping.button_type = 'add';
	//add su kien click vao button
	c_event.addClickEventForButtonAdd($('#button'+c_mapping.buttonId_number_current));
	});
