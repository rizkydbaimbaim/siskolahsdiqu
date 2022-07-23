<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="fa fa-table"></i>Edit Soal Sorting
        </h1>
    </div>
</div>
<div class="col-md-13">
<div class="block full">
<?php
include "koneksi.php";
?>
<form action="detailsoal/soalsorting/prosesedit.php" method="post" >
    <input type="hidden" name="idgroup" value="<?php echo $_GET['idgroup']; ?>">
    <input type="hidden" name="idsoal" value="<?php echo $_GET['idsoal']; ?>">
    <input type="hidden" name="jenissoal" value="sorting">
    <?php $hasil = mysqli_query($mysqli,"select * from soal where idsoal='$_GET[idsoal]'");
    $tampil = mysqli_fetch_array($hasil); 
    $jawaban = explode(',',$tampil['pilihanbenar']); ?>
        <div class="form-group">
            <label>Soal</label>
            <div>
            <textarea id="textarea-ckeditor" name="soal"  class="ckeditor"><?php echo $tampil['soal']; ?></textarea></div>
        </div>
        <div class="form-group">
            <div class="form-inline">
            <select id="drop1" name="urutana" class="form-control" size="1">
                <option <?php if($jawaban[0] == "a"){echo "selected"; } ?> value="a">1</option>
                <option <?php if($jawaban[0] == "b"){echo "selected"; } ?> value="b">2</option>
                <option <?php if($jawaban[0] == "c"){echo "selected"; } ?> value="c">3</option>
                <option <?php if($jawaban[0] == "d"){echo "selected"; } ?> value="d">4</option>
                <option <?php if($jawaban[0] == "e"){echo "selected"; } ?> value="e">5</option>
            </select>
                <input type="text"  size="167" class="form-control" placeholder="pilihan A" name="pilihana" value="<?php echo $tampil['pilihana'];?>">
            </div>
        </div>
        <div class="form-group">
            <div class="form-inline">
            <select id="drop2" name="urutanb" class="form-control" size="1">
                <option <?php if($jawaban[1] == "a"){echo "selected"; } ?> value="a">1</option>
                <option <?php if($jawaban[1] == "b"){echo "selected"; } ?> value="b">2</option>
                <option <?php if($jawaban[1] == "c"){echo "selected"; } ?> value="c">3</option>
                <option <?php if($jawaban[1] == "d"){echo "selected"; } ?> value="d">4</option>
                <option <?php if($jawaban[1] == "e"){echo "selected"; } ?> value="e">5</option>
            </select>
                <input type="text"  size="167" class="form-control" placeholder="pilihan B" name="pilihanb" value="<?php echo $tampil['pilihanb'];?>">
            </div>
        </div>
        <div class="form-group">
            <div class="form-inline">
            <select id="drop3" name="urutanc" class="form-control" size="1">
            <option <?php if($jawaban[0] == "a"){echo "selected"; } ?> value="a">1</option>
                <option <?php if($jawaban[2] == "b"){echo "selected"; } ?> value="b">2</option>
                <option <?php if($jawaban[2] == "c"){echo "selected"; } ?> value="c">3</option>
                <option <?php if($jawaban[2] == "d"){echo "selected"; } ?> value="d">4</option>
                <option <?php if($jawaban[2] == "e"){echo "selected"; } ?> value="e">5</option>
            </select>
                <input type="text"  size="167" class="form-control" placeholder="pilihan C" name="pilihanc" value="<?php echo $tampil['pilihanc'];?>">
            </div>
        </div>
        <div class="form-group">
            <div class="form-inline">
            <select id="drop4" name="urutand" class="form-control" size="1">
            <option <?php if($jawaban[0] == "a"){echo "selected"; } ?> value="a">1</option>
                <option <?php if($jawaban[3] == "b"){echo "selected"; } ?> value="b">2</option>
                <option <?php if($jawaban[3] == "c"){echo "selected"; } ?> value="c">3</option>
                <option <?php if($jawaban[3] == "d"){echo "selected"; } ?> value="d">4</option>
                <option <?php if($jawaban[3] == "e"){echo "selected"; } ?> value="e">5</option>
            </select>
                <input type="text"  size="167" class="form-control" placeholder="pilihan D" name="pilihand" value="<?php echo $tampil['pilihand'];?>">
            </div>
        </div>
        <div class="form-group">
            <div class="form-inline">
            <select id="drop5" name="urutane" class="form-control" size="1">
            <option <?php if($jawaban[0] == "a"){echo "selected"; } ?> value="a">1</option>
                <option <?php if($jawaban[4] == "b"){echo "selected"; } ?> value="b">2</option>
                <option <?php if($jawaban[4] == "c"){echo "selected"; } ?> value="c">3</option>
                <option <?php if($jawaban[4] == "d"){echo "selected"; } ?> value="d">4</option>
                <option <?php if($jawaban[4] == "e"){echo "selected"; } ?> value="e">5</option>
            </select>
                <input type="text"  size="167" class="form-control" placeholder="pilihan E" name="pilihane" value="<?php echo $tampil['pilihane'];?>">
            </div>
        </div>
        <div class="form-group">
            <label>Pembahasan</label>
            <div>
            <textarea id="textarea-ckeditor" name="pembahasan"  class="ckeditor"><?php echo $tampil['pembahasan']; ?></textarea></div>
        </div>
        <div class="form-group form-actions">
            <div >
                <button type="submit" onclick="return checkDropdowns();" name="submit" class="btn btn-sm btn-primary">Edit Soal</button>
            </div>
        </div>
    </form>
</div>
</div>
<script type="text/javascript">
    function checkDropdowns()
    {
        // The number of dropdowns you have (use the naming convention 'dropx' as an id attribute)
        var iDropdowns = 5; 
        
        var sValue;
        var sValue2;
        // Loop over dropdowns
        for(var i = 1; i <= iDropdowns; ++i)
        {
            // Get selected value
            sValue = document.getElementById('drop'+i).value;
            
            // Nested loop - loop over dropdowns again
            for(var j = 1; j <= iDropdowns; ++j)
            {
                // Get selected value
                sValue2 = document.getElementById('drop'+j).value;
                // If we're not checking the same dropdown and the values are the same...
                if ( i != j && sValue == sValue2 )
                {
                    // ...we have a duplicate!
                    alert('Maaf, periksa kembali urutan jawaban anda. Sepertinya ada yang duplikat');
                    
                    return false;
                }
            }
        }
        
        // No duplicates
        return true;
    }
</script>
<script src="js/helpers/ckeditor/ckeditor.js"></script>
