<script>
    $(document).ready(function() {
        $("#createFrom").on("submit", function(e) {
            e.preventDefault(e);
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $(".form-control").removeClass("is-invalid");
                    $(".role").removeClass("is-invalid");
                    $(".invalid-feedback").remove();
                    $(".form-feedback").remove();
                    loderStart();
                },
                complete: function() {},
                success: function(response) {
                    loderStop();
                    if (response.data.status === "validation_error") {
                        printError(response.data.message);
                    } else if (response.data.status === "error") {
                        toastr.error(response.data.message);
                    } else {
                        toastr.success(response.data.message);
                        window.location = "{{ route('user.list') }}";
                    }
                },
                error: function(error) {
                    loderStop();
                    console.log(error);
                }
            });
        });

        $("#editFrom").on("submit", function(e) {
            e.preventDefault(e);
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $(".form-control").removeClass("is-invalid");
                    $(".role").removeClass("is-invalid");
                    $(".invalid-feedback").remove();
                    $(".form-feedback").remove();
                    loderStart();
                },
                complete: function() {},
                success: function(response) {
                    loderStop();
                    if (response.data.status === "validation_error") {
                        printError(response.data.message);
                    } else if (response.data.status === "error") {
                        toastr.error(response.data.message);
                    } else {
                        toastr.success(response.data.message);
                        window.location = "{{ route('user.list') }}";
                    }
                },
                error: function(error) {
                    loderStop();
                    console.log(error);
                }
            });
        });

        $(document).on('click', '.blockUser', function(e) {
            e.preventDefault();
            console.log('work');
            var row = $(this).closest('tr');
            var $this = $(this);
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Block This User!'
            }).then((result) => {
                if (result.value) {
                    $.post({
                        type: $this.data('method'),
                        url: $this.attr('href'),
                    }).done(function(data) {
                        if (data.success) {
                            Swal.fire(
                                'Blocked!',
                                'User has been Blocked.',
                                'success'
                            );
                            row.remove();
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed oparetion.',
                                'error'
                            );
                        }
                    });
                } else {
                    return false;
                }
            })
        });

        $(document).on('click', '.activeUser', function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var $this = $(this);
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Activate this User!'
            }).then((result) => {
                if (result.value) {
                    $.post({
                        type: $this.data('method'),
                        url: $this.attr('href'),
                    }).done(function(data) {
                        if (data.success) {
                            Swal.fire(
                                'Activated!',
                                'User has been Activate successfully.',
                                'success'
                            );
                            row.remove();
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed oparetion.',
                                'error'
                            );
                        }
                    });
                } else {
                    return false;
                }
            })
        });
    });
</script>
