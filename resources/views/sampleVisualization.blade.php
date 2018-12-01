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
                    url: "api/fields/",
                    // contentType: "application/json",
                    // dataType: "JSON",
                    data: {
                        "subscriber_id": 1,
                        "type": "number",
                        "value": 4,
                        "title": "test"
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
