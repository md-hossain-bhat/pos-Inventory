$(document).ready(function(){

	$("#current_pwd").keyup(function(){
		var current_pwd = $("#current_pwd").val();
		$.ajax({
			type:'post',
			url:'/admin/check-pwd',
			data:{current_pwd:current_pwd},
			success:function(resp){
				// alert(resp);
				if(resp=="false"){
					$("#chkPwd").html("<font color='red'>Current Password is Incorrect</font>");
				}else if(resp=="true"){
					$("#chkPwd").html("<font color='green'>Current Password is Correct</font>");
				}
			},error:function(){
				alert("Error");
			}
		});
	});
//admin user status
	$(".updateAdminStatus").click(function(){
		var status = $(this).children("i").attr("Status");
		var admin_id = $(this).attr("admin_id");

		$.ajax({
			type:"post",
			url:"/admin/update-admin-status",
			data:{status:status,admin_id:admin_id},
			success:function(resp){
				// alert(resp['status']);
				// alert(resp['admin_id']);
				if (resp['status']==0) {
					$("#admin-"+admin_id).html("<i class='fa fa-toggle-off' aria-hidden='true' Status='Inactive'></i>");
				}else if(resp['status']==1){
					$("#admin-"+admin_id).html("<i class='fa fa-toggle-on' aria-hidden='true' Status='Active'></i>");
				}
			},error:function(){
				alert("Error");
			}
		});
	});


//daynamic delete function 
	$(".confirmDelete").click(function(){
		var record =$(this).attr('record');
		var recoedid =$(this).attr('recoedid');

		Swal.fire({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
		  if (result.value) {
		    window.location.href="/admin/delete-"+record+"/"+recoedid;
		  }
		});

	});

	$(".confirmApprove").click(function(){
		var record =$(this).attr('record');
		var recoedid =$(this).attr('recoedid');

		Swal.fire({
		  title: 'Are you sure?',
		  text: "Approved This!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, Approved it!'
		}).then((result) => {
		  if (result.value) {
		    window.location.href="/admin/approve-"+record+"/"+recoedid;
		  }
		});

	});

});