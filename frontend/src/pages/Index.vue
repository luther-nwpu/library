<template>  
  <div>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">              
              <table id="mytable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                  <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Rendering engine</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Browser</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Platform(s)</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Engine version</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">CSS grade</th></tr>
                </thead>
                <tbody>       
                  <tr role="row" class="odd">
                    <td class="sorting_1">Gecko</td>
                    <td>Firefox 1.0</td>
                    <td>Win 98+ / OSX.2+</td>
                    <td>1.7</td>
                    <td>A</td>
                  </tr>
                  </tbody>
                </tbody>
              </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  </div>
</template>
<script>
import axios from 'axios'
export default {
  data(){
    return {

    }
  },
  async mounted() {
      var res = await axios.get('/api/book/getall');
      console.log(res);
      this.$nextTick(function() {
        $('#mytable').DataTable({'columnDefs': [
            { 'width': '10%', 'targets': 0 },
            { 'width': '10%', 'targets': 1 },
            { 'width': '20%', 'targets': 2 },
            { 'width': '10%', 'targets': 3 },
            { 'width': '10%', 'targets': 4 },
            { 'width': '10%', 'targets': 5 },
            { 'width': '10%', 'targets': 6 }]
        })
      })
    }
  }
</script>
<style scoped>
</style>