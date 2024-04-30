
            $(function(){
            $(document).on('click', '#delete_data', function(e){
            e.preventDefault();
            var link = $(this).attr("href");

            Swal.fire({
                title: 'Are you sure?',
                        text: "Delete This Data!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
            Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
            }
            })
            });
            });

            

            $(function(){
            $(document).on('click', '#delete_section', function(e){
            e.preventDefault();
            var link = $(this).attr("href");

            Swal.fire({
                title: 'Are you sure?',
                        text: "Delete Course Section!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
            Swal.fire(
                    'Deleted!',
                    'Course Section deleted.',
                    'success'
                    )
            }
            })
            });
            });

            


            $(function(){

                $(document).on('click','#ApproveBtn',function(e){
                e.preventDefault();
                var link = $(this).attr("href");

            Swal.fire({
                            // title: 'Are you sure?',
                            title:"You Can't Delete This Data After Approval",
                            text: "Approve This Data?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, Approve it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                            window.location.href = link
                            Swal.fire(
                                'Approved!',
                                'Your file has been Approved.',
                                'success'
                    )
            }
            })
            });
            });