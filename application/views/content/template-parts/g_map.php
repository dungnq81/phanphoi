<div class="col-lg-8 col-md-8 col-xs-12 map-gr">
	<div id="map"></div>
</div>
<script>
	var center = new google.maps.LatLng(10.837672, 106.675557);
    var map, marker, infowindow;
    function initialize() {
        var locations = [];
			locations.push(['277B Cách Mạng Tháng 8, Phường 12, Quận 10, Tp. Hồ Chí Minh, Việt Nam', 10.7778423,106.6795736]);
			locations.push(['24 Nguyễn Văn Dung, phường 6, Quận Gò Vấp, Tp. Hồ Chí Minh, Việt Nam', 10.8486135,106.6774823]);                            
        var mapAttr = {
            center: center,
            zoom: 10        };
        // THE MAP TO DISPLAY.
        map = new google.maps.Map(document.getElementById("map"), mapAttr);
        infowindow = new google.maps.InfoWindow();
        var i;
        for (i = 0; i < locations.length; i++) {
            // var image = new google.maps.MarkerImage('marker' + i + '.png',
            //           new google.maps.Size(20, 34),
            //           new google.maps.Point(0, 0),
            //           new google.maps.Point(10, 34));
            var stt = i + 1;
            var image = 'https://raw.githubusercontent.com/Concept211/Google-Maps-Markers/master/images/marker_red'+ stt +'.png';

            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                title: locations[i][0],
                // animation: google.maps.Animation.DROP,
                icon: image
            });           

            // marker.addListener('click', function() {
            //     //infowindow.open(map, marker);
            //     ///////////
            //     // infowindow.close();
            //     map.setCenter({
            //         lat : this.position.lat(),
            //         lng : this.position.lng()
            //     });
            //     map.setZoom(13);
            //     marker = new google.maps.Marker({
            //             position: new google.maps.LatLng(this.position.lat(), this.position.lng()),
            //             map: map,
            //             title: this.title,
            //             icon: this.icon
            //         });
            //     infowindow.open(map, marker);
            //     ///////////
            // });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    map.setCenter(marker.getPosition());
                    map.setZoom(14);
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
              })(marker, i));
        }
        var circle = new google.maps.Circle({
            center: center,
            map: map,
            radius: 10000,          // IN METERS.
            fillColor: '#FF6600',
            fillOpacity: 0.3,
            strokeColor: "#FFF",
            strokeWeight: 0         // DON'T SHOW CIRCLE BORDER.
        });
    }

    function newLocation(newLat,newLng,stt, name)
    {
        var image = 'https://raw.githubusercontent.com/Concept211/Google-Maps-Markers/master/images/marker_red'+stt+'.png';
        infowindow.close();
        map.setCenter({
            lat : newLat,
            lng : newLng
        });
        map.setZoom(14);
        marker = new google.maps.Marker({
                position: new google.maps.LatLng(newLat, newLng),
                map: map,
                title: name,
                icon:image
            });
        infowindow.setContent(name);
        infowindow.open(map, marker);
    }
    google.maps.event.addDomListener(window, 'load', initialize);


    function changeRadius(rdu){
        $('#radius').val(rdu);
        $('.range').removeClass('active');
        $('.' + rdu).addClass('active');
        $("#myform").submit();
    }
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
    function showPosition(position) {
        $("#myAddress").val(position.coords.latitude + ',' + position.coords.longitude);
        //alert(position.coords.latitude);
        //alert(position.coords.longitude);
        //getAddress(position.coords.latitude, position.coords.longitude);
        //console.log();
        //x.innerHTML = "Latitude: " + position.coords.latitude + 
        //"<br>Longitude: " + position.coords.longitude;
    }

    function getAddress(lat,lng) {
        //alert(lat);
        //alert(lng);
        var latlng = new google.maps.LatLng(lat, lng);
        var geocoder = geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'latLng': latlng }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[1]) {
                    $("#myAddress").val(results[1].formatted_address);
                    //alert("Location: " + results[1].formatted_address);
                }
            }
        });
    }
    
	$(function() {
		
		navigator.geolocation.watchPosition(function(position) {
					},
		function(error) {
			if (error.code == error.PERMISSION_DENIED)
			  console.log("you denied me :-(");
		});
	});

	
</script>
<div class="col-lg-4 col-md-4 col-xs-12 coso-list-map results-search">
	<?php
		$wg_ct=$this->page_model->select_table_dk_col_get('post','idpostpr=302 and trangthai','ten,noidung,mota');
		if($wg_ct){$stt=0;;?>
			<ul>
				<?php foreach($wg_ct as $row){$stt++; ?>
					<li>
						<a href="javascript:;" onclick="newLocation(<?php echo $row->mota; ?>, <?php echo $stt; ?> ,'<?php echo $row->ten; ?>')">
							<span class="agency-stt"><?php echo $stt; ?></span>
							<div class="inner-results">
								<span class="agency-type"><?php echo $row->ten; ?></span>
								<?php echo $row->noidung;?>
							</div>                                  
						</a>
					</li>
				<?php } ?>
			</ul>
		<?php } ?>
</div>