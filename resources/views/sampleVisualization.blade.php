<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                $.ajax({
                    type: "POST",
                    url: "api/subscribers",
                    // contentType: "application/json",
                    // dataType: "JSON",
                    data: {
                        "email": "tester@gmail.com",
                        "name": "asdasdasd",
                        // "state": "unconfirmed"
                    },
                    success: (response)=>{
                        console.log( response );
                    },
                    error: (a,b,c) => {
                        debugger;
                    }
                  });

            </script>
    </body>

</html>
