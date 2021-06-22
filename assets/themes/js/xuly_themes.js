(function($){
	$(document).on('click','#register_btn',function(){//login member
		$(".result_action_alert").removeClass('alert_ad');
		$(".result_action_alert" ).empty();
		var hoten=$("input[name='name']").val();
		var email=$("input[name='email']").val();
		var sodienthoai=$("input[name='mobile']").val();
		var matkhau=$("input[name='password']").val();
		var re_matkhau=$("input[name='retype_password']").val();
		var link_dr=$("input[name='link_dr']").val();
		var link_xuly=$("input[name='link_xuly']").val();
		var type_register=$("input[name='type_register']").val();
		if(hoten=='' || email=='' || sodienthoai=='' || matkhau=='' || re_matkhau==''){
			setTimeout(function() {
					$(".result_action_alert" ).empty().append('Vui lòng nhập hết giá trị');
					$("input[name='name']").focus();
					$("#login").prop("disabled",false);
				},1000
			);
			$("#login").prop("disabled",true);
			$(".result_action_alert").addClass('alert_ad');
			$(".result_action_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
		}else{//check email
				var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
				if (!testEmail.test(email)){
					setTimeout(function() {
							$(".result_action_alert" ).empty().append('Không đúng cấu trúc của email');
							$("input[name='email']").focus();
							$("#login").prop("disabled",false);
						},1000
					);
					$("#login").prop("disabled",true);
					$(".result_action_alert").addClass('alert_ad');
					$(".result_action_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
			}
			else{
				if(matkhau!=re_matkhau){//check not type pass
						setTimeout(function() {
							$(".result_action_alert" ).empty().append('Không trùng khớp mật khẩu');
							$("input[name='matkhau']").focus();
							$("#login").prop("disabled",false);
						},1000
					);
					$("#login").prop("disabled",true);
					$(".result_action_alert").addClass('alert_ad');
					$(".result_action_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
				}else{
					if(matkhau.length<8){
						setTimeout(function() {
								$(".result_action_alert" ).empty().append('Mật khẩu phải ít nhất 8 ký tự');
								$("input[name='matkhau']").focus();
								$("#login").prop("disabled",false);
							},1000
						);
						$("#login").prop("disabled",true);
						$(".result_action_alert").addClass('alert_ad');
						$(".result_action_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
					}else{//xu ly
						$.ajax({
							type:'POST',
							url:link_xuly,
							data:{
								'hoten':hoten,
								'email':email,
								'sodienthoai':sodienthoai,
								'matkhau':matkhau,
								'type_register':type_register,
							},
							success: function(result){
								// console.log(result);
								if(result!=0){
									setTimeout(function() {
											$(".result_action_alert" ).empty().append('Email đã tồn tại');
										},1000
									);
									$(".result_action_alert").addClass('alert_ad');
									$(".result_action_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
								}else{
									setTimeout(function() {
											window.location.href=link_dr;
										},1000
									);
									$(".result_action_alert").addClass('alert_ad');
									$(".result_action_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
								}
							}
						});
					}
				}
			}
		}	
	});
	//--------------------
	$(document).on('focusout','#input-email',function(){//login member
		var email=$("input[name='email']").val();
		var link_xuly_tengiasu=$("input[name='link_xuly_tengiasu']").val();
		$.ajax({
			type:'POST',
			url:link_xuly_tengiasu,
			data:{
				'email':email,
			},
			success: function(result){
				if(result!=0){
					setTimeout(function() {
							$("#error_email").removeClass('hidden');
							$("#error_email" ).empty().append('Email này đã được sử dụng');
							$("input[name='mobile']").prop("disabled",true);
							$("input[name='password']").prop("disabled",true);
							$("input[name='retype_password']").prop("disabled",true);
							$("button#register_btn").prop("disabled",true);
						},1000
					);
					$("#error_email").addClass('alert_ad');
					$("#error_email" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
				}else{
					setTimeout(function() {
							$("#error_email").removeClass('hidden');
							$("#error_email" ).empty().append('Bạn có thể sử dụng email này');
							$("input[name='mobile']").prop("disabled",false);
							$("input[name='password']").prop("disabled",false);
							$("input[name='retype_password']").prop("disabled",false);
							$("button#register_btn").prop("disabled",false);
						},1000
					);
					$("#error_email").addClass('alert_ad');
					$("#error_email" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
				}
			}
		});
	});
	//--------------------
	$(document).on('click','#bg-password',function(){
		$("#input-password").prop("type", "text");
		$("#old_password").prop("type", "text");
		$("#bg-password").hide();		
		$("#bg-password-show").show();
	});
	$(document).on('click','#bg-password-show',function(){
		$("#input-password").prop("type", "password");
		$("#old_password").prop("type", "password");
		$("#bg-password-show").hide();		
		$("#bg-password").show();
	});
	$(document).on('click','#bg-confirm-password',function(){
		$("#confirm_password").prop("type", "text");
		$("#bg-confirm-password").hide();		
		$("#bg-confirm-password-show").show();
	});
	$(document).on('click','#bg-confirm-password-show',function(){
		$("#confirm_password").prop("type", "password");
		$("#bg-confirm-password").show();		
		$("#bg-confirm-password-show").hide();
	});
	$(document).on('click','#bg-password-new',function(){
		$("#password").prop("type", "text");
		$("#bg-password-new").hide();		
		$("#bg-password-new-show").show();
	});
	$(document).on('click','#bg-password-new-show',function(){
		$("#password").prop("type", "password");
		$("#bg-password-new").show();		
		$("#bg-password-new-show").hide();
	});
	//-------- LOGIN USER ----------
	$(document).on('click','#btn_login_tv',function(){//login member
		$(".result_action_alert").removeClass('alert_ad');
		$(".result_action_alert" ).empty();
		var email=$("input[name='email']").val();
		var matkhau=$("input[name='password']").val();
		var link_dr=$("input[name='link_dr']").val();
		var link_xuly=$("input[name='link_xuly']").val();
		var typethanhvien=$("input[name='typethanhvien']").val();
		if(email=='' || matkhau==''){
			setTimeout(function() {
					$(".result_action_alert" ).empty().append('Vui lòng nhập hết giá trị');
					$("input[name='name']").focus();
					$("#login").prop("disabled",false);
				},1000
			);
			$("#login").prop("disabled",true);
			$(".result_action_alert").addClass('alert_ad');
			$(".result_action_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
		}else{
			$.ajax({
				type:'POST',
				url:link_xuly,
				data:{
					'email':email,
					'matkhau':matkhau,
					'typethanhvien':typethanhvien,
				},
				success: function(result){
					// console.log(result);
					if(result==0){
						setTimeout(function() {
								$(".result_action_alert" ).empty().append('Email hoặc mật khẩu không tồn tại');
							},1000
						);
						$(".result_action_alert").addClass('alert_ad');
						$(".result_action_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
					}else{
						setTimeout(function() {
								window.location.href=link_dr;
							},1000
						);
						$(".result_action_alert").addClass('alert_ad');
						$(".result_action_alert" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
					}
				}
			});
		}
	});
	//-------UPDATE EMAIL -----------
	$(document).on('click','#btn_update_email_user',function(){//login member
		$("#error_email").addClass('hidden');
		$("#error_email" ).empty();
		var old_email=$("input[name='old_email']").val();
		var email=$("input[name='email']").val();
		var typethanhvien=$("input[name='typethanhvien']").val();
		var link_dr=$("input[name='link_dr']").val();
		var link_xuly=$("input[name='link_xuly']").val();
		if(email=='' || typethanhvien=='' || old_email==''){
			setTimeout(function() {
					$("#error_email" ).empty().append('Vui lòng nhập hết giá trị');
					$("input[name='email']").focus();
					$("#btn_update_email_user").prop("disabled",false);
				},1000
			);
			$("#btn_update_email_user").prop("disabled",true);
			$("#error_email").removeClass('hidden');
			$("#error_email" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
		}else{
			var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
			if (!testEmail.test(email)){
				setTimeout(function() {
						$("#error_email").empty().append('Không đúng cấu trúc của email');
						$("input[name='email']").focus();
						$("#btn_update_email_user").prop("disabled",false);
					},1000
				);
				$("#btn_update_email_user").prop("disabled",true);
				$("#error_email").removeClass('hidden');
				$("#error_email" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
			}else{
				$.ajax({
					type:'POST',
					url:link_xuly,
					data:{
						'old_email':old_email,
						'email':email,
						'typethanhvien':typethanhvien,
					},
					success: function(result){
						//console.log(result);
						if(result!=0){
							setTimeout(function() {
									$("#error_email" ).empty().append('Email đã tồn tại!');
								},1000
							);
							$("#error_email").removeClass('hidden');
							$("#error_email" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
						}else{
							setTimeout(function() {
									window.location.href=link_dr;
								},1000
							);
							$("#error_email").removeClass('hidden');
							$("#error_email" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
						}
					}
				});
			}
		}
	});
	//-------UPDATE SDT -----------
	$(document).on('click','#btn_update_sodienthoai_user',function(){//login member
		$("#error_mobile").addClass('hidden');
		$("#error_mobile" ).empty();
		var old_email=$("input[name='old_email']").val();
		var sodienthoai=$("input[name='sodienthoai']").val();
		var typethanhvien=$("input[name='typethanhvien']").val();
		var link_dr=$("input[name='link_dr']").val();
		var link_xuly=$("input[name='link_xuly']").val();
		if(old_email=='' || typethanhvien=='' || sodienthoai==''){
			setTimeout(function() {
					$("#error_mobile" ).empty().append('Vui lòng nhập hết giá trị');
					$("input[name='sodienthoai']").focus();
					$("#btn_update_sodienthoai_user").prop("disabled",false);
				},1000
			);
			$("#btn_update_sodienthoai_user").prop("disabled",true);
			$("#error_mobile").removeClass('hidden');
			$("#error_mobile" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
		}else{
			if ($.isNumeric(sodienthoai)==false){
				setTimeout(function() {
						$("#error_mobile").empty().append('Phải là 1 dãy số');
						$("input[name='sodienthoai']").focus();
						$("#btn_update_sodienthoai_user").prop("disabled",false);
					},1000
				);
				$("#btn_update_sodienthoai_user").prop("disabled",true);
				$("#error_mobile").removeClass('hidden');
				$("#error_mobile" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
			}else{
				$.ajax({
					type:'POST',
					url:link_xuly,
					data:{
						'email':old_email,
						'sodienthoai':sodienthoai,
						'typethanhvien':typethanhvien,
					},
					success: function(result){
						//console.log(result);
						if(result!=0){
							setTimeout(function() {
									$("#error_mobile" ).empty().append('Số điện thoại đã tồn tại!');
								},1000
							);
							$("#error_mobile").removeClass('hidden');
							$("#error_mobile" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
						}else{
							setTimeout(function() {
									window.location.href=link_dr;
								},1000
							);
							$("#error_mobile").removeClass('hidden');
							$("#error_mobile" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
						}
					}
				});
			}
		}
	});
	//-------UPDATE PASSWORD -----------
	$(document).on('click','#btn_update_password_user',function(){//login member
		$("#error_old_password").addClass('hidden');
		$("#error_password").addClass('hidden');
		$("#error_confirm_password").addClass('hidden');
		$("#error_old_password" ).empty();
		$("#error_password" ).empty();
		$("#error_confirm_password" ).empty();
		var email=$("input[name='email']").val();
		var typethanhvien=$("input[name='typethanhvien']").val();
		var old_password=$("input[name='old_password']").val();
		var new_password=$("input[name='password']").val();
		var confirm_password=$("input[name='confirm_password']").val();
		var link_dr=$("input[name='link_dr']").val();
		var link_xuly=$("input[name='link_xuly']").val();
		if(email=='' || typethanhvien=='' || old_password=='' || new_password=='' || confirm_password==''){
			if(old_password==''){
				setTimeout(function() {
						$("#error_old_password" ).empty().append('Vui lòng nhập giá trị');
						$("input[name='old_password']").focus();
						$("#btn_update_password_user").prop("disabled",false);
					},1000
				);
				$("#btn_update_password_user").prop("disabled",true);
				$("#error_old_password").removeClass('hidden');
				$("#error_old_password" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
			}
			if(new_password==''){
				setTimeout(function() {
						$("#error_password" ).empty().append('Vui lòng nhập giá trị');
						$("input[name='password']").focus();
						$("#btn_update_password_user").prop("disabled",false);
					},1000
				);
				$("#btn_update_password_user").prop("disabled",true);
				$("#error_password").removeClass('hidden');
				$("#error_password" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
			}
			if(confirm_password==''){
				setTimeout(function() {
						$("#error_confirm_password" ).empty().append('Vui lòng nhập giá trị');
						$("input[name='confirm_password']").focus();
						$("#btn_update_password_user").prop("disabled",false);
					},1000
				);
				$("#btn_update_password_user").prop("disabled",true);
				$("#error_confirm_password").removeClass('hidden');
				$("#error_confirm_password" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
			}
		}else{
			if(new_password!=confirm_password){
				setTimeout(function() {
						$("#error_confirm_password" ).empty().append('2 mật khẩu không trùng khớp');
						$("input[name='password']").val('');
						$("input[name='confirm_password']").val('');
						$("input[name='password']").focus();
						$("#btn_update_password_user").prop("disabled",false);
					},1000
				);
				$("#btn_update_password_user").prop("disabled",true);
				$("#error_confirm_password").removeClass('hidden');
				$("#error_confirm_password" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
			}else{
				if(new_password.length<8){
						setTimeout(function() {
								$("#btn_update_password_user").prop("disabled",false);
								$("#error_password" ).empty().append('Mật khẩu phải ít nhất 8 ký tự');
								$("input[name='password']").focus();
							},1000
						);
						$("#btn_update_password_user").prop("disabled",true);
						$("#error_password").removeClass('hidden');
						$("#error_password" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
				}else{
					$.ajax({
						type:'POST',
						url:link_xuly,
						data:{
							'email':email,
							'old_password':old_password,
							'new_password':new_password,
							'typethanhvien':typethanhvien,
						},
						success: function(result){
							// console.log(result);
							if(result==0){
								setTimeout(function() {
										$("#error_old_password" ).empty().append('Mât khẩu cũ không đúng!');
									},1000
								);
								$("#error_old_password").removeClass('hidden');
								$("#error_old_password" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
							}else{
								setTimeout(function() {
										window.location.href=link_dr;
									},1000
								);
								$("#error_confirm_password").removeClass('hidden');
								$("#error_confirm_password" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
							}
						}
					});
				}
			}
		}
	});
	//-------UPDATE PASSWORD -----------
	$(document).on('click','#btn_update_infor_user',function(){
		$("#error_update_infor").addClass('hidden');
		$("#error_update_infor" ).empty();
		var ten			=$("input[name='name']").val();
		var day			=$("select[name='day']").val();
		var month		=$("select[name='month']").val();
		var year		=$("select[name='year']").val();
		var gioitinh	=$("input[name='gioitinh']:checked").val();
		var honnhan		=$("input[name='tinhtrang']:checked").val();
		var diachi		=$("input[name='diachi']").val();
		var thanhpho	=$("select[name='thanhpho']").val();
		var ngaysinh	=year+"-"+month+"-"+day+" 00:00:00";
		var id_user		=$("input[name='id_user']").val();
		var link_dr		=$("input[name='link_dr']").val();
		var link_xuly	=$("input[name='link_xuly']").val();
		//console.log(day+month+year+gioitinh+honnhan+diachi+thanhpho+ten);
		if(ten=='' || day=='' || month=='' || year=='' || gioitinh=='' || tinhtrang=='' || diachi=='' || thanhpho=='' || id_user =='' || link_dr=='' || link_xuly==''){
			setTimeout(function() {
					$("#error_update_infor" ).empty().append('Vui lòng nhập hết giá trị');
					$("#btn_update_infor_user").prop("disabled",false);
				},1000
			);
			$("#btn_update_infor_user").prop("disabled",true);
			$("#error_update_infor").removeClass('hidden');
			$("#error_update_infor" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
		}else{
			$.ajax({
				type:'POST',
				url:link_xuly,
				data:{
					'id':id_user,
					'hoten':ten,
					'ngaysinh':ngaysinh,
					'gioitinh':gioitinh,
					'honnhan':honnhan,
					'tinh':thanhpho,
					'diachi':diachi,
				},
				success: function(result){
					// console.log(result);
					setTimeout(function() {
							window.location.href=link_dr;
						},1000
					);
					$("#error_update_infor").removeClass('hidden');
					$("#error_update_infor" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
				}
			});
		}
	});
	//-----------------
	//-------UPDATE PASSWORD -----------
	$(document).on('click','#btn_creat_cv_giasu',function(){
		$("#error_creat_cv_giasu").addClass('hidden');
		$("#error_creat_cv_giasu" ).empty();
		var id_user		=$("input[name='id_user']").val();
		var link_dr		=$("input[name='link_dr']").val();
		var link_xuly	=$("input[name='link_xuly']").val();
		var chkmonday = [];
		$("input[name='monday']:checked").each(function() {
			chkmonday.push($(this).val());
		});
		var chklopday = [];
		$("input[name='lopday']:checked").each(function() {
			chklopday.push($(this).val());
		});
		var chkthoigianday = [];
		$("input[name='thoigianday']:checked").each(function() {
			chkthoigianday.push($(this).val());
		});
		var tinhday	=$("select[name='tinhday']").val();
		var luong	=$("input[name='luong']").val();
		var yeucaukhac	=$("textarea[name='yeucaukhac']").val();
		// console.log(chkmonday+'-'+chklopday+'-'+chkthoigianday+'-'+luong+'-'+yeucaukhac);
		if(id_user=='' || link_dr=='' || link_xuly=='' || chkmonday=='' || chklopday=='' || chkthoigianday=='' || luong=='' || tinhday==''){
			setTimeout(function() {
					$("#error_creat_cv_giasu" ).empty().append('Vui lòng nhập hết giá trị');
					$("#btn_creat_cv_giasu").prop("disabled",false);
				},1000
			);
			$("#btn_creat_cv_giasu").prop("disabled",true);
			$("#error_creat_cv_giasu").removeClass('hidden');
			$("#error_creat_cv_giasu" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
		}else{
			if ($.isNumeric(luong)==false){
				setTimeout(function() {
						$("#error_luong").empty().append('Lương phải là 1 dãy số');
						$("input[name='luong']").focus();
						$("#btn_creat_cv_giasu").prop("disabled",false);
					},1000
				);
				$("#btn_creat_cv_giasu").prop("disabled",true);
				$("#error_luong").removeClass('hidden');
				$("#error_luong" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
			}else{
				$.ajax({
					type:'POST',
					url:link_xuly,
					data:{
						'id':id_user,
						'monday':chkmonday,
						'lopday':chklopday,
						'thoigianday':chkthoigianday,
						'luong':luong,
						'tinhday':tinhday,
						'yeucaukhac':yeucaukhac,
					},
					success: function(result){
						// console.log(result);
						setTimeout(function() {
								window.location.href=link_dr;
							},1000
						);
						$("#error_creat_cv_giasu").removeClass('hidden');
						$("#error_creat_cv_giasu" ).empty().append('Đang xử lý ... <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
					}
				});
			}
		}
	});
	//---------------------
	$(document).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.scroll-top-link').fadeIn();
			$('header').addClass('fixed');
			$('body').addClass('fixed');
		} else {
			$('.scroll-top-link').fadeOut();
			$('header').removeClass('fixed');
			$('body').removeClass('fixed')
		}
	});
	$(document).on('click','#back-top',function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});
	$(document).on('click','#link_register_online',function(){
		$('#dangkyonline_popup').addClass('show');
		return false;
	});
	$(document).on('click','#dangkyonline_popup #close_modal',function(){
		$('#dangkyonline_popup').removeClass('show');
		return false;
	});
	$(document).on('click','#link_thamquantruong',function(){
		$('#dangkythamquantruong_popup').addClass('show');
		return false;
	});
	$(document).on('click','#dangkythamquantruong_popup #close_modal',function(){
		$('#dangkythamquantruong_popup').removeClass('show');
		return false;
	});	
	$(document).on('submit','.frm-lienhe',function(){	
		var id_frm = $(this).attr("id");	
		var myData = $(this).serializeArray();	
		$.ajax(		
			{    
				type: 'POST',
				url: BASE_URL + 'page/insert_lienhe',
				data:{				
					'name':id_frm,			
					'data':myData,		
				},
				beforeSend: function() {
					$('#'+id_frm+' .col-alert').removeClass('hide');
					$('#'+id_frm+' .col-alert div').html('<i class="fa fa-spinner fa-spin"></i> Vui lòng đợi trong giây lát ...');
					$('#'+id_frm+' input[type=submit]').prop('disabled', true);
				},
				success: function(data){
					setTimeout(function() {
						//$('#'+id_frm+' .col-alert div').empty();
						if ('frm_dangky_nhanbantin' == id_frm) {
							$('#'+id_frm+' .col-alert div').html('Cảm ơn quý khách đã đăng ký thông tin.');
						}
						else {
							$('#'+id_frm+' .col-alert div').html('Thông tin của bạn đã được gởi đi !');
						}
						$('#'+id_frm+' input[type=submit]').prop('disabled', false);		
						$('#'+id_frm+' input[type=submit]').prop('disabled', false);				
						$('#'+id_frm)[0].reset();
					}, 100);
				}			
			}		
		);	
		return false;
	});
	$(document).on('click','header .navbar-toggle',function(e){//login member	
		$(this).toggleClass("collapsed");
		$('#header-menu-top').toggleClass('menu-mobile');
		$('#header-menu-top').toggleClass('hidden-xs');
	});
	$(document).on('click','.show-more-block',function(e){
		var id_pr=$(this).parent().attr('id');
		// alert(id_pr);
		$("#"+id_pr+" .block-content").addClass("showall");
		$("#"+id_pr+" .show-more-block").hide();
	});
	$(document).on('change','.pa_select',function(e){
		$( ".price-group .price" ).empty();
		$(".btn_submit_addtocart").empty();
		$( ".price-group" ).removeClass('margin-15');
		var price_baohanh_selected='';
		var price_sp = "";
		var price_baohanh = "";
	    $( "select.pa_select option:selected" ).each(function() {
	      	price_sp = $(this).data('giasp');
	      	price_baohanh = $( this ).data('giabaohanh');
	      	price_baohanh_selected = $("select.pa_select_goibaohanh option:selected").val();
	      	// console.log(price_baohanh_selected);
	      	// console.log(price_sp);
	      	// price_baohanh_selected!=0 || 
	      	if( ( (price_baohanh_selected!=undefined ) && price_sp!='Liên hệ hotline 0365234567') ) {
	      		price_sp=formatDollar(parseInt(price_baohanh)+parseInt(price_baohanh_selected));//gia co bao hanh
	      	}
	      	if(price_sp!='Liên hệ hotline 0365234567'){
	      		$( ".price-group" ).addClass('margin-15');
	      		$(".btn_submit_addtocart").append('<button type="submit" class="single_add_to_cart_button button alt">MUA NGAY<span>Giao tận nơi hoặc nhận ở cửa hàng</span></button>');
	      	}else{
	      		$(".btn_submit_addtocart").empty();
	      	}
	      	//console.log(price_sp);
	    });
	    $( ".price-sp-gr .price-group .price" ).text( price_sp );
	    $( ".price-sp-gr .price-group .price_baohanh" ).text( price_baohanh );
	    var img_sp=$('select.pa_select option:selected').data('image');
	    if(img_sp!=undefined){
	    	var img_sp_link=$('select.pa_select option:selected').data('imagelink');
	    	img_sp=img_sp_link+img_sp;
	    	//alert(img_sp);
	    	$( ".gallery-img-post" ).empty().append('<img src="'+img_sp+'" alt="Ảnh sản phẩm"/>');
	    	$( ".img-sp-gr" ).empty().append('<img src="'+img_sp+'" alt="Ảnh sản phẩm"/>');
	    }
	});
	//------------
	$(document).on('change','.pa_select_multi',function(e){
		values = new Array();
	    $('.pa_select_multi').find(":selected").each(function(){
	        values.push($(this).val());
	    });
	    var selectet_to_show=values.join(' * ');
	    var value = $("option:selected", this).val();
    	$(".pa_select").val(selectet_to_show).change(); 
	   // console.log(selectet_to_show);
	});
	//----------------
	$(document).on('click','.single_add_to_cart_button',function(e){
		var id_sanpham=$('#id_sanpham').text();
		var name_sanpham=$('#name_sanpham').text();
		var val_thuoctinh=$('select.pa_select').val();
		var text_thuoctinh=$('select.pa_select option:selected').text();
		var link_giohang=$('#link_giohang').text();
		var goibaohanh=$('select.pa_select_goibaohanh option:selected').text();
		var number_pr_to_cart=$('input[name=number_pr_to_cart]').val();
		if(val_thuoctinh==undefined){
			val_thuoctinh='';
			var price_sanpham=$('.price-amount').text();
		}else{
			var price_sanpham=$('.variation-price .price').text();
		}
		//console.log(id_sanpham+name_sanpham+val_thuoctinh+price_sanpham);

		if(number_pr_to_cart<0 || number_pr_to_cart==0){
			alert('Số lượng ít nhất phải là 1');
		}else{
			$.ajax({
					type: 'POST',
					url: BASE_URL + 'page/insert_cart',
					data:{				
						'id_sanpham':id_sanpham,
						'name_sanpham':id_sanpham,
						'price_sanpham':parseFloat(price_sanpham),
						'val_thuoctinh':val_thuoctinh,
						'text_thuoctinh':text_thuoctinh,
						'goibaohanh': goibaohanh,
						'number_pr_to_cart': number_pr_to_cart
					},
					beforeSend: function() {
						$('.single_add_to_cart_button span').empty().html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý ...');
					},
					success: function(data){
						if(data==0){
							alert('Thêm sản phẩm thất bại !');
						}else{
							alert('Thêm sản phẩm vào giỏ hàng thành công !');

							$('.single_add_to_cart_button span').empty().html('Giao tận nơi hoặc nhận ở cửa hàng');
							var cart_count_current = parseFloat($('#cart-header span').text());
							cart_count_current = cart_count_current + parseFloat(number_pr_to_cart);
							$('#cart-header span').empty().text(cart_count_current);
							$('input[name=number_pr_to_cart]').val('1');
							redirect(BASE_URL + "gio-hang", 400);
						}
					}			
				}		
			);
		}
	});
	$(document).on('click','.delete_cart',function(e){
	    var rowid = $( this ).attr('id');
		$.ajax(		
			{    
				type: 'POST',
				url: 'page/delete_cart',    
				data:{				
					'rowid':rowid,
				},            
				success: function(data){	
					window.location.href=data;		            
				}			
			}		
		);	
	});
	$(document).on('click','.delete_tragop',function(e){
	    var rowid = $( this ).attr('id');
		$.ajax(		
			{    
				type: 'POST',
				url: 'page/delete_tragop',    
				data:{				
					'rowid':rowid,
				},            
				success: function(data){	
					window.location.href=data;		            
				}			
			}		
		);	
	});
	$(document).on('change','input[name=number_qty_sp]',function(e){
	  	$('button[name=update_cart]').prop('disabled', false);	
	  	$('button[name=update_tragop]').prop('disabled', false);	
	});
	$(document).on('click','button[name=update_cart]',function(e){
	  	$('input[name=number_qty_sp]').each(function () {
			var id_cat=this.id;	
			var number_qty_sp=this.value;
			$.ajax(		
			{    
				type: 'POST',
				url: 'page/update_cart',    
				data:{				
					'rowid':id_cat,
					'value':number_qty_sp,
				},            
				success: function(data){	
					window.location.href=data;		            
				}			
			}		
		);	
		})
	});
	$(document).on('click','button[name=update_tragop]',function(e){
	  	$('input[name=number_qty_sp]').each(function () {
			var id_cat=this.id;	
			var number_qty_sp=this.value;
			$.ajax(		
			{    
				type: 'POST',
				url: 'page/update_tragop',    
				data:{				
					'rowid':id_cat,
					'value':number_qty_sp,
				},            
				success: function(data){	
					window.location.href=data;		            
				}			
			}		
		);	
		})
	});
	$(document).on('click','input[name=payment_method]',function(e){
	  	var class_open='.payment_method_'+$(this).attr('id');
	  	$('.payment_box').hide();
	  	$(class_open).show();
	  	//console.log(class_open);
	});

	$(document).on('submit','form[name="frm-thongtinthanhtoan"]',function(e) {

		e.preventDefault();

		var hoten = $('.frm-thongtinthanhtoan input[name="hoten"]').val();
		var email = $('.frm-thongtinthanhtoan input[name="email"]').val();
		var sodienthoai = $('.frm-thongtinthanhtoan input[name="sodienthoai"]').val();
		var thanhpho = $('.frm-thongtinthanhtoan select[name="thanhpho"]').val();
		var quanhuyen = $('.frm-thongtinthanhtoan input[name="quanhuyen"]').val();
		var diachi = $('.frm-thongtinthanhtoan input[name="diachi"]').val();

		var check_ok = true;

		if (!hoten) {
			check_ok = false;
			alert('Vui lòng nhập họ tên');
			$('.frm-thongtinthanhtoan input[name="hoten"]')[0].focus();
			return false;
		}
		if (!email) {
			check_ok = false;
			alert('Vui lòng nhập địa chỉ email');
			$('.frm-thongtinthanhtoan input[name="email"]')[0].focus();
			return false;
		}
		if (!valid_email(email)) {
			check_ok = false;
			alert('Địa chỉ email không đúng định dạng');
			$('.frm-thongtinthanhtoan input[name="email"]')[0].focus();
			return false;
		}
		if (!sodienthoai) {
			check_ok = false;
			alert('Vui lòng nhập số điện thoại');
			$('.frm-thongtinthanhtoan input[name="sodienthoai"]')[0].focus();
			return false;
		}
		if (!thanhpho) {
			check_ok = false;
			alert('Vui lòng chọn Tỉnh/Thành phố');
			$('.frm-thongtinthanhtoan input[name="thanhpho"]')[0].focus();
			return false;
		}
		if (!quanhuyen) {
			check_ok = false;
			alert('Vui lòng chọn Quận/Huyện');
			$('.frm-thongtinthanhtoan input[name="quanhuyen"]')[0].focus();
			return false;
		}
		if (!diachi) {
			check_ok = false;
			alert('Vui lòng nhập địa chỉ');
			$('.frm-thongtinthanhtoan input[name="diachi"]')[0].focus();
			return false;
		}

		// check ok
		if(check_ok === true) {
			var tt_khachhang = new Array();
			var vl_khachhang = new Array();
			var tt_sanpham = $('input[name=tt_sanpham]').val();
			var type_thanhtoan = $('input[name=payment_method]:checked').val();
			$("form[name=frm-thongtinthanhtoan] :input:not([disabled])").each(function(){
		        tt_khachhang.push($('label[for='+$(this).attr('name')+']').text());
		 	 	vl_khachhang.push($(this).val());
			});

			var user_id = $('input[name="user_id"]').val();
			var totals = $('input[name="totals"]').val();
			var pointsx = $('input[name="pointsx"]').val();

	 	 	$.ajax({
				type: 'POST',
				url: BASE_URL + 'page/insert_donhang',
				data:{
					'tt_khachhang': tt_khachhang,
					'vl_khachhang': vl_khachhang,
					'tt_sanpham': tt_sanpham,
					'type_thanhtoan': type_thanhtoan,
					'user_id': user_id,
					'email': email,
					'totals': totals,
					'pointsx': pointsx,
				},
				beforeSend: function() {
					$('.alert-checkout-button').empty().html('<i class="fa fa-spinner fa-spin"></i> Vui lòng đợi trong giây lát ...');
					$('#frm-checkout').find(':submit').prop('disabled', true);
				},
				success: function(data){
					$('#frm-checkout').find(':submit').prop('disabled', false);
					$('.alert-checkout-button').fadeOut().empty();

					if(data=="0"){
						alert('Xảy ra lỗi trong quá trình xử lý, vui lòng thử lại');
					}else{
						redirect(data, 400);
					}
				}			
			});
		}
	});
	//--------------
	$(document).on('click','#form-content-tragop i',function(e){
		$('.frm-tragop-gr').hide();
	});
	//-------------
	$(document).on('click','.single_tu_van_tra_gop_button',function(e){
		//$('.frm-tragop-gr').show();
		var id_sanpham=$('#id_sanpham').text();
		var name_sanpham=$('#name_sanpham').text();
		var val_thuoctinh=$('select.pa_select').val();
		var text_thuoctinh=$('select.pa_select option:selected').text();
		var link_tragop=$('#link_tragop').text();
		var goibaohanh=$('select.pa_select_goibaohanh option:selected').text();
		if(val_thuoctinh==undefined){
			val_thuoctinh='';
			var price_sanpham=$('.price-amount').text();
		}else{
			var price_sanpham=$('.variation-price .price').text();
		}
		//console.log(id_sanpham+name_sanpham+val_thuoctinh+price_sanpham);
		$.ajax(		
			{    
				type: 'POST',
				url: 'page/insert_cart',    
				data:{				
					'id_sanpham':id_sanpham,
					'name_sanpham':id_sanpham,
					'price_sanpham':parseFloat(price_sanpham),
					'val_thuoctinh':val_thuoctinh,
					'text_thuoctinh':text_thuoctinh,
					'goibaohanh': goibaohanh
				},            
				success: function(data){		
					$('.single_tu_van_tra_gop_button span').empty().html('<i class="fa fa-spinner fa-spin"></i> Vui lòng đợi trong giây lát ...');		
					setTimeout(function() {
							//alert(data);
							if(data=0){
								alert('Thêm sản phẩm thất bại !');
							}else{
								window.location.href=link_tragop;
							}			
						},1000	
					);            
				}			
			}		
		);	
	});
	//-------------
	$(document).on('click','input[name=submit_tragop]',function(e){
		$('.wpcf7-response-output').empty().html('<i class="fa fa-spinner fa-spin"></i> Vui lòng đợi trong giây lát ...');	
		if ($('#form-content-tragop input').val().length == 0) {
			setTimeout(function() {
				$('.wpcf7-response-output').empty().html('Vui lòng nhập đầy đủ thông tin');
				$('input[name=hoten]').focus();		
			},1000);   
		}else{
			var hoten=$('#form-content-tragop input[name=hoten]').val();
			var sodienthoai=$('#form-content-tragop input[name=sodienthoai]').val();
			var link_sp=$('#form-content-tragop input[name=link_sp]').val();
			$.ajax({    
				type: 'POST',
				url: 'page/sendmail_tragop',    
				data:{				
					'hoten':hoten,
					'sodienthoai':sodienthoai,
					'link_sp':link_sp
				},            
				success: function(data){		
					$('.wpcf7-response-output').empty().html('<i class="fa fa-spinner fa-spin"></i> Vui lòng đợi trong giây lát ...');	
					setTimeout(function() {
						$('.wpcf7-response-output').empty().html('Thông tin của bạn đã được gởi đi. Xin cảm ơn !');	
						$('input[name=hoten]').val('').focus();
						$('input[name=sodienthoai]').val('');
					},1000);            
				}			
			});
		}
		return false;
	});
	//---------------
	$(document).on('click','.filter_thuoctinhsanpham',function(e){
		var list_giatri = [];
		var link_cat=$('input[name=link_cat]').val();
		$('.thuoctinhsanpham_gr_fillter input:checked').each(function () {
			var id_giatrisp=this.id;
			list_giatri.push(id_giatrisp);	
		});
		if(list_giatri==''){
			alert('Vui lòng chọn giá trị !');
		}else{
			window.location.href=link_cat+'?meta='+list_giatri;
		}
	});
	//---------------
	$(document).on('click','.widget-title i',function(e){
		var id=$(this).closest('aside').attr('id');
		$('#'+id+' .list_post_new_wg').toggle();
		$('#'+id+' .widget-title i').toggleClass('quaynguoc');
	});
	//---------------
	$(document).on('click','.title-thuoctinh',function(e){
		var id=$(this).parent().attr('id');
		$('#'+id+' .title-thuoctinh i').toggleClass('quaynguoc');
		$('#'+id+' .list_thuoctinh_fillter').toggle();
	});
	function formatDollar(num) {
	    var p = num.toFixed(2).split(".");
	    return p[0].split("").reverse().reduce(function(acc, num, i, orig) {
	        return  num=="-" ? acc : num + (i && !(i % 3) ? "," : "") + acc;
	    }, "")+ " đ";
	}
	//------------
	$(document).on('change','.pa_select_goibaohanh',function(e){
	    var value = $("option:selected", this).val();
	    var price = $(".price-sp-gr .price-group .price_baohanh").text();
	    if(price!=''){
	    	var price_baohanh=parseInt(price)+parseInt(value);
	    	$(".price-sp-gr .price-group .price").text(formatDollar(price_baohanh));
	    }else{
	    	$(".price-sp-gr .price-group .price").text('Liên hệ hotline 0365234567');
	    }
	});
	//--------------------------------//
	$(document).ready(function() {
		var thuoctinh_macdinh=$('select#pa_select_multi_hidden option:selected').val();
		if(thuoctinh_macdinh){
			thuoctinh_macdinh=thuoctinh_macdinh.split(' * ');
	        for(var i=0; i< thuoctinh_macdinh.length; i++){
	     		$("select.pa_select_multi option").each(function() {
	     			var id_select=$(this).closest('select').attr('id'); 
					var value_select=$(this).val();
					if(value_select==thuoctinh_macdinh[i]){
						//if(id_select=='pa_select_multi_0'){
							//console.log(id_select);
							var id_select_ul=id_select.split('pa_select_multi_');
							id_select_ul='#ul-'+id_select_ul[1];
							//console.log(id_select_ul);
							$(id_select_ul+'.color-select-ul li').eq($(this).index()).addClass('selected');
						//}
						$("#"+id_select).val(value_select);
						//console.log(value_select);
					}
				});
	  	 	}
		}
		//---------------
		var set_btn_dathang=$('select.pa_select option:selected').val();
		if(set_btn_dathang){
			var gia_load=$('select.pa_select option:selected').attr('data-giasp');
			if(gia_load!='Liên hệ hotline 0365234567'){
				$(".btn_submit_addtocart").append('<button type="submit" class="single_add_to_cart_button button alt">MUA NGAY<span>Giao tận nơi hoặc nhận ở cửa hàng</span></button>');
			}else{
				$(".btn_submit_addtocart").empty();
			}
		}
   	});
	//-------------------------------//
	$(document).on('click','.color-select-ul li',function(e){
		var id_ul='#'+($(this).parent().attr('id'));
		var pa_select_multi_id=($(this).parent().attr('id'));
		pa_select_multi_id='#pa_select_multi_'+pa_select_multi_id.split('ul-')[1];
		//console.log(pa_select_multi_id);
	    var selectet_to_show=$(this).attr('value');
	    $(id_ul+'.color-select-ul li').removeClass('selected');
	    $(this).addClass('selected');
    	$("select.pa_select[name=attribute_pa]").val(selectet_to_show).change(); 
    	$("select.pa_select_multi[name=attribute_pa]"+pa_select_multi_id).val(selectet_to_show).change(); 
	    //console.log(selectet_to_show);
	});
	//--------------------------------//
	$(document).ready(function() {
		var minVal=0;
 		$(".color-select-ul li").each(function() {
 			if(minVal > parseInt($(this).attr('data-giabaohanh'))){
           		minVal = parseInt($(this).attr('data-giabaohanh'));
       	 	}
       	 	//console.log(minVal);
		});
   	});
   	$(document).on('click','.menu-mobile .menu-item-gr > li.parent-menu',function(e){
	  	var class_li=($(this).attr('class'));
	  	class_li=class_li.split(' ')[1];
	  	$(this).toggleClass('active');
	  	$('.'+class_li+" > ul.menu-item-gr").toggle();
	});
	//--------------------------------//
	$(document).ready(function() {
		$('#header-menu-top ul.menu-item-gr > li').each(function () {
			if ($(this).children('ul').length) {
				$(this).addClass('parent-menu');
			}
		});
		//---------
		$('.color-select-ul li').each(function () {
			var id_ul=($(this).parent().attr('id'));
			var length_selected=($('#'+id_ul+' li.selected').length);
			if(length_selected>1){
				$('#'+id_ul+' li:first-child').removeClass('selected');
			}
		});
   	});
   	//---------------------
   	$(document).on('click','.href_tabslink',function(){
	  $('.href_tabslink').removeClass('current');
	  $(this).addClass('current');
	  var class_tragop_tindung=($(this).attr('data-code'));
	  $('.tragop_tindung').hide();
	  $('#'+class_tragop_tindung).show();
	});
   	//-------------
   	$(document).on('click','.single_tu_van_tra_gop_form',function(e){
		$('.frm-tragop-gr').show();
	});
   	//-------------
	$(document).on('click','input[name=submit_tragop_cus]',function(e){
		$('.wpcf7-response-output').empty().html('<i class="fa fa-spinner fa-spin"></i> Vui lòng đợi trong giây lát ...');	
		var chonmua_tragop=$('input[name=chonmua_tragop]:checked').val();
		var sotientratruoc_tragop_check=$('input[name=sotientratruoc_tragop]').val();
		if ($('#form-content-tragop input[required]').val().length == 0 || chonmua_tragop==undefined || sotientratruoc_tragop_check=='') {
			setTimeout(function() {
				if(sotientratruoc_tragop_check==''){
					$('.wpcf7-response-output').empty().html('Vui lòng nhập số tiền trả trước');
					$('input[name=sotientratruoc_tragop]').focus();
				}else{
					$('.wpcf7-response-output').empty().html('Vui lòng nhập đầy đủ thông tin và số tháng');
					$('input[name=hoten]').focus();	
				}
			},1000);   
		}else{
			if(check_tragop()==false){
				$('.wpcf7-response-output').empty().html('Vui lòng nhập số tiền đúng hạn mức');
				$('input[name=hoten]').focus();	
			}else{
				var hoten=$('#form-content-tragop input[name=hoten]').val();
				var sodienthoai=$('#form-content-tragop input[name=sodienthoai]').val();
				var email=$('#form-content-tragop input[name=email]').val();
				var thanhpho=$('#form-content-tragop select[name=thanhpho]').val();
				var chinhanh=$('#form-content-tragop select[name=chinhanh]').val();
				var diachi=$('#form-content-tragop input[name=diachi]').val();
				var link_sp=$('#form-content-tragop input[name=link_sp]').val();
				var timeship=$('input[name=timeship]:checked').val();
				var ghichu_tragop=$('textarea[name=ghichu]').val();
				var tragop_vl=$('.href_tabslink.current').attr('data-value');
				var tragop_code=$('.href_tabslink.current').attr('data-code');		
				var sotientratruoc_tragop=$('input[name=sotientratruoc_tragop]').val().replace(/[^0-9\,]+/g, '');
				var tt_sanpham = $('input[name=tt_sanpham]').val();
				//alert(timeship);
				var tt_khachhang = new Array();
				var vl_khachhang = new Array();
				$("form[name=form-tragop-cs] :input:not([disabled])").each(function(){
			        tt_khachhang.push($(this).attr('name'));
			 	 	vl_khachhang.push($(this).val());
				});
				if(timeship==undefined){
					timeship='Mua tại cửa hàng';
				}
				//alert(timeship);
				$.ajax({    
					type: 'POST',
					url: 'page/insert_tragop',    
					data:{				
						'tt_khachhang':tt_khachhang,
						'vl_khachhang':vl_khachhang,
						'tragop_vl':tragop_vl,
						'tragop_code':tragop_code,
						'chonmua_tragop':chonmua_tragop,
						'sotientratruoc_tragop':sotientratruoc_tragop,
						'tt_sanpham':tt_sanpham,
						'thoigiangiaohang':timeship,
						'ghichu_tragop':ghichu_tragop,
						'thanhpho':thanhpho,
						'chinhanh':chinhanh,
						'link_sp':link_sp
					},            
					success: function(data){		
						$('.wpcf7-response-output').empty().html('<i class="fa fa-spinner fa-spin"></i> Vui lòng đợi trong giây lát ...');	
						setTimeout(function() {
							//console.log(data);
							if(data=="0"){
								alert('Xảy ra lỗi trong quá trình xử lý, vui lòng thử lại');
							}else{
								//alert(data) ;
								window.location.href=data;
							}			
						},1000);           
					}			
				});
			}
		}
		return false;
	});
	$(document).on('keyup','.frm-timkiem input[type=text]',function(e){
		var seach_ip=$(this).val();
		$('.ex_kqmain ul').empty();
		if(seach_ip!=''){
			$.ajax({    
				type: 'POST',
				url: 'page/search_ajax', 
				dataType:'json',   
				data:{				
					'seach_ip':seach_ip,
				},            
				success: function(result){
					$.each(result , function (i, value){
						var link_sp=result[i].split('+++')[0];
						var ten_sp=result[i].split('+++')[1]; 
						var add_sp=result[i].split('+++')[2];
						var gia_sp=result[i].split('+++')[3]; 
						$('.ex_kqmain ul').append(
							'<li><a href="'+link_sp+'"><p><img src="'+add_sp+'" alt="'+ten_sp+'"></p>'+
				    			'<div><h3>'+ten_sp+'</h3>'+
				    				'<p class="ex_sprice">'+gia_sp+'</p>'+
				    			'</div></a>'+
				    		'</li>'
						);
					});	 	
					//console.log(result);   
				}			
			});
		}
	});
	//---------------
	$(document).on({
	    "contextmenu": function(e) {
	        //console.log("ctx menu button:", e.which);

	        // Stop the context menu
	        //e.preventDefault();
	    },
	    "mousedown": function(e) { 
	        //console.log("normal mouse down:", e.which);
	    },
	    "mouseup": function(e) { 
	        //console.log("normal mouse up:", e.which);
	    }
	});
})(jQuery);

/**
 *
 * @param container
 * @param output
 * @returns {boolean}
 * @constructor
 */
function TableOfContents(container, output) {
	var txt = "toc-";
	var toc = "";
	var start = 1;
	var output = output || '#tocList';

	var container = document.querySelector(container) || document.querySelector('.entry-post-wrapper');
	var c = container.children;

	for (var i = 0; i < c.length; i++) {
		//var isHeading = c[i].nodeName.match(/^H\d+$/) ;
		if(c[i].nodeName.match(/^(?!h1|H1)H\d+$/)) {
			var level = c[i].nodeName.substr(1);
			// get header content regardless of whether it contains a html or not that breaks the reg exp pattern
			var headerText = (c[i].textContent);
			// generate unique ids as tag anchors
			var anchor = txt+i;

			var tag = '<a href="#' + anchor + '" id="' + anchor + '">' + headerText + '</a>';

			c[i].innerHTML = tag;

			if(headerText){
				if (level > start) {
					toc += (new Array(level - start + 1)).join('<ul>');
				} else if (level < start) {
					toc += (new Array(start - level + 1)).join('</li></ul>');
				} else {
					toc += (new Array(start+ 1)).join('</li>');
				}
				start = parseInt(level);
				toc += '<li><a href="#' + anchor + '">' + headerText + '</a>';
			}
		}
	}

	if (start > 1) {
		toc += (new Array(start + 1)).join('</ul>');
	}

	if(toc){
		$('.entry-post-wrapper').prepend('<div id="toc_container" class="no_bullets"><p class="toc_title">MỤC LỤC NỘI DUNG <span class="toc_toggle">[Ẩn]</span></p><div id="tocList"></div></div>');
		document.querySelector(output).innerHTML += toc;
	}else{
		return false;
	}
}

$(document).ready(function() {

	if ( $('.entry-post-wrapper').length ) {
		var mucluc_data = $('.entry-post-wrapper').attr('data-mucluc');
		if (mucluc_data == "0") {
			if (TableOfContents()) {
				TableOfContents();
			}
		}
	}

	//---------------
	$(document).click(function (e) {
		$('body').click(function (e) {
			$(".list_thuoctinh_fillter").hide();
		});

		$(".list_thuoctinh_fillter").click(function (event) {
			event.stopPropagation();
		});
	});

	//--------
	$(document).on('click', '#tocList li a', function (e) {
		var id_div = $(this).attr('href');
		$('html, body').animate({scrollTop: $(id_div).position().top}, 200);
		e.preventDefault();
	});

	//--------
	$(document).on('click', '#toc_container .toc_toggle', function (e) {
		$(this).toggleClass('active');
		if ($(this).hasClass('active')) {
			$(this).empty().html('[Hiện]');
		} else {
			$(this).empty().html('[Ẩn]');
		}
		$('#tocList').toggleClass('hidden');
	});
});

/**
 *
 * @param $email
 * @returns {boolean}
 */
function valid_email($email)
{
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,6})?$/;
	//return emailReg.test($email);
	return ($email.length > 0 && emailReg.test($email));
}
