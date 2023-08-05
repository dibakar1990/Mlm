

<div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                
            </div>
            <div id="notify"> @include('frontend.layouts.alerts')</div>
            <div class="modal-body" id="AjaxModalBody">
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
            </div>
            </div>
        </div>
    </div>
 
    <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- status change modal -->
<div id="statusChange" class="modal" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
      <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Status Change</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <p>Select below button for set current status</p>
              </div>
              <div class="modal-footer">
                  <form id="statusChangeForm" action="" method="post">
                      @csrf
                      @method('PUT')
                      <button type="submit" class="btn btn-sm btn-success btn-sm" name="status" value="1">Active</button>
                      <button type="submit" class="btn btn-sm btn-danger btn-sm" name="status" value="0">Inactive</button>
                  </form>

              </div>
          </div>
      </div>
  </div>
<!-- delete confirm modal -->
  <div id="deleteConfirm" class="modal" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you, want to delete?</p>
          </div>
          <div class="modal-footer">
            <form id="deleteChangeForm" action="" method="post">
                @csrf
                @method('DELETE')
              <!-- <a href="" class="btn btn-danger btn-sm" id="delete_btn">Delete</a> -->
              <button type="submit" class="btn btn-sm btn-danger btn-sm" name="delete">Delete</button>
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" class="markasreadUrl" value="{{route('user.markNotification')}}">
<!-- jQuery -->
<script src="{{url('frontend/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('frontend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url('frontend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{url('frontend/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{url('frontend/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{url('frontend/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{url('frontend/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('frontend/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url('frontend/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('frontend/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('frontend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{url('frontend/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{url('frontend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('frontend/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('frontend/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<!-- <script src="{{url('frontend/dist/js/pages/dashboard.js')}}"></script> -->
<script src="{{url('frontend/dist/js/main.js')}}"></script>


<script>
    function statusChange(route){
        $(document).find('#statusChangeForm').attr('action', route);
    }

    function deleteConfirm(route){
      $(document).find('#deleteChangeForm').attr('action',route);
    }

</script>

@yield('js')
<style>
  .nav-icon {
    font-size: .875rem!important;
  }
</style>

</body>
</html>
