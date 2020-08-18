
<!-- $ID => Error display id name -->
error: function(jqXHR, exception) {
    if (jqXHR.status === 0) {
        $('#{{$ID}}').html('<span class="ajaxError">Not connect.\n Verify Network.</span>');
    } else if (jqXHR.status == 404) {
        $('#{{$ID}}').html('<span class="ajaxError">Requested page not found. [404]</span>');
    } else if (jqXHR.status == 500) {
        $('#{{$ID}}').html('<span class="ajaxError">Internal Server Error [500].</span>');
    } else if (exception === 'parsererror') {
        $('#{{$ID}}').html('<span class="ajaxError">Requested JSON parse failed.</span>');
    } else if (exception === 'timeout') {
        $('#{{$ID}}').html('<span class="ajaxError">Time out error.</span>');
    } else if (exception === 'abort') {
        $('#{{$ID}}').html('<span class="ajaxError">Ajax request aborted.</span>');
    } else {
        $('#{{$ID}}').html('<span class="ajaxError">Uncaught Error.\n' + jqXHR.responseText + '</span>');
    }
}
