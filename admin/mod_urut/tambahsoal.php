<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="fa fa-table"></i>Tambah Soal Sorting
        </h1>
    </div>
</div>
<div class="col-md-13">
<div class="block full">

<form action="detailsoal/soalsorting/prosestambah.php" method="post" >
    <input type="hidden" name="idgroup" value="<?php echo $_GET['idgroup']; ?>">
    <input type="hidden" name="jenissoal" value="shortanswer">
        <div class="form-group">
            <label>Soal</label>
            <div>
            <textarea id="textarea-ckeditor" name="soal"  class="ckeditor"></textarea></div>
        </div>
        <div class="form-group">
            <div class="form-inline">
            <select id="drop1" name="urutana" class="form-control" size="1">
                <option value="a">1</option>
                <option value="b">2</option>
                <option value="c">3</option>
                <option value="d">4</option>
                <option value="e">5</option>
            </select>
                <input type="text" name="pilihana" size="167" class="form-control" placeholder="pilihan A">
            </div>
        </div>
        <div class="form-group">
            <div class="form-inline">
            <select id="drop2" name="urutanb" class="form-control" size="1">
                <option value="a">1</option>
                <option value="b">2</option>
                <option value="c">3</option>
                <option value="d">4</option>
                <option value="e">5</option>
            </select>
                <input type="text"  name="pilihanb" size="167" class="form-control" placeholder="pilihan B">
            </div>
        </div>
        <div class="form-group">
            <div class="form-inline">
            <select id="drop3" name="urutanc" class="form-control" size="1">
                <option value="a">1</option>
                <option value="b">2</option>
                <option value="c">3</option>
                <option value="d">4</option>
                <option value="e">5</option>
            </select>
                <input type="text"  name="pilihanc" size="167" class="form-control" placeholder="pilihan C">
            </div>
        </div>
        <div class="form-group">
            <div class="form-inline">
            <select id="drop4" name="urutand" class="form-control" size="1">
                <option value="a">1</option>
                <option value="b">2</option>
                <option value="c">3</option>
                <option value="d">4</option>
                <option value="e">5</option>
            </select>
                <input type="text"  name="pilihand" size="167" class="form-control" placeholder="pilihan D">
            </div>
        </div>
        <div class="form-group">
            <div class="form-inline">
            <select id="drop5" name="urutane" class="form-control" size="1">
                <option value="a">1</option>
                <option value="b">2</option>
                <option value="c">3</option>
                <option value="d">4</option>
                <option value="e">5</option>
            </select>
                <input type="text"  name="pilihane" size="167" class="form-control" placeholder="pilihan E">
            </div>
        </div>
        <div class="form-group form-actions">
            <div >
                <button type="submit" onclick="return checkDropdowns();" name="submit" class="btn btn-sm btn-primary">Tambah Soal</button>
            </div>
        </div>
    </form>
</div>
</div>
<script src="js/helpers/ckeditor/ckeditor.js"></script>
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
                alert('Maaf ada data anda yang duplikat');
                
                return false;
            }
        }
    }
    
    // No duplicates
    return true;
}
    </script>
