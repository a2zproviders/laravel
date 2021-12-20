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
{{ Html::script('https://checkout.razorpay.com/v1/checkout.js')}}
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
{{ HTML::script('js/custom-script.js') }}
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
    // $("#order_search").on('keyup', function() {
    //   $('#orderForm').submit();
    // });

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


<script>
  $('#rzp-footer-form').submit(function(e) {
    var button = $(this).find('button');
    var parent = $(this);
    button.attr('disabled', 'true').html('Please Wait...');
    $.ajax({
      method: 'get',
      url: this.action,
      data: $(this).serialize(),
      complete: function(r) {
        console.log('complete');
        //console.log(r);
      }
    })
    return false;
  })
</script>

<script>
  // let baseUrl = $('#base_url').data('url');

  function demoSuccessHandler(transaction) {
    let form = $('#checkoutForm')[0];

    // You can write success code here. If you want to store some data in database.
    $("#paymentDetail").removeAttr('style');
    if (transaction) {
      $('#paymentID').val(transaction.razorpay_payment_id);
    }

    let formData = new FormData(form);
    let file = $('input[type=file]')[0].files[0];
    formData.append('file', file);

    $.ajax({
      method: 'post',
      url: "{!! route('order.store') !!}",
      processData: false,
      contentType: false,
      data: formData,
      success: function(r) {
        if (r.status) {
          var base_url = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
          window.location = base_url + "admin/home";
          console.log('complete');
        }
      }
    })
  }

  function razor_py(price) {
    var options = {
      key: "{{ env('RAZORPAY_KEY') }}",
      amount: price * 100,
      name: 'Printing Services',
      description: 'Printing Services',
      image: '',
      prefill: {
        "email": "{{ @Auth::user()->email }}",
        "contact": "{{ @Auth::user()->mobile }}"
      },
      handler: demoSuccessHandler
    }

    window.r = new Razorpay(options);
    r.open();
  }

  $(document).on('submit', '#checkoutForm', function(e) {
    e.preventDefault();
    is_valid = $(this).is_valid();
    if (is_valid) {
      let order_price = $('#inquery_price').data('price');
      $('#order_price').val(order_price);
      let order_gst_price = $('#inquery_gst').data('price');
      $('#order_gst_price').val(order_gst_price);
      let order_total_price = $('#inquery_total_price').data('price');
      $('#order_total_price').val(order_total_price);
      razor_py(order_total_price);
    }
  });
</script>

</body>

</html>