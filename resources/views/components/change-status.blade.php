<input style="text-align: center" type="checkbox" class="checkBox"
       id="checkBox" name="materialUnchecked"
       {{ $row->status ? 'checked' : '' }} onclick="changeStatus({{$url}} , {{$row->id}},this) ">

<script>
    function changeStatus(url, id, obj) {
        var $input = $(obj);

        var status = 0;
        if ($input.prop('checked')) {
            var status = 1;
        }

        swal.fire({
            title: "آیا از عملیات مطمئن هستید؟",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            showCancelButton: true,
            cancelButtonColor: '#d33',
        })
            .then((result) => {
                if (result.value) {

                    $.ajax({
                        url: url + '/' + id + '/' + status,
                        type: "GET",
                        success: function () {
                            swal.fire({
                                title: "عملیات موفق",
                                text: "عملیات  با موفقیت انجام گردید",
                                icon: "success",
                                timer: '3500'

                            });
                            window.location.reload(true);
                        },
                        error: function () {
                            swal.fire({
                                title: "خطا...",
                                // text: data.message,
                                type: 'error',
                                timer: '3500'
                            })

                        }
                    });
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swal.fire(
                        'لغو',
                        'عملیات لغو گردید:)',
                        'error'
                    )

                    window.location.reload(true);
                }
            });

    }
</script>
