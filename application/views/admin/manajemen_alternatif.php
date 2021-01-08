<div class="panel panel-primary panel-line">
  <header class="panel-heading">
    <h3 class="panel-title">Manajemen <?= $title ?></h3>
  </header>
  <div class="panel-body">
    <table width="100%" class="table table-hover table-responsive dataTable table-striped" id="dt-alternatif">
      <thead>
        <tr>
          <th width="1%">No.</th>
          <th width="5%">Kode Alternatif</th>
          <th width="20%">Nama Alternatif</th>
          <th width="3%">
            <button type="button" onclick="DelAll()"  class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
          </th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade modal-3d-flip-horizontal" id="modal-form" tabindex="-1" role="dialog" >
    <div class="modal-dialog  modal-center" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" style="max-height:75vh; overflow-y: auto;">
                <form id="form">
                    <div class="form-group form-material" id="form_kode_alternatif">
                        <label class="form-control-label" for="kode_alternatif">Kode Alternatif</label>
                        <input type="text" readonly name="kode_alternatif" id="kode_alternatif" placeholder="Kode alternatif" class="form-control">
                        <span class="text-danger" id="kode_alternatif_error"></span>
                    </div>
                    <div class="form-group form-material" id="form_alternatif">
                        <label class="form-control-label" for="alternatif">Nama Alternatif</label>
                        <input type="hidden" name="id_alternatif" id="id_alternatif">
                        <input type="text" name="alternatif" id="alternatif" placeholder="Nama alternatif" class="form-control">
                        <span class="text-danger" id="alternatif_error"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-simpan">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Site Action -->
    <div class="site-action" >
      <button type="button" onclick="ButtonAdd()" class="site-action-toggle btn-sm btn-raised btn btn-primary btn-floating">
        <i class="icon md-plus" aria-hidden="true"></i>
      </button>
    </div>
    <!-- End Site Action -->

<script>
  $(document).ready(function(){
  dt = $('#dt-alternatif').DataTable({
          processing: true,
          serverSide:true,
          multiselect:false,
          ajax: {
            "url": base+"getDataAlternatif",
            "type":"POST",
          },
          columnDefs: [
          {
            targets : [-1,0],
            orderable: false
          },
          {
            targets :[-1,-2,0,1],
            class: 'text-wrap text-center'
          }
          ],
          displayLength: 10,
          order : [],
        });
   })


  var alternatif = $('#form_alternatif')
  var kode_alternatif = $('#form_kode_alternatif')

  function clearAlert()
  {
      alternatif.removeClass('has-danger has-success')
      kode_alternatif.removeClass('has-danger has-success')
  }

  function ButtonAdd()
  {
    status ='add';
    $('#form')[0].reset();
    $('#modal-form').modal('show').removeClass('modal-3d-sign').addClass('modal-3d-flip-horizontal');
    $('.modal-title').text('Tambah alternatif');
    $('.btn-simpan').attr('disabled', false)
    clearAlert()
    $('.text-danger').empty()
    getKodeAlternatif()
  }

  function DelAll()
  {

    swal({
          title: "Apakah anda Yakin Ingin Mengosongkan Table Alternatif?",
          text: "",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-primary",
          confirmButtonText: 'Yakin?',
          closeOnConfirm: false,
          closeOnCancel: true
        }, function (isConfirm) {
          if (isConfirm) {
             $.ajax({
                url:base+'delAlternatif',
                type:'POST',
                dataType:'JSON',
                success:function(response)
                {
                  dt.ajax.reload();
                  alertSuccess('Data Kriteria Berhasil '+response.alert)
                }
              })
          }
        });

  }

  function ButtonDelete(id)
  {
    swal({
          title: "Apakah anda Yakin?",
          text: "Data Yang Sudah Dihapus Tidak Dapat Dikembalikan",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-primary",
          confirmButtonText: 'Yakin?',
          closeOnConfirm: false,
          closeOnCancel: true
        }, function (isConfirm) {
          if (isConfirm) {
            $.ajax({
              url:base+"delAlternatif",
              type:'post',
              data:{
                id : id
              },
              dataType:'JSON',
              success:function(response)
              {
                dt.ajax.reload();
                alertSuccess('Data Kriteria Berhasil '+response.alert)
              }
            })
          }
        });
  }

  function getKodeAlternatif()
  {
    $.ajax({
      url:base+'getKodeAlternatif',
      type:'POST',
      dataType:'JSON',
      success:function(response)
      {
        $('#kode_alternatif').val(response)
      }
    })
  }


  $('.btn-simpan').click(function(){
      $.ajax({
          url:base+'simpanDataAlternatif/'+status,
          data:$('#form').serialize(),
          dataType:'JSON',
          type:'POST',
          success:function(response)
          {

              if (response.sukses == true) {
                  alertSuccess('Data Alternatif Berhasil '+response.alert)
                  $('#modal-form').modal('hide');
                  dt.ajax.reload()
              }else{
                  if (response.alternatif_error) {
                      alternatif.addClass('has-danger')
                      $('#alternatif_error').html(response.alternatif_error)
                  }else{
                      alternatif.addClass('has-success').removeClass('has-danger')
                      $('#alternatif_error').empty()
                  }
                  if (response.kode_alternatif_error) {
                      kode_alternatif.addClass('has-danger')
                      $('#kode_alternatif_error').html(response.kode_alternatif_error)
                  }else{
                      kode_alternatif.addClass('has-success').removeClass('has-danger')
                      $('#kode_alternatif_error').empty()
                  }
                  $('.btn-simpan').attr('disabled', false)

              }

          }
      })
  })

</script>