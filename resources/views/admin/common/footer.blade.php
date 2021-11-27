<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="{{ route('admin_logout') }}">Logout</a>
      </div>
    </div>
  </div>
</div>







{{ HTML::script('assets/vendor/jquery/jquery.min.js') }}
{{ HTML::script('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}
{{ HTML::script('assets/vendor/jquery-easing/jquery.easing.min.js') }}
{{ HTML::script('assets/js/sb-admin-2.min.js') }}
{{ HTML::script('datatables/jquery.dataTables.min.js') }}
{{ HTML::script('datatables/dataTables.bootstrap4.min.js') }}
{{ HTML::script('assets/js/validation.js') }}
{{ HTML::script('assets/js/tinymce.min.js') }}
{{ HTML::script('assets/js/select-script.js') }}
{{ HTML::script('assets/js/angular-search.js') }}
{{ HTML::script('datatables/datatables-demo.js') }}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

{{ HTML::script('assets/js/custom-script.js') }}
<script type="text/javascript">
  $(document).ready(function() {
    var token = '{{ csrf_token() }}';
    $('#delete_all').on('click', function(e) {
      e.preventDefault();

      var allVals = [];
      $(".sub_chk:checked").each(function(e) {
        allVals.push($(this).attr('data-id'));
      });
      if (allVals.length <= 0) {
        alert("Please select row?");
      } else {
        let check = confirm("Are you sure you want to delete this row?");
        let form = $(this).closest('form');

        if (check) {
          var join_selected_value = allVals.join(",");

          $.ajax({
            url: $(this).data('url'),
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'POST',
            data: form.serialize(),
            success: function(data) {
              location.reload();
            }
          });
        }
      }
    });
  });


  function statuschange(self) {
    let status = self.value,
      url = $(self).data('url');

    window.location = url + "/?field=status&status=" + status;
  }
</script>
<script>
  $(function() {
    $("#datepicker").datepicker({
      minDate: 0
    });
  });
</script>
<script>
  $(function() {
    $(document).on('change', 'select.weight-select', function() {

      var pid = $(this).val();
      // var selectedCountry = s.val();
      var value = $(this).find('option:selected').attr('data-pc');
      $("#city_pc").val(value);

    });

  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $(".input-add").click(function() {
      var html = $(".clone").html();
      $(".increment").after(html);
    });
    $("body").on("click", ".input-remove", function() {
      $(this).parents(".control-group").remove();
    });
  });
</script>


</body>

</html>