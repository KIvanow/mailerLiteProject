var displayUserSubscribers = (userId)=>{
    $.ajax({
        type: "GET",
        url: "api/subscribers/activate/" + userId,
        // contentType: "application/json",
        // dataType: "JSON",
        // data: {
        //     "subscriber_id": 1,
        //     "type": "number",
        //     "value": 4,
        //     "title": "test"
        // },
        success: (response)=>{
            console.log( response );
        },
        error: (a,b,c) => {
            debugger;
        }
    });
}
