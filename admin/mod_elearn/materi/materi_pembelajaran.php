
<div class='row'>
  <div class='col-md-12'>
    <div class='box box-solid'>
      <div class='box-header with-border '>
        <h3 class='box-title'> Daftar Materi Pembelajaran</h3>
        <div class='box-tools pull-right '>
        </div>
      </div>
      <div class='box-body'>
        <!-- Button trigger modal -->
        <div class="form-group">
          <a id="btn_tambah" type="button" class="btn btn-primary mb-5" style="" >
            <i class="fas fa-plus-circle "></i> Tambah Materi
          </a>
          <a id="btn_tambah2" type="button" class="btn btn-default mb-5" style="display: none;" >
            <i class="fas fa-arrow-left"></i> Kembali
          </a>
          <button class="btn btn-success" data-toggle="modal" data-target="#myModal" ><i class="fa fa-info"></i> Panduan Youtube dan Goole Drive</button>
          <!-- Modal -->
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Cara Membagikan Link Materi</h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <b><h3>Link Youtube Yang Ingin Di Bagikan</h3></b><br>
                      1. Buka Yotube yang ingin di bagikan<br> 
                      2. Copy URL nya atau alamat yotubenya<br>
                      Contoh URLnya &nbsp;<i style="color: blue;"><a href="https://www.youtube.com/channel/UCkyRvjQoOXKtnfobSmiFjQw" target="_blank">https://www.youtube.com/channel/UCkyRvjQoOXKtnfobSmiFjQw</a></i>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <b><h3>Link Google Drive Yang Ingin Di Bagikan</h3></b><br>
                      1. Buka Google Drive<br>
                      2. Kemudian Pilih (File atau Folder juga bisa) yang ingin di bagikan<br> 
                      3. Klik icon titik 3 atau untuk ke menu bagikan <br>
                      4. Kemudian Pilih bagikan (nanti akan tampul url atau alamat)<br>
                      5. Copy URL atau alamatnya di sini (kolom materi tambah link google drive ) <br>
                    
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <b><h3>Link Yotube ID</h3></b><br>
                      1. Buka Yotube yang ingin di bagikan<br> 
                      2. Copy URL nya atau alamat yotubenya<br>
                      Contoh URLnya &nbsp;<i style="color: blue;">
                        <br>1. <a>https://www.youtube.com/watch?v=<b style="color: red;">UljftxURIfY</b></a> &nbsp;atau
                        <br>2. <a>www.youtube.com/watch?v=<b style="color: red;">UljftxURIfY</b></a><br></i>
                        Nah dari link di atas yang kita ambil atau yang kita copy <br>
                        adalah yang <b style="color: red;">warna merah</b>
                      
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

           
        
 
  <script>
    tinymce.init({
      selector: '.editor1',
      plugins: [
      'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars code fullscreen',
      'insertdatetime media nonbreaking save table contextmenu directionality',
      'emoticons template paste textcolor colorpicker textpattern imagetools uploadimage paste formula'
      ],

      toolbar: 'bold italic fontselect fontsizeselect | alignleft aligncenter alignright bullist numlist  backcolor forecolor | formula code | imagetools link image paste ',
      fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
      paste_data_images: true,

      images_upload_handler: function(blobInfo, success, failure) {
        success('data:' + blobInfo.blob().type + ';base64,' + blobInfo.base64());
      },
      image_class_list: [{
        title: 'Responsive',
        value: 'img-responsive'
      }],
      setup: function(editor) {
        editor.on('change', function() {
          tinymce.triggerSave();
        });
      }
    });
  </script>