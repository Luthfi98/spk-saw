<div class="row">
    <div class="col-xl-4 col-md-4">
      <!-- Widget Linearea One-->
      <div class="card card-shadow" id="widgetLineareaOne">
        <div class="card-block p-20 pt-10">
          <div class="clearfix">
            <div class="grey-800 float-left py-10">
              <i class="icon md-account grey-600 font-size-24 vertical-align-bottom mr-5"></i>Pengguna
            </div>
            <span class="float-right grey-700 font-size-30"><?= $akun->num_rows() ?></span>
          </div>
          <div class="grey-500">
            <i class="fa fa-link green-500 font-size-16"><a href="<?= base_url('pengguna/manajemen-akun') ?>" class="ml-3"> Lihat Selengkapnya...</a></i>
          </div>
        </div>
      </div>
      <!-- End Widget Linearea One -->
    </div>
    <div class="col-xl-4 col-md-4">
      <!-- Widget Linearea Two -->
      <div class="card card-shadow" id="widgetLineareaTwo">
        <div class="card-block p-20 pt-10">
          <div class="clearfix">
            <div class="grey-800 float-left py-10">
              <i class="icon md-flash grey-600 font-size-24 vertical-align-bottom mr-5"></i>Kriteria
            </div>
            <span class="float-right grey-700 font-size-30"><?= $kriteria->num_rows() ?></span>
          </div>
          <div class="grey-500">
            <i class="fa fa-link green-500 font-size-16"><a href="<?= base_url('master/manajemen-kriteria') ?>" class="ml-3"> Lihat Selengkapnya...</a></i>
          </div>
        </div>
      </div>
      <!-- End Widget Linearea Two -->
    </div>
    <div class="col-xl-4 col-md-4">
      <!-- Widget Linearea Three -->
      <div class="card card-shadow" id="widgetLineareaThree">
        <div class="card-block p-20 pt-10">
          <div class="clearfix">
            <div class="grey-800 float-left py-10">
              <i class="icon md-chart grey-600 font-size-24 vertical-align-bottom mr-5"></i>Alternatif
            </div>
            <span class="float-right grey-700 font-size-30"><?= $alternatif->num_rows() ?></span>
          </div>
          <div class="grey-500">
            <i class="fa fa-link green-500 font-size-16"><a href="<?= base_url('master/manajemen-alternatif') ?>" class="ml-3"> Lihat Selengkapnya...</a></i>
          </div>
        </div>
      </div>
      <!-- End Widget Linearea Three -->
    </div>
</div>