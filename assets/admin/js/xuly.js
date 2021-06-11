(function($){

	$(document).ready(function() {

		$('#btn_login_ad').click(function(){

			$("#result_login_alert").removeClass('alert_ad');

			var email_login_ad=$("input[name='email_login_ad']").val();

			var password_login_ad=$("input[name='password_login_ad']").val();

			if(email_login_ad=='' || password_login_ad==''){

				$("#result_login_alert").addClass('alert_ad');

				$( "#result_login_alert" ).empty().append('Bạn chưa nhập đủ thông tin');

			}else{

				$.ajax({

					type:'POST',

					url:'Admin/check_login',

					data:{

						'email_login_ad':email_login_ad,

						'password_login_ad':password_login_ad,

					},

					success: function(result){

						// alert(result);

						if(result==0){

							$("#result_login_alert").addClass('alert_ad');

							$("#result_login_alert").empty().append('Tài khoản hoặc mật khẩu không đúng');

						}else if(result==2){

							$("#result_login_alert").addClass('alert_ad');

							$("#result_login_alert").empty().append('Tài khoản hiện đang bị khóa, vui lòng liên hệ admin');

						}

						else{

							$('#frm_login_ad').submit();

						}

					 }

				});

			}

		});

	});

	//-----------------------------------

	// $(document).keypress(function(e) {

		// if(e.which==13){

			// $("#result_login_alert").removeClass('alert_ad');

			// var email_login_ad=$("input[name='email_login_ad']").val();

			// var password_login_ad=$("input[name='password_login_ad']").val();

			// if(email_login_ad=='' || password_login_ad==''){

				// $("#result_login_alert").addClass('alert_ad');

				// $( "#result_login_alert" ).empty().append('Bạn chưa nhập đủ thông tin');

			// }else{

				// $.ajax({

					// type:'POST',

					// url:'Admin/check_login',

					// data:{

						// 'email_login_ad':email_login_ad,

						// 'password_login_ad':password_login_ad,

					// },

					// success: function(result){

							// if(result==0){

								// $("#result_login_alert").addClass('alert_ad');

								// $("#result_login_alert").empty().append('Tài khoản hoặc mật khẩu không đúng');

							// }else{

								// $('#frm_login_ad').submit();

							// }

					 // }

				// });

			// }

		// };

	// });

	//---------- Update setting-------------------------//

	$(document).ready(function() {

		$('#btn_capnhat_setting').click(function(){

			$("#result_setting_alert").removeClass('alert_ad');

			$("#result_setting_alert" ).empty();

			var count_div = $('#frm_setting_ad div.form-group').length;

			for(var i=1;i<=count_div;i++){

				var setting_ip_col="setting_"+i;

				var setting_ip_name="input[name='setting_"+i+"']";

				var setting_ip_value=$(setting_ip_name).val();

				if(setting_ip_value==null){

					setting_ip_name="textarea[name='setting_"+i+"']";

					setting_ip_value=$(setting_ip_name).val();

					// alert(setting_ip_value);

				}if(setting_ip_value==null){

					setting_ip_name="select[name='setting_"+i+"']";

					setting_ip_value=$(setting_ip_name).val();

					// alert(setting_ip_value);

				}

					$.ajax({

						type:'POST',

						url:'update_setting',

						data:{

							'number_col':count_div,

							'setting_ip_col':setting_ip_col,

							'setting_ip_value':setting_ip_value,

							'id_option':i,

						},

						success: function(result){

							setTimeout(function() {

								$("#result_setting_alert" ).empty().append('Cập nhật thành công !');

							},1000);

							$("#result_setting_alert").addClass('alert_ad');

							$("#result_setting_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

						}

					});

			}

		});

	});

	$(document).ready(function() {

		$('#btn_capnhat_infor_ad').click(function(){

			$("#result_capnhat_infor_ad_alert").removeClass('alert_ad');

			$("#result_capnhat_infor_ad_alert" ).empty();

			var hoten=$("input[name='hoten']").val();

			var sodienthoai=$("input[name='sodienthoai']").val();

			var gioitinh=$("select[name='gioitinh']").val();

			var ngaysinh=$("input[name='ngaysinh']").val();

			var match= ["image/gif","image/png","image/jpg","image/jpeg"];

			var anhdaidien_post_value=$("input[type=file]").val();

			if(anhdaidien_post_value!=''){

				var anhdaidien_post_name=$("input[type=file]").val().split('\\').pop();

				var anhdaidien_post=$("input[type=file]").prop('files')[0];

				var type_anhdaidien_post = anhdaidien_post.type;

				if(type_anhdaidien_post == match[0] || type_anhdaidien_post == match[1] || type_anhdaidien_post == match[2]|| type_anhdaidien_post == match[3])

				{

					// var type_anhdaidien_post = anhdaidien_post.type;

					var form_data = new FormData();

					//thêm files vào trong form data

					form_data.append('file', anhdaidien_post);

					console.log(form_data);

					  $.ajax({

							url: 'update_post', 

							dataType: 'text',

							cache: false,

							contentType: false,

							processData: false,

							data: form_data,                       

							type: 'post',

							success: function(res){

								// $('.status').text(res);

								$('#img-avt-post-ad').html(res);

								// console.log(res); 

						}

					});

				} 

				else{

					$('#img-avt-post-ad').append('Chỉ được upload file ảnh');

				}

			}

			// alert(anhdaidien_post_name);

			$.ajax({

				type:'POST',

				url:'update_infor_ad',

				data:{

					'hoten':hoten,

					'sodienthoai':sodienthoai,

					'gioitinh':gioitinh,

					'ngaysinh':ngaysinh,

					'anhdaidien':anhdaidien_post_name

				},

				success: function(result){

					// alert(result);

					setTimeout(function() {

						$("#result_capnhat_infor_ad_alert" ).empty().append('Cập nhật thành công !');

					},0);

					$("#result_capnhat_infor_ad_alert").addClass('alert_ad');

					$("#result_capnhat_infor_ad_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

				}

			});

		});

	});

	$(document).ready(function() {

		$('.btn_capnhat_infor_user').click(function(){

			var id_user=$(this).attr('id');

			id_user_rs=id_user.split('btn_capnhat_infor_user_')[1];

			$("#result_capnhat_infor_ad_alert").removeClass('alert_ad');

			$("#result_capnhat_infor_ad_alert" ).empty();

			var hoten=$("input[name='hoten']").val();

			var sodienthoai=$("input[name='sodienthoai']").val();

			var gioitinh=$("select[name='gioitinh']").val();

			var ngaysinh=$("input[name='ngaysinh']").val();

			var match= ["image/gif","image/png","image/jpg","image/jpeg"];

			var anhdaidien_post_value=$("input[type=file]").val();

			if(anhdaidien_post_value!=''){

				var anhdaidien_post_name=$("input[type=file]").val().split('\\').pop();

				var anhdaidien_post=$("input[type=file]").prop('files')[0];

				var type_anhdaidien_post = anhdaidien_post.type;

				if(type_anhdaidien_post == match[0] || type_anhdaidien_post == match[1] || type_anhdaidien_post == match[2]|| type_anhdaidien_post == match[3])

				{

					var form_data = new FormData();

					form_data.append('file', anhdaidien_post);

					console.log(form_data);

					  $.ajax({

							url: 'update_post', 

							dataType: 'text',

							cache: false,

							contentType: false,

							processData: false,

							data: form_data,                       

							type: 'post',

							success: function(res){

								$('#img-avt-post-ad').html(res);

						}

					});

				} 

				else{

					$('#img-avt-post-ad').append('Chỉ được upload file ảnh');

				}

			}

			$.ajax({

				type:'POST',

				url:'update_infor_user',

				data:{

					'hoten':hoten,

					'sodienthoai':sodienthoai,

					'gioitinh':gioitinh,

					'ngaysinh':ngaysinh,

					'anhdaidien':anhdaidien_post_name,

					'id_user_rs':id_user_rs

				},

				success: function(result){

					// console.log(result);

					setTimeout(function() {

						$("#result_capnhat_infor_ad_alert" ).empty().append('Cập nhật thành công !');

					},0);

					$("#result_capnhat_infor_ad_alert").addClass('alert_ad');

					$("#result_capnhat_infor_ad_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

				}

			});

		});

	});

	$(document).ready(function() {

		$('#btn_capnhat_password_ad').click(function(){

			$("#result_password_alert").removeClass('alert_ad');

			$("#result_password_alert" ).empty();

			var matkhau=$("input[name='matkhau_ad']").val();

			var matkhau_rep=$("input[name='matkhau_ad_rep']").val();

			if(matkhau=='' || matkhau_rep==''){ 

				setTimeout(function() {

					$("#result_password_alert" ).empty().append('Vui lòng nhập đầy đủ thông tin');

					$("input[name='matkhau']" ).focus();

				},1000);

				$("#result_password_alert").addClass('alert_ad');

				$("#result_password_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

			}else{

				if(matkhau!=matkhau_rep){

					setTimeout(function() {

						$("#result_password_alert" ).empty().append('Password không trùng khớp');

						$("input[name='matkhau']" ).val('');

						$("input[name='matkhau_rep']" ).val('');

						$("input[name='matkhau']" ).focus();

					},1000);

					$("#result_password_alert").addClass('alert_ad');

					$("#result_password_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

				}else{

					$.ajax({

						type:'POST',

						url:'update_password_ad',

						data:{

							'password':matkhau_rep

						},

						success: function(result){

							// alert(result);

							setTimeout(function() {

								$("#result_password_alert" ).empty().append('Cập nhật thành công !');

							},1000);

							$("#result_password_alert").addClass('alert_ad');

							$("#result_password_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

						}

					});

				}

			}

		});

	});

	$(document).ready(function() {

		$('.btn_capnhat_password_user').click(function(){

			$("#result_password_alert").removeClass('alert_ad');

			$("#result_password_alert" ).empty();

			var matkhau=$("input[name='matkhau_ad']").val();

			var matkhau_rep=$("input[name='matkhau_ad_rep']").val();

			var id_user=$(this).attr('id');

			id_user_rs=id_user.split('btn_capnhat_password_user_')[1];

			if(matkhau=='' || matkhau_rep==''){ 

				setTimeout(function() {

					$("#result_password_alert" ).empty().append('Vui lòng nhập đầy đủ thông tin');

					$("input[name='matkhau']" ).focus();

				},1000);

				$("#result_password_alert").addClass('alert_ad');

				$("#result_password_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

			}else{

				if(matkhau!=matkhau_rep){

					setTimeout(function() {

						$("#result_password_alert" ).empty().append('Password không trùng khớp');

						$("input[name='matkhau']" ).val('');

						$("input[name='matkhau_rep']" ).val('');

						$("input[name='matkhau']" ).focus();

					},1000);

					$("#result_password_alert").addClass('alert_ad');

					$("#result_password_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

				}else{

					$.ajax({

						type:'POST',

						url:'update_password_member',

						data:{

							'password':matkhau_rep,

							'id_user_rs':id_user_rs

						},

						success: function(result){

							// console.log(result);

							setTimeout(function() {

								$("#result_password_alert" ).empty().append('Cập nhật thành công !');

							},1000);

							$("#result_password_alert").addClass('alert_ad');

							$("#result_password_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

						}

					});

				}

			}

		});

	});

	//------- Huy kich hoat thanh vien -----//

	$(document).on('click','.btn_khoa_table',function(){

		var string_id_thanhvien = this.id;

		var string_split = string_id_thanhvien.split('btn_khoa_');

		var id_thanhvien_arr= string_split[1].split('_');

		var table_rs=id_thanhvien_arr[0];

		var id_rs=id_thanhvien_arr[1];

		$("#result_"+table_rs+"_alert").removeClass('alert_ad');

		$("#result_"+table_rs+"_alert" ).empty();

		$.ajax({

			type:'POST',

			url:'lock_table',

			data:{

				'table_rs':table_rs,

				'id_rs':id_rs

			},

			success: function(result){

				setTimeout(function() {

					$("#result_"+table_rs+"_alert" ).empty().append('Cập nhật thành công !');

					$("#trangthai_"+table_rs+"_"+id_rs ).empty().append('Chưa kích hoạt');

					$("#btn_khoa_"+table_rs+"_"+id_rs ).empty().append('<i class="fa fa-unlock-alt"></i>');

					$("#btn_khoa_"+table_rs+"_"+id_rs ).removeClass( "btn_khoa_table" );

					$("#btn_khoa_"+table_rs+"_"+id_rs ).addClass( "btn_mokhoa_table" )

				},1000);

				$("#result_"+table_rs+"_alert").addClass('alert_ad');

				$("#result_"+table_rs+"_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

			}

		});

	});

	//---

	$(document).on('click','.btn_mokhoa_table',function(){

		var string_id_thanhvien = this.id;

		var string_split = string_id_thanhvien.split('btn_khoa_');

		var id_thanhvien_arr= string_split[1].split('_');

		var table_rs=id_thanhvien_arr[0];

		var id_rs=id_thanhvien_arr[1];

		$("#result_"+table_rs+"_alert").removeClass('alert_ad');

		$("#result_"+table_rs+"_alert" ).empty();

		$.ajax({

			type:'POST',

			url:'unlock_table',

			data:{

				'table_rs':table_rs,

				'id_rs':id_rs

			},

			success: function(result){

				setTimeout(function() {

					$("#result_"+table_rs+"_alert" ).empty().append('Cập nhật thành công !');

					$("#trangthai_"+table_rs+"_"+id_rs ).empty().append('Đã kích hoạt');

					$("#btn_khoa_"+table_rs+"_"+id_rs ).empty().append('<i class="fa fa-lock"></i>');

					$("#btn_khoa_"+table_rs+"_"+id_rs ).removeClass( "btn_mokhoa_table" );

					$("#btn_khoa_"+table_rs+"_"+id_rs ).addClass( "btn_khoa_table" )

				},1000);

				$("#result_"+table_rs+"_alert").addClass('alert_ad');

				$("#result_"+table_rs+"_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

			}

		});

	});

	//----

	$(document).on('click','.btn_xoa_table',function(){

		var string_id_thanhvien = this.id;

		var string_split = string_id_thanhvien.split('btn_xoa_');

		var id_thanhvien_arr= string_split[1].split('_');

		var table_rs=id_thanhvien_arr[0];

		var id_rs=id_thanhvien_arr[1];

		$("#result_"+table_rs+"_alert").removeClass('alert_ad');

		$("#result_"+table_rs+"_alert" ).empty();

		$.ajax({
			type:'POST',
			//url:'delete_table',
			url:'/admin/delete_table',
			data:{
				'table_rs':table_rs,
				'id_rs':id_rs
			},

			success: function(result){

				setTimeout(function() {

					$("#result_"+table_rs+"_alert" ).empty().append('Xóa thành công !');

					$("#item-"+table_rs+"-"+id_rs ).fadeOut().remove();

					// $("#trangthai_"+table_rs+"_"+id_rs ).empty().append('Đã kích hoạt');

					// $("#btn_khoa_"+table_rs+"_"+id_rs ).empty().append('<i class="fa fa-lock"></i>');

					// $("#btn_khoa_"+table_rs+"_"+id_rs ).removeClass( "btn_mokhoa_table" );

					// $("#btn_khoa_"+table_rs+"_"+id_rs ).addClass( "btn_khoa_table" )

				},1000);

				$("#result_"+table_rs+"_alert").addClass('alert_ad');

				$("#result_"+table_rs+"_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

			}

		});

	});

	//-----

	$(document).on('click','.btn_add_post',function(){

		var chkArray = [];

		$("input.idpostpr_post_edit:checked").each(function() {

			chkArray.push($(this).val());

		});

		var idpostpr_post;

		idpostpr_post = chkArray.join(',') ;

		tinyMCE.triggerSave();

		$("#result_setting_alert").removeClass('alert_ad');

		$("#result_setting_alert" ).empty();

		var string_id_post = this.id;

		var string_split = string_id_post.split('add_typepost_');

		var typepost= string_split[1];

		var ten_post=$("input[name='ten']").val();

		var url_post=$("input[name='url']").val();

		var keyword_post=$("input[name='keyword']").val();

		var focus_keywords=$("input[name='focus_keywords']").val();

		var seo_title_post=$("input[name='seo_title']").val();

		var id_slider=$("select[name='id_slider']").val();	

		if(typepost=='cat' || typepost=='menu' || typepost=='thuoctinhsanpham' || typepost=='giatrithuoctinhsanpham' || typepost=='danhmucsanpham'){//only for typepost=cat

			idpostpr_post=$("select[name='idpostpr']").val();

			var menu_link=$("select[name='menu_link']").val();

		}

		// alert(idpostpr_post);

		// console.log(idpostpr_post);

		var mota_post=$("textarea[name='mota']").val();

		// console.log(anhdaidien_post_name);

        //Xét kiểu file được upload

  //       var match= ["image/gif","image/png","image/jpg","image/jpeg"];

		// var anhdaidien_post_value=$("input[type=file]").val();

		// if(anhdaidien_post_value!=''){

		// 	var anhdaidien_post_name=$("input[type=file]").val().split('\\').pop();

		// 	var anhdaidien_post=$("input[type=file]").prop('files')[0];

		// 	var type_anhdaidien_post = anhdaidien_post.type;

		// 	if(type_anhdaidien_post == match[0] || type_anhdaidien_post == match[1] || type_anhdaidien_post == match[2]|| type_anhdaidien_post == match[3])

		// 	{

		// 		// var type_anhdaidien_post = anhdaidien_post.type;

		// 		var form_data = new FormData();

		// 		//thêm files vào trong form data

		// 		form_data.append('file', anhdaidien_post);

		// 		console.log(form_data);

		// 		  $.ajax({

		// 				url: 'update_post', 

		// 				dataType: 'text',

		// 				cache: false,

		// 				contentType: false,

		// 				processData: false,

		// 				data: form_data,                       

		// 				type: 'post',

		// 				success: function(res){

		// 					// $('.status').text(res);

		// 					$('#img-avt-post').html(res);

		// 					// console.log(res); 

		// 			}

		// 		});

		// 	} 

		// 	else{

		// 		$('#img-avt-post').append('Chỉ được upload file ảnh');

		// 	}

		// }else{

		// 	var anhdaidien_post_name=$("input[name='anhdaidien_clone']").val();

		// }

		//-------------------------------------

		var noidung_post=$("textarea[name='noidung']").val();

		var link_dr=$("input[name='link_dr']").val();

		var thuvienanh=$("input[name='thuvienanh']").val();

		var anhdaidien=$("input[name='anhdaidien']").val();

		var link_anhdaidien=$("input[name='link_anhdaidien']").val();

		var id_related_arr = [];

		$(".id_related input[type=checkbox]:checked").each(function() {

			id_related_arr.push($(this).val());

		});

		var id_related;

		id_related = id_related_arr.join(',') ;

		//------------ add val sp --------------

		var gia=0;

		var giakhuyenmai=0;

		var thongsokythuat='';

		var hotro='';

		if(typepost=='sanpham'){

			gia=$("input[name='gia']").val();

			giakhuyenmai=$("input[name='giakhuyenmai']").val();

			thongsokythuat=$("textarea[name='thongsokythuat']").val();

			hotro=$("textarea[name='hotro']").val();

			//---------- co bien the ----------

			var list_giatri = [];

			var list_meta = [];

			$('.form-sp-varible').each(function () {

				var id_giatrisp=this.id;

				//console.log(id_giatrisp);

			    //---- set giatrisp---//

			    	anhdaidien_ttsp=$("#"+id_giatrisp+" input[name=anhdaidien_ttsp]").val();

					gia_ttsp=$("#"+id_giatrisp+" input[name=gia_ttsp]").val();

					giakhuyenmai_ttsp=$("#"+id_giatrisp+" input[name=giakhuyenmai_ttsp]").val();

					title_sp_varial_label=$("#"+id_giatrisp+" .title_sp_varial_label").text();

					title_sp_varial_label_id=$("#"+id_giatrisp+" .title_sp_varial_label_id").text();

			  	    event.preventDefault();

				  	var value_rs = $("#"+id_giatrisp+" .title_sp_varial_label").map(function(){

				        return title_sp_varial_label;

				    }).toArray();

				  	var meta_rs = $("#"+id_giatrisp+" .title_sp_varial_label_id").map(function(){

				        return title_sp_varial_label_id;

				    }).toArray();

				  	value_rs.splice(1, 0, anhdaidien_ttsp);	

				  	value_rs.splice(2, 0, gia_ttsp);	

				  	value_rs.splice(3, 0, giakhuyenmai_ttsp);	

				  	list_giatri.push(value_rs);	

				  	list_meta.push(meta_rs);	      		   	  

			});

			//------------------------

			//---------- goi bao hanh ----------

			var list_giatri_baohanh = [];

			var list_meta_baohanh = [];

			$('.form-sp-goibaohanh').each(function () {

				var id_giatrisp=this.id;

				//console.log(id_giatrisp);

			    //---- set giatrisp---//

					gia_baohanh=$("#"+id_giatrisp+" input[name=gia_baohanh]").val();

					title_sp_varial_label=$("#"+id_giatrisp+" .title_sp_varial_label").text();

					title_sp_varial_label_id=$("#"+id_giatrisp+" .title_sp_varial_label_id").text();

			  	    event.preventDefault();

				  	var value_baohanh_rs = $("#"+id_giatrisp+" .title_sp_varial_label").map(function(){

				        return title_sp_varial_label;

				    }).toArray();

				  	var meta_baohanh_rs = $("#"+id_giatrisp+" .title_sp_varial_label_id").map(function(){

				        return title_sp_varial_label_id;

				    }).toArray();

				  	value_baohanh_rs.splice(1, 0, gia_baohanh);	

				  	list_giatri_baohanh.push(value_baohanh_rs);	

				  	list_meta_baohanh.push(meta_baohanh_rs);	      		   	  

			});

			//------------------------

		}

		//-------------------------------------

		if(ten_post==''){

			setTimeout(function() {

				$("#result_setting_alert" ).empty().append('Bạn chưa nhập tên');

				$("input[name='ten']").focus();

			},1000);

			$("#result_setting_alert").addClass('alert_ad');

			$("#result_setting_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');	

		}else{

			var check_draft = $("#draft_post").prop("checked");

			if(check_draft) {

				var trangthai_post='0';

			} else {

				var trangthai_post='1';

			}

			$.ajax({

			type:'POST',

			url:'insert_post',

			data:{

				'ten_post':ten_post,

				'url_post':url_post,

				'keyword_post':keyword_post,

				'seo_title_post':seo_title_post,

				'focus_keywords':focus_keywords,

				'idpostpr_post':idpostpr_post,

				'mota_post':mota_post,

				'noidung_post':noidung_post,

				'link_dr':link_dr,

				'typepost':typepost,

				'anhdaidien_post':anhdaidien,

				'link_anhdaidien':link_anhdaidien,

				'thuvienanh':thuvienanh,

				'menu_link':menu_link,							

				'id_slider':id_slider,

				'trangthai':trangthai_post,

				'id_related':id_related,

				'gia':gia,

				'giakhuyenmai':giakhuyenmai,							

				'thongsokythuat':thongsokythuat,

				'hotro':hotro,

				'meta':list_meta,

				'meta_value':list_giatri,

				'meta_baohanh':list_meta_baohanh,

				'meta_value_baohanh':list_giatri_baohanh

			},

			success: function(result){

				setTimeout(function() {

					console.log(result);

						window.location.href=link_dr;

						// $("#result_setting_alert" ).empty().append('Cập nhật thành công');

					},1000

				);

					$("#result_setting_alert").addClass('alert_ad');

					$("#result_setting_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

				}

			});

		}

	});

	//-----

	$(document).on('click','.btn_edit_post',function(){

		var chkArray = [];

		$("input.idpostpr_post_edit:checked").each(function() {

			chkArray.push($(this).val());

		});

		var idpostpr_post;

		idpostpr_post = chkArray.join(',') ;

		tinyMCE.triggerSave();

		$("#result_setting_alert").removeClass('alert_ad');

		$("#result_setting_alert" ).empty();

		var string_id_post = this.id;

		var string_split = string_id_post.split('edit_typepost_');

		var typepost_split= string_split[1].split('_');

		var typepost=typepost_split[0];

		var id_rs=typepost_split[1];

		if(typepost=='widget' && typepost_split[1]=='cat'){ //update 2308

			id_rs=typepost_split[2];

		}

		 //console.log(id_rs);

		var ten_post=$("input[name='ten']").val();

		var keyword_post=$("input[name='keyword']").val();

		var url_post=$("input[name='url']").val();

		var seo_title_post=$("input[name='seo_title']").val();

		var focus_keywords=$("input[name='focus_keywords']").val();

		if(typepost=='cat' || typepost=='menu' || typepost=='thuoctinhsanpham' || typepost=='giatrithuoctinhsanpham' || typepost=='danhmucsanpham'){//only for typepost=cat product_thuoctinh

			idpostpr_post=$("select[name='idpostpr']").val();

			var menu_link=$("select[name='menu_link']").val();

		}

		// console.log(typepost);

		// var idpostpr_post=$("select[name='idpostpr']").val();

		var mota_post=$("textarea[name='mota']").val();

		var id_slider=$("select[name='id_slider']").val();	

		// console.log(anhdaidien_post);

        //Xét kiểu file được upload

  //       var match= ["image/gif","image/png","image/jpg","image/jpeg"];

		// var anhdaidien_post_value_db=$("input[type=file]").attr('value');

		// var anhdaidien_post_name=$("input[type=file]").val().split('\\').pop();

		// var anhdaidien_post=$("input[type=file]").prop('files')[0];

		// if(anhdaidien_post_name!=''){

		// 	// alert(anhdaidien_post_name);

		// 	if(anhdaidien_post_value_db!=anhdaidien_post_name){

		// 		var type_anhdaidien_post = anhdaidien_post.type;

		// 		if(type_anhdaidien_post == match[0] || type_anhdaidien_post == match[1] || type_anhdaidien_post == match[2]|| type_anhdaidien_post == match[3])

		// 		{

		// 			var form_data = new FormData();

		// 			//thêm files vào trong form data

		// 			form_data.append('file', anhdaidien_post);

		// 			// console.log(form_data);

		// 			  $.ajax({

		// 					url: 'update_post', // gửi đến file upload.php 

		// 					dataType: 'text',

		// 					cache: false,

		// 					contentType: false,

		// 					processData: false,

		// 					data: form_data,                       

		// 					type: 'post',

		// 					success: function(res){

		// 						// $('.status').text(res);

		// 						$('#img-avt-post').html(res);

		// 						// console.log(res); 

		// 				}

		// 			});

		// 		} 

		// 		else{

		// 			$('#img-avt-post').append('Chỉ được upload file ảnh');

		// 		}

		// 	}

		// }else{

		// 	anhdaidien_post_name=anhdaidien_post_value_db;

		// }

		//-------------------------------------

		var noidung_post=$("textarea[name='noidung']").val();

		var link_dr=$("input[name='link_dr']").val();

		var thuvienanh=$("input[name='thuvienanh']").val();

		var anhdaidien=$("input[name='anhdaidien']").val();

		var ngaycapnhat=$("input[name='ngaycapnhat']").val();

		var link_anhdaidien=$("input[name='link_anhdaidien']").val();

		var id_related_arr = [];

		$(".id_related input[type=checkbox]:checked").each(function() {

			id_related_arr.push($(this).val());

		});

		var id_related;

		id_related = id_related_arr.join(',') ;

		//------------ add val sp --------------

		var gia=0;

		var giakhuyenmai=0;

		var thongsokythuat='';

		var hotro='';

		if(typepost=='sanpham'){

			gia=$("input[name='gia']").val();

			giakhuyenmai=$("input[name='giakhuyenmai']").val();

			thongsokythuat=$("textarea[name='thongsokythuat']").val();

			hotro=$("textarea[name='hotro']").val();

			//---------- co bien the ----------

			var list_giatri = [];

			var list_meta = [];

			$('.form-sp-varible').each(function () {

				var id_giatrisp=this.id;

				//console.log(id_giatrisp);

			    //---- set giatrisp---//

			    	anhdaidien_ttsp=$("#"+id_giatrisp+" input[name=anhdaidien_ttsp]").val();

					gia_ttsp=$("#"+id_giatrisp+" input[name=gia_ttsp]").val();

					giakhuyenmai_ttsp=$("#"+id_giatrisp+" input[name=giakhuyenmai_ttsp]").val();

					title_sp_varial_label=$("#"+id_giatrisp+" .title_sp_varial_label").text();

					title_sp_varial_label_id=$("#"+id_giatrisp+" .title_sp_varial_label_id").text();

			  	    event.preventDefault();

				  	var value_rs = $("#"+id_giatrisp+" .title_sp_varial_label").map(function(){

				        return title_sp_varial_label;

				    }).toArray();

				  	var meta_rs = $("#"+id_giatrisp+" .title_sp_varial_label_id").map(function(){

				        return title_sp_varial_label_id;

				    }).toArray();

				  	value_rs.splice(1, 0, anhdaidien_ttsp);	

				  	value_rs.splice(2, 0, gia_ttsp);	

				  	value_rs.splice(3, 0, giakhuyenmai_ttsp);	

				  	list_giatri.push(value_rs);	

				  	list_meta.push(meta_rs);	      		   	  

			});

			//---------- goi bao hanh ----------

			var list_giatri_baohanh = [];

			var list_meta_baohanh = [];

			$('.form-sp-goibaohanh').each(function () {

				var id_giatrisp=this.id;

				//console.log(id_giatrisp);

			    //---- set giatrisp---//

					gia_baohanh=$("#"+id_giatrisp+" input[name=gia_baohanh]").val();

					title_sp_varial_label=$("#"+id_giatrisp+" .title_sp_varial_label").text();

					title_sp_varial_label_id=$("#"+id_giatrisp+" .title_sp_varial_label_id").text();

			  	    event.preventDefault();

				  	var value_baohanh_rs = $("#"+id_giatrisp+" .title_sp_varial_label").map(function(){

				        return title_sp_varial_label;

				    }).toArray();

				  	var meta_baohanh_rs = $("#"+id_giatrisp+" .title_sp_varial_label_id").map(function(){

				        return title_sp_varial_label_id;

				    }).toArray();

				  	value_baohanh_rs.splice(1, 0, gia_baohanh);	

				  	list_giatri_baohanh.push(value_baohanh_rs);	

				  	list_meta_baohanh.push(meta_baohanh_rs);	      		   	  

			});

			//------------------------

		}

		//-------------------------------------

		if(ten_post==''){

			setTimeout(function() {

				$("#result_setting_alert" ).empty().append('Bạn chưa nhập tên');

				$("input[name='ten']").focus();

			},1000);

			$("#result_setting_alert").addClass('alert_ad');

			$("#result_setting_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');	

		}else{

			var check_draft = $("#draft_post").prop("checked");

			if(check_draft) {

				var trangthai_post='0';

			} else {

				var trangthai_post='1';

			}

			$.ajax({

				type:'POST',

				url:'update_post',

				data:{

					'ten_post':ten_post,

					'seo_title_post':seo_title_post,

					'url_post':url_post,

					'keyword_post':keyword_post,

					'focus_keywords':focus_keywords,

					'idpostpr_post':idpostpr_post,

					'mota_post':mota_post,

					'noidung_post':noidung_post,

					'link_dr':link_dr,

					'typepost':typepost,

					'id_update':id_rs,

					'anhdaidien_post':anhdaidien,

					'link_anhdaidien':link_anhdaidien,

					'thuvienanh':thuvienanh,

					'menu_link':menu_link,

					'ngaycapnhat':ngaycapnhat,

					'id_slider':id_slider,

					'trangthai':trangthai_post,

					'id_related':id_related,

					'gia':gia,

					'giakhuyenmai':giakhuyenmai,							

					'thongsokythuat':thongsokythuat,

					'hotro':hotro,

					'meta':list_meta,

					'meta_value':list_giatri,

					'meta_baohanh':list_meta_baohanh,

					'meta_value_baohanh':list_giatri_baohanh

				},

				success: function(result){

					setTimeout(function() {

							// console.log(focus_keywords);

							window.location.href=link_dr;

						},1000

					);

						$("#result_setting_alert").addClass('alert_ad');

						$("#result_setting_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

				}

			});

		}

	});

	//-----

	$(document).on('click','#action_post_all_btn',function(){

		$("#result_action_alert").removeClass('alert_ad');

		$("#result_action_alert" ).empty();

		var link_dr=$("input[name='link_dr']").val();

		var action_vl=$('#action_post_all').val();

		var chkArray = [];

			$(".cb_post:checked").each(function() {

				chkArray.push($(this).val());

			});

			var list_id;

			list_id = chkArray.join(',') ;

			if(list_id.length > 0){

				//--- xu ly ----

				$.ajax({

					type:'POST',

					url:'action_post',

					data:{

						'action':action_vl,

						'list_id':list_id,

						'link_dr':link_dr,

					},

					success: function(result){

						// alert(result);

						// console.log(result);

						setTimeout(function() {

								window.location.href=link_dr;

							},1000

						);

						$("#result_action_alert").addClass('alert_ad');

						$("#result_action_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

					}

				});

				//---------//

			}else{

				setTimeout(function() {

						$("#result_action_alert" ).empty().append('Vui lòng chọn giá trị');

					},1000

				);

				$("#result_action_alert").addClass('alert_ad');

				$("#result_action_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

			}

	});

	//-------------

	$(document).on('submit','.frm-lienhe',function(){	

		var id_frm = $(this).attr("id");	

		var myData = $(this).serializeArray();	

		$.ajax(		

			{    

				type: 'POST',

				url: 'insert_config',    

				data:{				

					'name':id_frm,			

					'data':myData,		

				},            

				success: function(data){

					$('#'+id_frm+' .col-alert').removeClass('hide');		

					$('#'+id_frm+' input[type=submit]').prop('disabled', true);		

					$('#'+id_frm+' .col-alert div').html('<i class="fa fa-spinner fa-spin"></i> Vui lòng đợi trong giây lát ...');		

					setTimeout(function() {					

						$('#'+id_frm+' .col-alert div').empty();	

						$('#'+id_frm+' .col-alert div').html('Cấu hình đã được cập nhật');		

						$('#'+id_frm+' input[type=submit]').prop('disabled', false);			

						$('#'+id_frm)[0].reset();						

						},2000	

					);            

				}			

			}		

		);	

		return false;

	});

	//-------------

	$(document).ready(function() {

		$('.btn_add_user').click(function(){

			var hoten=$("input[name='hoten']").val();

			var email=$("input[name='email']").val();

			var matkhau=$("input[name='matkhau']").val();

			var link_dr=$("input[name='link_dr']").val();

			if(email=='' || matkhau==''){

				setTimeout(function() {

						$(".login-box-msg" ).empty().append('Vui lòng nhập đầy đủ thông tin');

					},0);

					$(".login-box-msg").addClass('alert_ad');

					$(".login-box-msg" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

			}else{

				var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

				if (!testEmail.test(email)){

					setTimeout(function() {

							$(".login-box-msg").empty().append('Không đúng cấu trúc của email');

						},1000

					);

					$(".login-box-msg").addClass('alert_ad');

					$(".login-box-msg" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

				}else{

					$.ajax({

						type:'POST',

						url:'insert_user',

						data:{

							'hoten':hoten,

							'email':email,

							'matkhau':matkhau,

						},

						success: function(result){

							console.log(result);

							if(result==0){

								setTimeout(function() {

									$(".login-box-msg" ).empty().append('Email đã tồn tại');

								},1000);

								$(".login-box-msg").addClass('alert_ad');

								$(".login-box-msg" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

							}else{

								// console.log(result);

								setTimeout(function() {

									window.location.href=link_dr;

								},1000);

								$(".login-box-msg").addClass('alert_ad');

								$(".login-box-msg" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

							}

						}

					});

				}

			}

		});

	});

	//-----------------------

	$(document).ready(function() {

		$('#filter_title_post').click(function(){

			var name_search_vl=$('input[name=title_post_filter]').val();

			var current_href=$(location).attr('href');

			var check_get=current_href.indexOf('?');

			if(check_get!=-1){

				window.location.href=current_href+'&title_post_filter='+name_search_vl;

			}else{

				window.location.href=current_href+'?title_post_filter='+name_search_vl;

			}

			// alert();

		});

	});

	$(document).ready(function() {

		$('.get_current_time').click(function(){

			var today = new Date();

			var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();

			var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

			var dateTime = date+' '+time;

			$('input[name=ngaycapnhat]').val(dateTime);

		});

	});

	$(document).ready(function() {

		$('select#product-type').change(function(){

			var id_slug=($(this).val());

			$('.product-type-gr').hide();

			$('#product-type-'+id_slug+'-gr').toggle();

		});

	});

	//---- function get tile sp ----------------//

	function mer_item(arr=[]){

		// arguments=arr;

	    const total_arr = arguments.length;

	   // console.log(total_arr);

	    var count=1;

	    var max_arr = arguments[0].length;

	    var max_arr_rs;// max lenght array

	    var arr_max_arr_rs;//array has max length

	    for(var m=0;m<total_arr;m++){

	   		count*=arguments[m].length;//max count

	   		if(arguments[m].length >= max_arr){

	   			max_arr_rs=arguments[m].length;

	   			arr_max_arr_rs=m;

	   		}

	    }

	    //console.log(count);

	    newArray=[];

	   	newArray_rs=[];

		//value_loop=count/max_arr_rs;//ko theo thu tu

		value_loop=count/arguments[0].length;// lay tu index0

		//console.log(value_loop);

		for(var j=0; j < value_loop  ; j++){

		    newArray = arguments[0].map((v) => {

			  	var temp_val = v;

			  		var i=1;

			        while(i<total_arr){

			    	    temp_val += ' * '+arguments[i][j];

			    	    i++;

			        }

			        return temp_val;

			    }

		    );

		    newArray_rs=newArray_rs.concat(newArray);

		}

	    return newArray_rs;

	}

	//------------ Thuoc tinh sp ------------------//

	$(document).ready(function() {

		$('button.add_thuoctinhsanpham').click(function(event){

			//merge-multiple-arrays-based-on-their-index-using-javascript

			var list_rs = [];

			var list_id_rs = [];

			var count_rows=1;

			$('.thuoctinhsanpham_gr').each(function () {

				var id_thuoctinhsanpham=this.id;

				id_thuoctinhsanpham_rs=id_thuoctinhsanpham.split('thuoctinhsanpham_gr_')[1];

			    //---- set giatrithuoctinhsp ---//

			  	    event.preventDefault();

				    var value_rs = $("input[name=giatrithuoctinhsanpham_ip_"+id_thuoctinhsanpham_rs+"]:checked").map(function(){

				        return this.value;

				    }).toArray();

				    var value_id_rs = $("input[name=giatrithuoctinhsanpham_ip_"+id_thuoctinhsanpham_rs+"]:checked").map(function(){

				        return this.id;

				    }).toArray();

				   	if(value_rs.length>0){

				   		count_rows*=value_rs.length;

				   		//value_rs.splice(0, 0, id_thuoctinhsanpham_rs);

				   		list_id_rs.push(value_id_rs);	//list id meta	

				   		list_rs.push(value_rs);	 

				   	}		   	  

			});

			//console.log(giatri_thuoctinhsanpham_rs);

			$(".list_sp_varible").empty();

			for (var i = 0; i < count_rows; i++) {

				//var length_array=(giatri_thuoctinhsanpham_rs[i].length);//count array in array

				var list_tt_rs_count=(list_rs.length)-1;

				if(list_tt_rs_count== 0){

					var title_sp_varial=mer_item(list_rs[0])[i];

					var title_sp_id_varial=mer_item(list_id_rs[0])[i];

				}

				else{

					if(list_tt_rs_count==1){

						var title_sp_varial=mer_item(list_rs[0],list_rs[1])[i];

						var title_sp_id_varial=mer_item(list_id_rs[0],list_id_rs[1])[i];

					}

					if(list_tt_rs_count==2){

						var title_sp_varial=mer_item(list_rs[0],mer_item(list_rs[2],list_rs[1]) )[i];

						var title_sp_id_varial=mer_item(list_id_rs[0],mer_item(list_id_rs[2],list_id_rs[1]) )[i];

					}

					if(list_tt_rs_count==3){

						var title_sp_varial=mer_item(list_rs[0], mer_item(list_rs[3],mer_item(list_rs[2],list_rs[1])) )[i];

						var title_sp_id_varial=mer_item(list_id_rs[0], mer_item(list_id_rs[3],mer_item(list_id_rs[2],list_id_rs[1])) )[i];

					}

					if(list_tt_rs_count==4){

						var title_sp_varial=mer_item(list_rs[0],mer_item(list_rs[4],mer_item(list_rs[3],mer_item(list_rs[2],list_rs[1]))) )[i];

						var title_sp_id_varial=mer_item(list_id_rs[0],mer_item(list_id_rs[4],mer_item(list_id_rs[3],mer_item(list_id_rs[2],list_id_rs[1]))) )[i];

					}

					if(list_tt_rs_count==5){

						var title_sp_varial=mer_item(list_rs[0],mer_item(list_rs[5],mer_item(list_rs[4],list_rs[3],mer_item(list_rs[2],list_rs[1])))) [i];

						var title_sp_id_varial=mer_item(list_id_rs[0],mer_item(list_id_rs[5],mer_item(list_id_rs[4],list_id_rs[3],mer_item(list_id_rs[2],list_id_rs[1])))) [i];

					}

					if(list_tt_rs_count==6){

						var title_sp_varial=mer_item(list_rs[0],mer_item(list_rs[6],mer_item(list_rs[5],mer_item(list_rs[4],list_rs[3],mer_item(list_rs[2],list_rs[1]))) ))[i];

						var title_sp_id_varial=mer_item(list_id_rs[0],mer_item(list_id_rs[6],mer_item(list_id_rs[5],mer_item(list_id_rs[4],list_id_rs[3],mer_item(list_id_rs[2],list_id_rs[1]))) ))[i];

					}

					if(list_tt_rs_count==7){

						var title_sp_varial=mer_item(list_rs[0],mer_item(list_rs[7],mer_item(list_rs[6],mer_item(list_rs[5],mer_item(list_rs[4],list_rs[3],mer_item(list_rs[2],list_rs[1]))) )))[i];

						var title_sp_id_varial=mer_item(list_id_rs[0],mer_item(list_id_rs[7],mer_item(list_id_rs[6],mer_item(list_id_rs[5],mer_item(list_id_rs[4],list_id_rs[3],mer_item(list_id_rs[2],list_id_rs[1]))) )))[i];

					}

				}

				//-------------- edit------//

				var array_thuoctinh_value=$('input[name=giatrithuoctinhsanpham_'+i+']').val();//value to edit

				if(array_thuoctinh_value){

					var array_thuoctinh_value_split=array_thuoctinh_value.split(',');

					var anhdaidien_edit=array_thuoctinh_value_split[1];

					var gia_edit=array_thuoctinh_value_split[2];

					var giakhuyenmai_edit=array_thuoctinh_value_split[3];

				}

				//------------------------//

				var current_url = '/';

				if(anhdaidien_edit!=undefined){

					var link_img_cs='/upload/'+anhdaidien_edit;

					var current_url_img = '<img src="'+link_img_cs+'" alt="Ảnh đại diện" width="60px" height="70px" />';

				}else{

					var current_url_img = '';

				}

				if(title_sp_varial!=undefined){

					var html_sp_varible='<div class="form-group-gr form-group form-sp-varible col-lg-6 col-xs-12" id="giatrithuoctinhsanpham_'+i+'">'+

							'<div class="form-group title_sp_varial">'+

								'<label class="title_sp_varial_label">'+title_sp_varial+'</label>'+

								'<label class="title_sp_varial_label_id" hidden>'+title_sp_id_varial+'</label>'+

							'</div>'+

							'<div class="form-group">'+

								'<label>Ảnh đại diện</label><br>'+

								current_url_img+

								'<a href="javascript:open_popup('+"'"+current_url+'filemanager/dialog.php?type=1&amp;field_id=anhdaidien_edit_'+i+'&amp;relative_url=1&amp;multiple=1&akey=adkey_dmsKHpm5624sf&popup=1'+"'"+')" class="btn btn btn-primary iframe-btn" type="button">Ảnh đại diện</a>'+

								'<input type="text" name="anhdaidien_ttsp" id="anhdaidien_edit_'+i+'" value="'+anhdaidien_edit+'" placeholder="Nhập giá tại đây" hidden disabled>'+

							'</div>'+

							'<div class="form-group">'+

								'<label>Giá</label>'+

								'<input type="number" class="form-control" name="gia_ttsp" value="'+gia_edit+'" placeholder="Nhập giá tại đây">'+

							'</div>'+

							'<div class="form-group">'+

								'<label>Giá khuyến mãi</label>'+

								'<input type="number" class="form-control" name="giakhuyenmai_ttsp" value="'+giakhuyenmai_edit+'" placeholder="Nhập giá khuyến mãi tại đây">'

							+'</div>'+	

						'</div>';

					$(".list_sp_varible").append(html_sp_varible);

				}

			}

		});

	});

	//-----------------------------------------//

	$(document).ready(function() {

		$('button.save_thuoctinhsanpham').click(function(event){

			var list_giatri = [];

			var list_meta = [];

			$('.form-sp-varible').each(function () {

				var id_giatrisp=this.id;

				//console.log(id_giatrisp);

			    //---- set giatrisp---//

			    	anhdaidien_ttsp=$("#"+id_giatrisp+" input[name=anhdaidien_ttsp]").val();

					gia_ttsp=$("#"+id_giatrisp+" input[name=gia_ttsp]").val();

					giakhuyenmai_ttsp=$("#"+id_giatrisp+" input[name=giakhuyenmai_ttsp]").val();

					title_sp_varial_label=$("#"+id_giatrisp+" .title_sp_varial_label").text();

					title_sp_varial_label_id=$("#"+id_giatrisp+" .title_sp_varial_label_id").text();

			  	    event.preventDefault();

				  	var value_rs = $("#"+id_giatrisp+" .title_sp_varial_label").map(function(){

				        return title_sp_varial_label;

				    }).toArray();

				  	var meta_rs = $("#"+id_giatrisp+" .title_sp_varial_label_id").map(function(){

				        return title_sp_varial_label_id;

				    }).toArray();

				  	value_rs.splice(1, 0, anhdaidien_ttsp);	

				  	value_rs.splice(2, 0, gia_ttsp);	

				  	value_rs.splice(3, 0, giakhuyenmai_ttsp);	

				  	list_giatri.push(value_rs);	

				  	list_meta.push(meta_rs);	      		   	  

			});

			// console.log(list_giatri);

			// console.log(list_meta);

		});	

	});

	//------------ goibaohanh ------------------//

	$(document).ready(function() {

		$('button.add_goibaohanh').click(function(event){

			//merge-multiple-arrays-based-on-their-index-using-javascript

			var list_rs = [];

			var list_id_rs = [];

			var count_rows=1;

			$('.thuoctinhsanpham_gr').each(function () {

				var id_thuoctinhsanpham=this.id;

				id_thuoctinhsanpham_rs=id_thuoctinhsanpham.split('goibaohanh_gr_')[1];

			    //---- set giatrithuoctinhsp ---//

			  	    event.preventDefault();

				    var value_rs = $("input[name=goibaohanh_ip_"+id_thuoctinhsanpham_rs+"]:checked").map(function(){

				        return this.value;

				    }).toArray();

				    var value_id_rs = $("input[name=goibaohanh_ip_"+id_thuoctinhsanpham_rs+"]:checked").map(function(){

				        return this.id;

				    }).toArray();

				   	if(value_rs.length>0){

				   		count_rows*=value_rs.length;

				   		//value_rs.splice(0, 0, id_thuoctinhsanpham_rs);

				   		list_id_rs.push(value_id_rs);	//list id meta	

				   		list_rs.push(value_rs);	 

				   	}		   	  

			});

			//console.log(giatri_thuoctinhsanpham_rs);

			$(".list_sp_baohanh").empty();

			for (var i = 0; i < count_rows; i++) {

				//var length_array=(giatri_thuoctinhsanpham_rs[i].length);//count array in array

				var list_tt_rs_count=(list_rs.length)-1;

				if(list_tt_rs_count== 0){

					var title_sp_varial=mer_item(list_rs[0])[i];

					var title_sp_id_varial=mer_item(list_id_rs[0])[i];

				}

				else{

					if(list_tt_rs_count==1){

						var title_sp_varial=mer_item(list_rs[0],list_rs[1])[i];

						var title_sp_id_varial=mer_item(list_id_rs[0],list_id_rs[1])[i];

					}

					if(list_tt_rs_count==2){

						var title_sp_varial=mer_item(list_rs[0],mer_item(list_rs[2],list_rs[1]) )[i];

						var title_sp_id_varial=mer_item(list_id_rs[0],mer_item(list_id_rs[2],list_id_rs[1]) )[i];

					}

					if(list_tt_rs_count==3){

						var title_sp_varial=mer_item(list_rs[0], mer_item(list_rs[3],mer_item(list_rs[2],list_rs[1])) )[i];

						var title_sp_id_varial=mer_item(list_id_rs[0], mer_item(list_id_rs[3],mer_item(list_id_rs[2],list_id_rs[1])) )[i];

					}

					if(list_tt_rs_count==4){

						var title_sp_varial=mer_item(list_rs[0],mer_item(list_rs[4],mer_item(list_rs[3],mer_item(list_rs[2],list_rs[1]))) )[i];

						var title_sp_id_varial=mer_item(list_id_rs[0],mer_item(list_id_rs[4],mer_item(list_id_rs[3],mer_item(list_id_rs[2],list_id_rs[1]))) )[i];

					}

					if(list_tt_rs_count==5){

						var title_sp_varial=mer_item(list_rs[0],mer_item(list_rs[5],mer_item(list_rs[4],list_rs[3],mer_item(list_rs[2],list_rs[1])))) [i];

						var title_sp_id_varial=mer_item(list_id_rs[0],mer_item(list_id_rs[5],mer_item(list_id_rs[4],list_id_rs[3],mer_item(list_id_rs[2],list_id_rs[1])))) [i];

					}

					if(list_tt_rs_count==6){

						var title_sp_varial=mer_item(list_rs[0],mer_item(list_rs[6],mer_item(list_rs[5],mer_item(list_rs[4],list_rs[3],mer_item(list_rs[2],list_rs[1]))) ))[i];

						var title_sp_id_varial=mer_item(list_id_rs[0],mer_item(list_id_rs[6],mer_item(list_id_rs[5],mer_item(list_id_rs[4],list_id_rs[3],mer_item(list_id_rs[2],list_id_rs[1]))) ))[i];

					}

					if(list_tt_rs_count==7){

						var title_sp_varial=mer_item(list_rs[0],mer_item(list_rs[7],mer_item(list_rs[6],mer_item(list_rs[5],mer_item(list_rs[4],list_rs[3],mer_item(list_rs[2],list_rs[1]))) )))[i];

						var title_sp_id_varial=mer_item(list_id_rs[0],mer_item(list_id_rs[7],mer_item(list_id_rs[6],mer_item(list_id_rs[5],mer_item(list_id_rs[4],list_id_rs[3],mer_item(list_id_rs[2],list_id_rs[1]))) )))[i];

					}

				}

				//-------------- edit------//

				var array_thuoctinh_value=$('input[name=goibaohanh_ip_'+i+']').val();//value to edit

				console.log(array_thuoctinh_value);

				if(array_thuoctinh_value){

					var array_thuoctinh_value_split=array_thuoctinh_value.split(',');

					var gia_edit=array_thuoctinh_value_split[1];

				}

				//------------------------//

				if(title_sp_varial!=undefined){

					var html_sp_varible='<div class="form-group-gr form-group form-sp-goibaohanh col-lg-6 col-xs-12" id="goibaohanh_ip_'+i+'">'+

						'<div class="form-group title_sp_varial">'+

							'<label class="title_sp_varial_label">'+title_sp_varial+'</label>'+

							'<label class="title_sp_varial_label_id" hidden>'+title_sp_id_varial+'</label>'+

						'</div>'+

						'<div class="form-group">'+

							'<label>Giá cộng thêm</label>'+

							'<input type="number" class="form-control" name="gia_baohanh" value="'+gia_edit+'" placeholder="Nhập giá tại đây">'+

						'</div>'+

					'</div>';

					$(".list_sp_baohanh").append(html_sp_varible);	

				}

			}

		});

	});

	//-----------------------------------------//

	//-----------------------------//

	$(document).ready(function() {

		$('button[name=update_donhang]').click(function(){

			$("#result_setting_alert").removeClass('alert_ad');

			$("#result_setting_alert" ).empty();

			var id=$("input[name=id_donhang]" ).val();

			var ghichu=$("textarea[name=ghichu]" ).val();

			var trangthai=$("select[name=trangthai]" ).val();

			$.ajax({

				type:'POST',

				url:'update_donhang',

				data:{

					'id':id,

					'ghichu':ghichu,

					'trangthai':trangthai

				},

				success: function(data){

					setTimeout(function() {

						console.log(data);

						if(data=="0"){

							alert('Xảy ra lỗi trong quá trình xử lý, vui lòng thử lại');

						}else{

							//alert(data) ;

							window.location.href=data;

						}	

					},1000);

					$("#result_setting_alert").addClass('alert_ad');

					$("#result_setting_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

				}

			});

		});

	});

	//--------------------------------//

	$(document).ready(function() {

		$('button[name=update_tragop]').click(function(){

			$("#result_setting_alert").removeClass('alert_ad');

			$("#result_setting_alert" ).empty();

			var id=$("input[name=id_donhang]" ).val();

			var ghichu=$("textarea[name=ghichu]" ).val();

			var trangthai=$("select[name=trangthai]" ).val();

			$.ajax({

				type:'POST',

				url:'update_tragop',

				data:{

					'id':id,

					'ghichu':ghichu,

					'trangthai':trangthai

				},

				success: function(data){

					setTimeout(function() {

						console.log(data);

						if(data=="0"){

							alert('Xảy ra lỗi trong quá trình xử lý, vui lòng thử lại');

						}else{

							//alert(data) ;

							window.location.href=data;

						}	

					},1000);

					$("#result_setting_alert").addClass('alert_ad');

					$("#result_setting_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');

				}

			});

		});

	});

	//--------------------------------//

	$(document).ready(function() {

		var current_url=window.location.href;

		var check_type_sp=current_url.includes('?post_type=sanpham&edit');

		//console.log(check_type_sp)

		if(check_type_sp==true){

			$('.add_thuoctinhsanpham').click();	

			$('.add_goibaohanh').click();	

		}

   	});

	//-------------------------------//

	$(document).ready(function() {

		$('span.close-anhdaidien-tva').click(function(){

			var id=$(this).attr('id');

			id=id.split('close-');

			id=id[1];

			$('#group-'+id+'-ad input[name='+id+']').val('');

			$('#group-'+id+'-ad .list-img').empty();

		});

	});

	//-------------------------------//

})(jQuery);
