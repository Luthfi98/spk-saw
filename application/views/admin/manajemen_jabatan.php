<div class="panel panel-primary panel-line">
  <header class="panel-heading">
    <h3 class="panel-title">Manajemen <?= $title ?></h3>
  </header>
  <div class="panel-body">
    <table width="100%" class="table table-hover table-responsive dataTable table-striped" id="dt-jabatan">
      <thead>
        <tr>
          <th width="1%">No.</th>
          <th width="40%">Nama Jabatan</th>
          <th width="50%">Deskripsi Jabatan</th>
          <th width="9%">Aksi</th>
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
            <div class="modal-body">
                <form id="form">
                    <div class="form-group form-material" id="form_nama_jabatan">
                        <label class="form-control-label" for="nama_jabatan">Nama Jabatan</label>
                        <input type="text" name="id_jabatan" id="id_jabatan">
                        <input type="text" name="nama_jabatan" class="form-control" id="nama_jabatan">
                    </div>
                    <div class="form-group form-material" id="form_deskripsi_jabatan">
                        <label class="form-control-label" for="deskripsi_jabatan">Deskripsi Jabtatan</label>
                        <textarea  name="deskripsi_jabatan" id="deskripsi_jabatan" class="form-control" cols="15" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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


<div class="modal fade modal-3d-flip-horizontal" id="modal-previllege" tabindex="-1" role="dialog" >
    <div class="modal-dialog  modal-center" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Pengaturan Previllege Jabatan</h4>
            </div>
            <div class="modal-body" style="height: 80vh;overflow-y: auto;">
                <form id="form-previllege">
                    <div class="form-group form-material" id="form_nama_jabatan">
                        <input type="hidden" name="id_jabatan" id="id_jabatan">
                        <label>
                            <input type="checkbox" id="select_all"> 
                            <span>Select All</span>
                        </label>
                    </div>
                    <hr>
                    <div id="data-prvilege"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-simpan-prvilege">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<script>
  $(document).ready(function(){
      dt = $('#dt-jabatan').DataTable({
            processing: true,
            serverSide:true,
            multiselect:false,
            ajax: {
              "url": base+"getDataJabatan",
              "type":"POST",
            },
            columnDefs: [
            {
              targets : [-1,0],
              orderable: false
            },
            {
              targets :[-1],
              class: 'text-wrap text-center'
            }
            ],
            displayLength: 10,
            order : [],
          });
      })
  var nama_jabatan = $('#form_nama_jabatan')
  var deskripsi_jabatan = $('#form_deskripsi_jabatan')

  function clearAlert()
  {
      nama_jabatan.removeClass('has-danger has-success')
      deskripsi_jabatan.removeClass('has-danger has-success')
  }  

  function ButtonAdd()
  {
    status ='add';
    $('#form')[0].reset();
    $('#modal-form').modal('show');
    $('.modal-title').text('Tambah Menu');
    $('.btn-simpan').attr('disabled', false)
    clearAlert()   
  }

  function ButtonEdit(id_menu)
  {
      status ='edit';
      $('.btn-simpan').attr('disabled', false)
      clearAlert()    
      $('#form')[0].reset(); // reset form on modals
      $.ajax({
        url:base+"getJabatanById/"+id_menu,
        type:"POST",
        dataType:"JSON",
        success:function(response)
        {

          $('#id_jabatan').val(response.id_jabatan)
          $('#nama_jabatan').val(response.nama_jabatan)
          $('#deskripsi_jabatan').val(response.deskripsi_jabatan)

          $('#modal-form').modal('show');
          $('.modal-title').text('Ubah Menu');
        }
      });
  }

  function ButtonDelete(id_jabatan)
  {

    swal({
          title: "Apakah anda Yakin?",
          text: "Data Yang Sudah Dihapus Tidak Dapat Dikembalikan!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-primary",
          confirmButtonText: 'Yakin?',
          closeOnConfirm: false,
          closeOnCancel: true
        }, function (isConfirm) {
          if (isConfirm) {
            $.ajax({
              url:base+"delJabatan/"+id_jabatan,
              type:'post',
              dataType:'JSON',
              success:function(response)
              {
                dt.ajax.reload();
                alertSuccess('Data Jabatan Berhasil '+response.alert)
              }
            })
          }
        });
  }


  $('.btn-simpan').click(function(){
      $(this).attr('disabled', true)
      $.ajax({
          url:base+'simpanDataJabatan/'+status,
          data:$('#form').serialize(),
          dataType:'JSON',
          type:'POST',
          success:function(response)
          {

              if (response.sukses == true) {
                  alertSuccess('Data Jabatan Berhasil '+response.alert)
                  $('#modal-form').modal('hide');
                  dt.ajax.reload()
              }else{
                  if (response.nama_jabatan_error) {
                      nama_jabatan.addClass('has-danger')
                  }else{
                      nama_jabatan.addClass('has-success').removeClass('has-danger')
                  }
                  if (response.deskripsi_jabatan_error) {
                      deskripsi_jabatan.addClass('has-danger')
                  }else{
                      deskripsi_jabatan.addClass('has-success').removeClass('has-danger')
                  }

                  $('.btn-simpan').attr('disabled', false)

              }

          }
      })
  })


  var form_previllege = $('#form-privillege');

  function ButtonPrevillege(id_role)
  {
    $('#modal-previllege').modal('show');
    $.ajax({
        url: base+"getPrevilegeJabatan/"+id_role,
        type: "POST",
        dataType: "html",
        success: function(response)
        {
            $("#id_jabatan").val(id_role);
            $("#data-prvilege").html(response);
        }
    });
  }

  $("#data-prvilege input#parent").click(function(){
    if($(this).is(':checked')==true){
      $(this).parent().find('input[type="checkbox"]').attr('checked',true);
    }else{
      $(this).parent().find('input[type="checkbox"]').attr('checked',false);
    }
  });
  
  $("#data-prvilege input#child").click(function(){
    if($(this).is(':checked')==true){
      $(this).parent().find('input#grandchild').attr('checked',true);
    }else{
      $(this).parent().find('input#grandchild').attr('checked',false);
    }
  });

  $("#select_all").click(function(){
    if($(this).is(':checked')==true)
    {
      $("#data-prvilege input[type='checkbox']").attr('checked',true);
    }
    else
    {
      $("#data-prvilege input[type='checkbox']").attr('checked',false);
    }
  })

  $(".btn-simpan-prvilege").click(function()
  {
    $.ajax({
      type: "POST",
      url: base+"simpanPrevileJabatan",
      dataType: "json",
      data: $("#form-previllege").serialize(),
      success: function(response){
        if(response.success==true){
          alertSuccess("Previllege Jabatan Berhasil Diperbarui");
           $('#modal-previllege').modal('hide');
           dt.ajax.reload();
        }else{
          alertWarning("Priviledge Jabatan gagal perbarui")
        }
      },
      error: function(){
        alertWarning("Failed to Connect into Databases, Please Contact Your Administration!");
      }
    })
  });

</script>
