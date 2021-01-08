$('.btn-logout').click(function(){
	swal({
        title: "Apakah anda Yakin?",
        text: "Kamu Akan Meninggalkan Aplikasi Ini!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-primary",
        confirmButtonText: 'Yakin?',
        closeOnConfirm: false,
        closeOnCancel: true
      }, function (isConfirm) {
      	if (isConfirm) {
      		$.ajax({
      			url:base+'logout',
      			type:'post',
      			dataType:'JSON',
      			success:function(response)
      			{
      				if (response) {
      					alertSuccess('Terimakasih Sudah Berkunjung :)')
      					window.location.href=base

      				}
      			}
      		})
      	}
      });
})



function alertSuccess(alert) {
	swal({
	  type: 'success',
	  title: 'Sukses',
	  text: ''+alert,
	  timer:1500
	})
}

function alertInfo(alert) {
	swal({
	  type: 'info',
	  title: '',
	  text: ''+alert,
	  timer:300,
      showConfirmButton: false,
	})
}

function alertWarning(alert)
{
	swal({
	  type: 'warning',
	  title: 'Peringatan',
	  text: ''+alert,
	  timer:1500
	})
}

function alertError(alert)
{
	swal({
	  type: 'error',
	  title: 'Gagal',
	  text: ''+alert,
	  timer:1500
	})
}