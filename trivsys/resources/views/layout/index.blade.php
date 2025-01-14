<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trivsys Privet Limited</title>
    <link rel="shortcut icon" href="{{ asset('storage/img/logo-2.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    {{-- @yield('nav') --}}
    @yield('front.nav')
    @yield('front.search')

    @yield('home')


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        // function updateCustomerTrialStatus() {
        //     $.ajax({
        //         url: '/dashboard/update-customer-status',
        //         type: 'POST',
        //         dataType: 'json',
        //         data: {
        //             _token: '{{ csrf_token() }}',
        //         },
        //         success: function(response) {
        //             console.log('Customer status updated:', response);
        //         },
        //         error: function(error) {
        //             console.error('Error updating customer status:', error);

        //             setTimeout(updateCustomerTrialStatus, 1000);
        //         }
        //     });
        // }

        // setInterval(updateCustomerTrialStatus, 1800000);


         function searchTable() {
            const searchInput = document.getElementById("searchInput").value.toLowerCase();
            const tableBody = document.getElementById("tableBody");
            const rows = tableBody.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                let customerName = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase();
                let customerNumber = rows[i].getElementsByTagName("td")[2].textContent.toLowerCase();
                if (customerName.includes(searchInput) || customerNumber.includes(searchInput)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none"; // Hide rows that don't match
                }
            }
        }

        let statusInput = document.querySelectorAll('#input');
        let statusBtn = document.querySelectorAll('#statusBtn');

        statusBtn.forEach((btn) => {
            btn.addEventListener('click', function(e) {
                target = e.target;
                text = target.textContent;

                statusInput.forEach((input) => {
                    input.value = text;
                })

            });
        });
    </script>
</body>

</html>
