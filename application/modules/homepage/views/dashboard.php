<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type='text/javascript'>
    submit = function(){
		var key= document.getElementById('filter').value;
        var table  = document.getElementById('detail_jembatan');
        rows   = table.tBodies[0].rows;
        fields = { indexkey: 4 };

        // loop over rows
        for (var i = 0, n = rows.length; i < n; i++) {
            // get the numerical score; notice the unary-plus (+) for integer conversion
            var fieldCheck = rows[i].cells[fields.indexkey].innerText;
            // console.log(fieldCheck);

            if (fieldCheck.toLowerCase() != key.toLowerCase()) {
                // hidden[i] = rows[i];               // cache hidden row
                rows[i].style.display = 'none';    // hide the entire row
            } 
            // if row has a good value, make sure its shown (unhide if hidden)
            else {
                // make sure another method didn't already unhide it
                // if (hidden.hasOwnProperty(i)) {
                //     hidden['' + i].style.display = ''; // set the styling so its visible
                //     delete hidden[i];                  // no longer need the value in cache
                // }
                rows[i].style.display = 'table-row';
            }
        }

        // return false;
    };
    
    reset = function(){
        var table  = document.getElementById('detail_jembatan');
        rows   = table.tBodies[0].rows;
        
        // loop over rows
        for (var i = 0, n = rows.length; i < n; i++) {
            rows[i].style.display = 'table-row';
        }
        document.getElementById('filter').value = "";
    };
</script>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Daftar Jembatan</strong>
        </div>
        <div class="col-lg-8">
            <div class="card-body card-block">
                <div class="row form-group">
                    <div class="col col-md-2"><label for="filter" class=" form-control-label">Kabupaten</label></div>
                    <div class="col-12 col-md-4">
                        <input type="text" id="filter" name="filter" placeholder="..." class="form-control">
                    </div>
                    <div class="col col-md-3">
                        <button type="cari" class="btn btn-primary btn-sm" onclick="submit()">
                            <i class="fa fa-dot-circle-o"></i> Cari
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm" onclick="reset()">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="detail_jembatan">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Jembatan</th>
                    <th scope="col">Ruas</th>
                    <th scope="col">Propinsi</th>
                    <th scope="col">Kabupaten</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                $i = 1;
                foreach($jembatan as $key => $val){
                    $link_url = base_url().'jembatan/view/detail/'.$val['id'];
                    $link_url_hapus = base_url().'jembatan/view/hapus/'.$val['id'];
                    echo '
                    <tr>
                        <th scope="row">'.$i.'</th>
                        <td>'.$val['nama'].'</td>
                        <td>'.$val['ruas'].'</td>
                        <td>'.$val['propinsi'].'</td>
                        <td>'.$val['kabupaten'].'</td>
                        <td><a href="'.$link_url.'">Lihat Detail</a> | <a href="'.$link_url_hapus.'">Hapus</a></td>
                    </tr>
                    ';
                    $i++;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
