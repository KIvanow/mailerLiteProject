function displayAllSubscribers( userId ){
    $.ajax({
        type: "GET",
        url: "api/subscribers",
        // contentType: "application/json",
        // dataType: "JSON",
        // data: {
        //     "subscriber_id": 1,
        //     "type": "number",
        //     "value": 4,
        //     "title": "test"
        // },
        success: (response)=>{
            generateAdminTableWithSubscribers( response );
        },
        error: (a,b,c) => {
            debugger;
        }
    });
}

function displayError( message ){
    alert( message ); //quick ungly way
}

function generateAdminTableWithSubscribers( subscribers ){
    var tableDomElement = document.getElementById( "adminSubscriberTable" );
    clearTable( tableDomElement );

    subscribers.forEach( ( subscriber )=>{
        var tr = document.createElement( "tr" );
        var tdSubscriberName = document.createElement( "td" );
        tdSubscriberName.innerHTML = subscriber.name;
        var tdSubscriberEmail = document.createElement( "td" );
        tdSubscriberEmail.innerHTML = subscriber.email;
        var tdSubscriberStatus = document.createElement( "td" );
        var statusSelection = document.createElement( "select" );
        statusSelection.className = "custom-select";
        ["active", "unsubscribed", "junk", "bounced", "unconfirmed"].forEach( (el, i)=>{
            var statusSelectionOption = document.createElement( "option" );
            statusSelectionOption.value = el;
            statusSelectionOption.innerHTML = el;
            statusSelection.add( statusSelectionOption );
            if( el == subscriber.state ){
                statusSelection.options[i].selected = true
            }
        });
        tdSubscriberStatus.appendChild( statusSelection );
        statusSelection.addEventListener("change", (e)=>{
            statusSelection.disabled = true;
            $.ajax({
                type: "PUT",
                url: "api/subscribers/" + subscriber.id,
                data:{
                    "id": subscriber.id,
                    "state": statusSelection.value
                }, success:()=>{
                    statusSelection.disabled = false;
                }
            });
        });
        var tdSubscriberDelete = document.createElement( "td" );
        tdSubscriberDelete.innerHTML = "x";
        tdSubscriberDelete.title = "Delete";
        tdSubscriberDelete.className = "deleteSubscriber alignCenter";
        tdSubscriberDelete.addEventListener( "click", ()=>{
            tableDomElement.removeChild( tr );
            $.ajax({
                type: "DELETE",
                url: "api/subscribers/" + subscriber.id
            });
        })

        tr.appendChild( tdSubscriberName );
        tr.appendChild( tdSubscriberEmail );
        tr.appendChild( tdSubscriberStatus );
        tr.appendChild( tdSubscriberDelete );

        tableDomElement.appendChild( tr );
    })

    addTableListeners( "adminSubscriberTable" );
}
