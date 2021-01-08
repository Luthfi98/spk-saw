<div class="panel panel-primary panel-line">
  <header class="panel-heading">
    <h3 class="panel-title">Manajemen <?= $title ?></h3>
  </header>
  <div class="panel-body">
    <table width="100%" class="table table-hover table-responsive dataTable table-striped" id="dt-akun">
      <thead>
        <tr>
          <th width="1%">No.</th>
          <th width="5%">Foto</th>
          <th width="20%">Username</th>
          <th width="20%">Jabatan</th>
          <th width="20%">Date Created</th>
          <th width="20%">Last Login</th>
          <th width="8%">Aksi</th>
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
                    <div class="form-group form-material" id="form_jabatan">
                        <label class="form-control-label" for="jabatan">Jabatan</label>
                        <select class="form-control" id="jabatan" name="jabatan">
                          <option value="" readonly selected>Pilih Jabatan</option>
                          <?php foreach ($jabatan as $jbt): ?>
                            <option value="<?= $jbt->id_jabatan ?>"><?= $jbt->nama_jabatan ?></option>
                          <?php endforeach ?>
                        </select>
                        <span class="text-danger" id="jabatan_error"></span>
                    </div>
                    <div class="form-group form-material" id="form_username">
                        <label class="form-control-label" for="username">Username</label>
                        <input type="hidden" name="id_akun" id="id_akun">
                        <input type="text" name="username" id="username" placeholder="username" class="form-control">
                        <span class="text-danger" id="username_error"></span>
                    </div>
                    <div class="form-group form-material" id="form_password">
                        <label class="form-control-label" for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                        <span class="text-danger" id="password_error"></span>
                    </div>
                    <div class="form-group form-material" id="form_konfirmasi">
                        <label class="form-control-label" for="konfirmasi">Konfirmasi Password</label>
                        <input type="password" name="konfirmasi" id="konfirmasi" placeholder="Konfirmasi Password" class="form-control">
                        <span class="text-danger" id="konfirmasi_error"></span>
                    </div>
                    <div class="form-group form-material form-material-file" data-plugin="formMaterial" id="form_gambar" >
                        <label class="form-control-label" for="gambar">Gambar</label>
                        <br>
                        <div id="load_gambar" class="mb-3"></div>
                        <input type="text" class="form-control" placeholder="Browse.." readonly="" />
                        <input type="file" id="gambar" name="gambar" multiple="" />
                        <span class="text-danger" id="gambar_error"></span>
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
      dt = $('#dt-akun').DataTable({
            processing: true,
            serverSide:true,
            multiselect:false,
            ajax: {
              "url": base+"getDataAkun",
              "type":"POST",
            },
            columnDefs: [
            {
              targets : [-1,0,1],
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
  var username = $('#form_username')
  var password = $('#form_password')
  var konfirmasi = $('#form_konfirmasi')
  var gambar = $('#form_gambar')
  var jabatan = $('#form_jabatan')

  function clearAlert()
  {
      username.removeClass('has-danger has-success')
      password.removeClass('has-danger has-success')
      konfirmasi.removeClass('has-danger has-success')
      jabatan.removeClass('has-danger has-success')
      gambar.removeClass('has-danger has-success')
  }

  function ButtonDelete(id_akun)
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
              url:base+"delAkun/"+id_akun,
              type:'post',
              dataType:'JSON',
              success:function(response)
              {
                dt.ajax.reload();
                alertSuccess('Data Akun Berhasil '+response.alert)
              }
            })
          }
        });
  }

  function ButtonAdd() 
  {
      status ='add';
      $('#form')[0].reset();
      $('#modal-form').modal('show');
      $('.modal-title').text('Tambah Akun');
      $('.btn-simpan').attr('disabled', false)
      clearAlert()
      $('.text-danger').empty()
      $('#load_gambar').empty()
  }

  function ButtonEdit(id_akun)
  {
      status ='edit';
      $('.btn-simpan').attr('disabled', false)
      clearAlert()    
      $('#form')[0].reset(); // reset form on modals
      $.ajax({
        url:base+"getAkunById",
        type:"POST",
        data:{
          id_akun : id_akun
        },
        dataType:"JSON",
        success:function(response)
        {

          $('#id_akun').val(response.id_akun)
          $('#username').val(response.username)
          $('#jabatan').val(response.id_jabatan)
          var load = `<img src="`+base+`assets/img/`+response.gambar+`" width="150px" height="150px" alt="">`
          $('#load_gambar').html(load)
          $('#modal-form').modal('show');
          $('.modal-title').text('Ubah Akun '+response.username);
        }
      });
  }


  $('.btn-simpan').click(function(){
      var formData = new FormData($('#form')[0]);
      $.ajax({
          url:base+'simpanDataAkun/'+status,
          data:formData,
          contentType: false,
          processData: false,
          dataType:'JSON',
          type:'POST',
          success:function(response)
          {

              if (response.sukses == true) {
                  alertSuccess(response.alert)
                  $('#modal-form').modal('hide');
                  dt.ajax.reload()
              }else{
                  if (response.username_error) {
                      username.addClass('has-danger')
                      $('#username_error').html(response.username_error)
                  }else{
                      username.addClass('has-success').removeClass('has-danger')
                      $('#username_error').empty()
                  }
                  if (response.password_error) {
                      password.addClass('has-danger')
                      $('#password_error').html(response.password_error)
                  }else{
                      password.addClass('has-success').removeClass('has-danger')
                      $('#password_error').empty()
                  }
                  if (response.konfirmasi_error) {
                      konfirmasi.addClass('has-danger')
                      $('#konfirmasi_error').html(response.konfirmasi_error)
                      $('#konfirmasi').val('')
                  }else{
                      konfirmasi.addClass('has-success').removeClass('has-danger')
                      $('#konfirmasi_error').empty()
                  }
                  if (response.gambar_error) {
                      gambar.addClass('has-danger')
                      if (response.gambar_error == '<p>The filetype you are attempting to upload is not allowed.<\/p>') {
                        err = 'File yang dipilih tidak sesuai ketentuan'
                      }else if (response.gambar_error == '<p>The file you are attempting to upload is larger than the permitted size.<\/p>'){
                        err = 'Ukuram file yang dipilih maksimal 2MB'
                      }
                      $('#gambar_error').text(err)
                  }else{
                      gambar.addClass('has-success').removeClass('has-danger')
                      $('#gambar_error').empty()
                  }
                  if (response.jabatan_error) {
                      jabatan.addClass('has-danger')
                      $('#jabatan_error').html(response.jabatan_error)
                  }else{
                      jabatan.addClass('has-success').removeClass('has-danger')
                      $('#jabatan_error').empty()
                  }

                  $('.btn-simpan').attr('disabled', false)

              }

          }
      })
  })
</script>