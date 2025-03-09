
<script>
    $(document).ready(function () {

        // --------------- Create Form Submission ---------------
        $("#createFrm").on("submit", function (e) {
            e.preventDefault();
            let formData = new FormData(this);
    
            $.ajax({
                url: $(this).attr("action"),
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.data.status === "validation_error") {
                        printError(response.data.message);
                    } else if (response.data.status === "error") {
                        toastr.error(response.data.message);
                    } else {
                        toastr.success(response.data.message);
                        window.location.href = "{{ route('rent_types.list') }}";
                    }
                },
                error: function (error) {
                    console.error(error);
                },
            });
        });
        // --------------- End Create Form Submission ---------------
    
    
        // --------------- Update Form Submission ---------------
        $("#updateFrm").on("submit", function (e) {
            e.preventDefault();
            let formData = new FormData(this);
    
            $.ajax({
                url: $(this).attr("action"),
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    if (response.data.status === "validation_error") {
                        printError(response.data.message);
                    } else if (response.data.status === "error") {
                        toastr.error(response.data.message);
                    } else {
                        toastr.success(response.data.message);
                        window.location.href = "{{ route('rent_types.list') }}";
                    }
                },
                error: function (error) {
                    console.error(error);
                },
            });
        });
        // --------------- End Update Form Submission ---------------
    
    
        // --------------- Delete Operation ---------------
        $(document).on('click', '.deleteRow', function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var $this = $(this);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.post({
                        type: $this.data('method'),
                        url: $this.attr('href'),
                    }).done(function(data) {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'Your data has been deleted.',
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
        // --------------- End Delete Operation ---------------

        $(document).on('click', '.blockData', function(e) {
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
                confirmButtonText: 'Yes, Block This!'
            }).then((result) => {
                if (result.value) {
                    $.post({
                        type: $this.data('method'),
                        url: $this.attr('href'),
                    }).done(function(data) {
                        if (data.success) {
                            Swal.fire(
                                'Blocked!',
                                'Record has been Blocked.',
                                'success'
                            );
                            row.remove();
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed operation.',
                                'error'
                            );
                        }
                    });
                } else {
                    return false;
                }
            })
        });

        $(document).on('click', '.activeData', function(e) {
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
                confirmButtonText: 'Yes, Activate this Record!'
            }).then((result) => {
                if (result.value) {
                    $.post({
                        type: $this.data('method'),
                        url: $this.attr('href'),
                    }).done(function(data) {
                        if (data.success) {
                            Swal.fire(
                                'Activated!',
                                'Record has been Activate successfully.',
                                'success'
                            );
                            row.remove();
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed operation.',
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