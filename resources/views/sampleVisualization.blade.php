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
                    type: "DELETE",
                    url: "api/fields/51",
                    // contentType: "application/json",
                    // dataType: "JSON",
                    // data: {
                    //     "title": "asdasjdsddasjhdi1231723",
                    //     "type": "string",
                    //     "subscriber_id": 4
                    // },
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
