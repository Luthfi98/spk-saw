
<div class="panel panel-primary panel-line">
  <header class="panel-heading">
    <h3 class="panel-title">Manajemen <?= $title ?></h3>
  </header>
  <div class="panel-body">
    <table width="100%" class="table table-hover table-responsive dataTable table-striped" id="dt-menu">
      <thead>
        <tr>
          <th width="1%">No.</th>
          <th width="20%">Main Menu</th>
          <th width="20%">Nama Menu</th>
          <th width="20%">Url</th>
          <th width="20%">Mempunyai Link?</th>
          <th width="1%">Ikon</th>
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
            <div class="modal-body">
                <form id="form">
                    <div class="form-group form-material" id="form_main_menu">
                        <label class="form-control-label" for="main_menu">Main Menu?</label>
                        <input type="hidden" name="id_menu" id="id_menu">
                        <select class="form-control" id="main_menu" name="main_menu">
                        </select>
                    </div>
                    <div class="form-group form-material" id="form_nama_menu">
                        <label class="form-control-label" for="nama_menu">Nama Menu</label>
                        <input type="text" name="nama_menu" id="nama_menu" placeholder="Nama Menu" class="form-control">
                    </div>
                    <div class="form-group form-material" id="form_mempunyai_link">
                        <label class="form-control-label" for="mempunyai_link">Mempunyai Lnk?</label>
                        <select class="form-control" name="mempunyai_link" id="mempunyai_link">
                            <option value="" disabled selected>Pilih</option>
                            <option value="0">Tidak Mempunyai Link</option>
                            <option value="1">Mempunyai Link</option>
                        </select>
                    </div>
                    <div class="form-group form-material" id="form_url_menu">
                        <label class="form-control-label" for="url_menu">Url Menu</label>
                        <input type="text" name="url_menu" id="url_menu" placeholder="Url Menu" class="form-control">
                    </div>
                    <div class="form-group form-material" id="form_ikon_menu">
                        <label class="form-control-label" for="ikon_menu">Ikon Menu</label>
                        <input type="text" name="ikon_menu" id="ikon_menu" placeholder="Ikon Menu" class="form-control">
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
        dt = $('#dt-menu').DataTable({
              processing: true,
              serverSide:true,
              multiselect:false,
              ajax: {
                "url": base+"getDataMenu",
                "type":"POST",
              },
              columnDefs: [
              {
                targets : [-1,0],
                orderable: false
              },
              {
                targets :[-1,-2],
                class: 'text-wrap text-center'
              }
              ],
              displayLength: 10,
              order : [],
            });


        })

    var main_menu = $('#form_main_menu')
    var nama_menu = $('#form_nama_menu')
    var mempunyai_link = $('#form_mempunyai_link')
    var url_menu = $('#form_url_menu')
    var ikon_menu = $('#form_ikon_menu')

    function clearAlert()
    {
        main_menu.removeClass('has-danger has-success')
        nama_menu.removeClass('has-danger has-success')
        mempunyai_link.removeClass('has-danger has-success')
        url_menu.removeClass('has-danger has-success')
        ikon_menu.removeClass('has-danger has-success')
    }

    function ButtonAdd() 
    {
        status ='add';
        $('#form')[0].reset();
        $('#modal-form').modal('show');
        $('.modal-title').text('Tambah Menu');
        $('.btn-simpan').attr('disabled', false)
        getOption();
        hide_url();
        hide_icon();
        clearAlert()    
    }

    function ButtonEdit(id_menu)
    {
        status ='edit';
        $('.btn-simpan').attr('disabled', false)
        clearAlert()    
        getOption();
        hide_url()
        hide_icon()
        $('#form')[0].reset(); // reset form on modals
        $.ajax({
          url:base+"getMenuById/"+id_menu,
          type:"POST",
          dataType:"JSON",
          success:function(response)
          {


            if (response.main_menu == '0') {    
                $('#main_menu').val('0');
                ikon_menu.show();
            }else{
                ikon_menu.hide();
                url_menu.show();
                $('#main_menu').val(response.main_menu);
            }

            $('#main_menu').val(response.main_menu)
            $('#id_menu').val(response.id_menu)
            $('#nama_menu').val(response.nama_menu)
            $('#url_menu').val(response.url_menu)
            $('#mempunyai_link').val(response.mempunyai_link)
            $('#ikon_menu').val(response.ikon_menu)

            $('#modal-form').modal('show');
            $('.modal-title').text('Ubah Menu');
          }
        });
    }

    function ButtonDelete(id_menu)
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
                  url:base+"delMenu/"+id_menu,
                  type:'post',
                  dataType:'JSON',
                  success:function(response)
                  {
                    dt.ajax.reload();
                    alertSuccess('Data Menu Berhasil '+response.alert)
                  }
                })
              }
            });
    }


    $('.btn-simpan').click(function(){
        $(this).attr('disabled', true)
        if (status == 'add') {
            var url = 'addMenu'
        }else{
            var url = 'editMenu'
        }

        simpanDataMenu(url,status)
    })

    function simpanDataMenu(url,status)
    {

        $.ajax({
            url:base+'simpanDataMenu/'+status,
            data:$('#form').serialize(),
            dataType:'JSON',
            type:'POST',
            success:function(response)
            {

                if (response.sukses == true) {
                    alertSuccess('Data Menu Berhasil '+response.alert)
                    $('#modal-form').modal('hide');
                    dt.ajax.reload()
                }else{
                    if (response.main_menu_error) {
                        main_menu.addClass('has-danger')
                    }else{
                        main_menu.addClass('has-success').removeClass('has-danger')
                    }
                    if (response.nama_menu_error) {
                        nama_menu.addClass('has-danger')
                    }else{
                        nama_menu.addClass('has-success').removeClass('has-danger')
                    }
                    if (response.mempunyai_link_error) {
                        mempunyai_link.addClass('has-danger')
                    }else{
                        mempunyai_link.addClass('has-success').removeClass('has-danger')
                    }
                    if (response.url_menu_error) {
                        url_menu.addClass('has-danger')
                    }else{
                        url_menu.addClass('has-success').removeClass('has-danger')
                    }
                    if (response.ikon_menu_error) {
                        ikon_menu.addClass('has-danger')
                    }else{
                        ikon_menu.addClass('has-success').removeClass('has-danger')
                    }

                    $('.btn-simpan').attr('disabled', false)

                }

            }
        })
    }


    function getOption()
    {
        $.ajax({
                url:base+"getOptionMain",
                type:"POST",
                dataType:"JSON",
                 async: false,            
                success:function(data)
                {

                    var html = '<option value="0">Main Menu</option>';
                    for ( i = 0 ; i < data.length ; i++ )
                    {
                       if(data[i]['main_nama_menu']==null){
                         html += '<option value="'+data[i].id_menu+'">'+data[i].nama_menu+'</option>';  
                       }else{
                         if(data[i]['nama_main_menu']==null){
                           html += '<option value="'+data[i].id_menu+'">'+data[i].main_nama_menu+' | '+data[i].nama_menu+'</option>';  
                         }else{
                           html += '<option value="'+data[i].id_menu+'">'+data[i].nama_main_menu+' | '+data[i].main_nama_menu+' | '+data[i].nama_menu+'</option>';  
                         }
                       }
                    }

                    $('#main_menu').html(html);
                }
          });
    }


    function hide_icon()
    {
        $("#form_ikon_menu").show();
        $("#main_menu").on('change keyup',function(){
            var icon = $("#main_menu").val();
            if(icon== 0){
              $("#form_ikon_menu").show();
            }else{
              $("#form_ikon_menu").hide();
            }
        });

    }

    function hide_url()
    {
        $("#form_url_menu").hide();
        $("#mempunyai_link").on('change keyup',function(){
            var flag = $("#mempunyai_link").val();
            if(flag=="0"){
              $("#form_url_menu").hide();
            }else if(flag=="1"){
              $("#form_url_menu").show();
            }else{
              $("#form_url_menu").hide();
            }
        });
    }
</script>