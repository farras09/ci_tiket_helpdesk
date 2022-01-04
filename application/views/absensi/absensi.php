   <!-- DataTables -->
   <?= $this->session->flashdata('pesan'); ?>
   <div class="card shadow mb-4">
       <div class="card-header py-3">
           <div class="row">
               <div class="col">
                   <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                       Data Absensi
                   </h4>
               </div>
               <!-- <div class="col-auto">
                       <a href="<?= site_url('pegawai/add'); ?>" class="btn btn-sm btn-primary btn-icon-split">
                           <span class="icon">
                               <i class="fa fa-plus"></i>
                           </span>
                           <span class="text">
                               Tambah Pegawai
                           </span>
                       </a>
                   </div>
                -->
           </div>
       </div>

       <div class="card-body">
           <?php if ($this->uri->segment(2) == 'absensi') : ?>
               <div id="myMap" style="position:relative;width:100%;height:200px; margin: bottom 30px;"></div>
           <?php endif; ?>
           <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                       <tr>
                           <th>No.</th>
                           <th>Tanggal</th>
                           <th>Nama Pegawai</th>
                           <th>Jam Masuk</th>
                           <th>Jam Keluar</th>
                           <th>Status Kehadiran</th>
                           <th>Keterangan Kehadiran</th>
                           <th>Aksi</th>
                       </tr>
                   </thead>

                   <tbody>

                       <?php
                        $no = 1;
                        $counter = 0;
                        if ($absensi) :
                            // $counter = count($absensi);
                            foreach ($absensi as $m) :
                        ?>
                               <tr>
                                   <td><?= $no++; ?></td>
                                   <td><?= $m['tanggal_masuk']; ?></td>
                                   <td><?= $m['nama_pegawai']; ?></td>
                                   <td><?= date('H:i:s', strtotime($m['jam_masuk'])); ?></td>
                                   <td><?= date('H:i:s', strtotime($m['jam_keluar'])); ?></td>
                                   <td><?= $m['status_kehadiran_id']; ?></td>
                                   <td><?= $m['lokasi_pegawai_id']; ?></td>


                                 
                                   <td>
                                       <a href="#" data-toggle="modal" data-target="#absenModal<?= $m['id_absen']; ?>"><i class="fa fa-edit"></i></a>
                                   </td>
                               </tr>
                               <div class="modal fade" id="absenModal<?= $m['id_absen']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                   <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">Update Absensi Pegawai</h5>
                                               <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">×</span>
                                               </button>
                                           </div>
                                           <div class="modal-body">


                                               <?php echo form_open('absensi/updateAbsenPegawai', [], ['id' => $m['id_absen']]); ?>
                                               <input type="hidden" name="id" value="<?= set_value('id_absen', $m['id_absen']); ?>">

                                               <?php
                                                // $kehadiran_id = array('Hadir', 'Alfa', 'Terlambat', 'Izin', 'Cuti');
                                                $kehadiran_id = array('Izin', 'Cuti');
                                                ?>
                                               <div class="form-group">
                                                   <select name="status_kehadiran_id" class="form-control">
                                                       <?php
                                                        foreach ($kehadiran_id as $kehadiran) : ?>
                                                           <option <?= $m['status_kehadiran_id'] == $kehadiran ? 'selected' : ''; ?> value="<?= $kehadiran; ?>"><?= $kehadiran; ?></option>
                                                       <?php endforeach; ?>
                                                       ?>

                                                   </select>
                                               </div>
                                               <!-- <div class="form-group">
                                                   <select name="lokasi_pegawai_id" class="form-control">
                                                       <?php
                                                        foreach ($keterangan as $keterangan_hadir) : ?>
                                                           <option <?= $m['lokasi_pegawai_id'] == $keterangan_hadir['lokasi_pegawai'] ? 'selected' : ''; ?> value="<?= $keterangan_hadir['lokasi_pegawai']; ?>"><?= $keterangan_hadir['lokasi_pegawai']; ?></option>
                                                       <?php endforeach; ?>
                                                       ?>

                                                   </select>
                                               </div> -->
                                           </div>
                                           <div class="modal-footer">
                                               <button class="btn btn-success" type="submit">Proses</button>
                                               <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                                           </div>
                                           </form>
                                       </div>
                                   </div>
                               </div>
                           <?php endforeach; ?>
                       <?php else : ?>
                           <td colspan="9" class="text-center">
                               Data Kosong
                           </td>
                       <?php endif; ?>
                   </tbody>
               </table>
           </div>
       </div>
   </div>
   <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
   <script src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap' type='text/javascript'></script>
   <script type='text/javascript'>
       var map = null,
           infobox, dataLayer;

       function GetMap() {


           var map = new Microsoft.Maps.Map('#myMap', {
               credentials: 'ApcXBKlN_q_gUCdAPx54Q6TJIPas_388n869bziBh0wIXZ650y4yL63uw1dikV2u',
               center: new Microsoft.Maps.Location(0.510440, 101.438309),
               //   mapTypeId: Microsoft.Maps.MapTypeId.aerial,
               zoom: 8
           });
           infobox = new Microsoft.Maps.Infobox(map.getCenter(), {
               visible: false
           });

           var counter = <?php echo json_encode($absensi) ?>;
           var i = 0;
           for (i = 0, len = counter.length; i < len; i++) {
               var pin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(counter[i]['latitude'], counter[i]['longitude']), {
                   title: counter[i]['nama_pegawai'],
                   subTitle: counter[i]['lokasi_pegawai_id'],
                   color: 'red'
               });
               map.entities.push(pin);
               //    alert(counter.length);

               //Add the pushpin to the map

               //    AddData(counter[i]);
           }

       }

       // Fungsi create pin, metadata dan event click
       function AddData(location) {
           //Create Pin


           //Create custom Pushpin



       }
   </script>