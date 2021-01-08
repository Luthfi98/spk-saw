<div class="panel panel-primary panel-line">
  <header class="panel-heading">
    <h3 class="panel-title">Manajemen <?= $title ?></h3>
  </header>
  <div class="panel-body">
    <table width="100%" class="table table-hover table-responsive dataTable table-striped" id="dt-kriteria">
      <thead>
        <tr>
          <th width="1%">No.</th>
          <th width="5%">Kode Kriteria</th>
          <th width="20%">Nama Kriteria</th>
          <th width="5%">Bobot</th>
          <th width="5%">Jenis Kriteria</th>
          <th width="3%">Aksi
          </th>
            <!-- <button type="button" onclick="ButtonAdd()" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i></button> -->
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
                    <div class="form-group form-material" id="form_kode_kriteria">
                        <label class="form-control-label" for="kode_kriteria">Kode Kriteria</label>
                        <input type="text" readonly name="kode_kriteria" id="kode_kriteria" placeholder="Kode Kriteria" class="form-control">
                        <span class="text-danger" id="kode_kriteria_error"></span>
                    </div>
                    <div class="form-group form-material" id="form_kriteria">
                        <label class="form-control-label" for="kriteria">Nama Kriteria</label>
                        <input type="hidden" name="id_kriteria" id="id_kriteria">
                        <input type="text" autofocus="true" name="kriteria" id="kriteria" placeholder="Nama Kriteria" class="form-control">
                        <span class="text-danger" id="kriteria_error"></span>
                    </div>
                    <div class="form-group form-material" id="form_jenis">
                        <label class="form-control-label" for="jenis">Jenis Kriteria</label>
                        <select class="form-control" id="jenis" name="jenis">
                          <option value="" readonly selected>Pilih Jenis Kriteria</option>
                          <option value="Benefit">Benefit</option>
                          <option value="Cost">Cost</option>
                        </select>
                        <span class="text-danger" id="jenis_error"></span>
                    </div>
                    <div class="form-group form-material" id="form_bobot_kriteria">
                        <label class="form-control-label" for="bobot_kriteria">Bobot Kriteria</label>
                        <input type="text" name="bobot_kriteria" maxlength="4" id="bobot_kriteria" placeholder="Bobot Kriteria" class="form-control">
                        <span class="text-danger" id="bobot_kriteria_error"></span>
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


<script>
  $(document).ready(function(){
  dt = $('#dt-kriteria').DataTable({
          processing: true,
          serverSide:true,
          multiselect:false,
          ajax: {
            "url": base+"getDataKriteria",
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

  var kriteria = $('#form_kriteria')
  var kode_kriteria = $('#form_kode_kriteria')
  var jenis = $('#form_jenis')
  var bobot_kriteria = $('#form_bobot_kriteria')

  function clearAlert()
  {
      kriteria.removeClass('has-danger has-success')
      kode_kriteria.removeClass('has-danger has-success')
      jenis.removeClass('has-danger has-success')
      bobot_kriteria.removeClass('has-danger has-success')
  }

  function ButtonAdd()
  {
    status ='add';
    $('#form')[0].reset();
    $('#modal-form').modal('show').removeClass('modal-3d-sign').addClass('modal-3d-flip-horizontal');
    $('.modal-title').text('Tambah Kriteria');
    $('.btn-simpan').attr('disabled', false)
    clearAlert()
    $('.text-danger').empty()
    getKodeKriteria()
  }

  function getKodeKriteria()
  {
    $.ajax({
      url:base+'getKodeKriteria',
      type:'POST',
      dataType:'JSON',
      success:function(response)
      {
        $('#kode_kriteria').val(response)
      }
    })
  }

  function ButtonEdit(id_kriteria)
  {
      status ='edit';
      $('.btn-simpan').attr('disabled', false)
      clearAlert()    
      $('#form')[0].reset(); // reset form on modals
      $('.text-danger').empty()
      $.ajax({
        url:base+"getKriteriaById",
        type:"POST",
        data:{
          id_kriteria : id_kriteria
        },
        dataType:"JSON",
        success:function(response)
        {

          $('#id_kriteria').val(response.id)
          $('#kriteria').val(response.nama_kriteria)
          $('#kode_kriteria').val(response.kode_kriteria)
          $('#jenis').val(response.jenis_kriteria)
          $('#bobot_kriteria').val(response.bobot)
          $('#modal-form').modal('show').removeClass('modal-3d-flip-horizontal').addClass('modal-3d-sign');
          $('.modal-title').text('Ubah Kriteria');
        }
      });
  }


  $('.btn-simpan').click(function(){
      $.ajax({
          url:base+'simpanDataKriteria/'+status,
          data:$('#form').serialize(),
          dataType:'JSON',
          type:'POST',
          success:function(response)
          {

              if (response.sukses == true) {
                  alertSuccess('Data Kriteria Berhasil '+response.alert)
                  $('#modal-form').modal('hide');
                  dt.ajax.reload()
              }else{
                  if (response.kriteria_error) {
                      kriteria.addClass('has-danger')
                      $('#kriteria_error').html(response.kriteria_error)
                  }else{
                      kriteria.addClass('has-success').removeClass('has-danger')
                      $('#kriteria_error').empty()
                  }
                  if (response.kode_kriteria_error) {
                      kode_kriteria.addClass('has-danger')
                      $('#kode_kriteria_error').html(response.kode_kriteria_error)
                  }else{
                      kode_kriteria.addClass('has-success').removeClass('has-danger')
                      $('#kode_kriteria_error').empty()
                  }
                  if (response.jenis_error) {
                      jenis.addClass('has-danger')
                      $('#jenis_error').html(response.jenis_error)
                      $('#jenis').val('')
                  }else{
                      jenis.addClass('has-success').removeClass('has-danger')
                      $('#jenis_error').empty()
                  }
                  if (response.bobot_kriteria_error) {
                      bobot_kriteria.addClass('has-danger')
                      $('#bobot_kriteria_error').html(response.bobot_kriteria_error)
                  }else{
                      bobot_kriteria.addClass('has-success').removeClass('has-danger')
                      $('#bobot_kriteria_error').empty()
                  }
                  $('.btn-simpan').attr('disabled', false)

              }

          }
      })
  })

  function ButtonDelete(id_kriteria)
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
              url:base+"delKriteria",
              type:'post',
              data:{
                id_kriteria : id_kriteria
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
</script>