function displayUserSubscribers( userId ){
    $.ajax({
        type: "GET",
        url: "api/user/" + userId,
        // contentType: "application/json",
        // dataType: "JSON",
        // data: {
        //     "subscriber_id": 1,
        //     "type": "number",
        //     "value": 4,
        //     "title": "test"
        // },
        success: (response)=>{
            generateTableWithSubscribers( response );
        },
        error: (a,b,c) => {
            debugger;
        }
    });
}

function displayError( message ){
    alert( message ); //quick ungly way
}

function generateTableWithSubscribers( subscribers ){
    var tableDomElement = document.getElementById( "subscriberTable" );
    clearTable( tableDomElement );

    subscribers.forEach( ( subscriber )=>{
        var tr = document.createElement( "tr" );
        var tdSubscriberName = document.createElement( "td" );
        tdSubscriberName.innerHTML = subscriber.name;
        var tdSubscriberEmail = document.createElement( "td" );
        tdSubscriberEmail.innerHTML = subscriber.email;
        var tdSubscriberStatus = document.createElement( "td" );
        tdSubscriberStatus.innerHTML = subscriber.state;
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

    addTableListeners("subscriberTable");
}

function addTableListeners(tableId){
    const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

    const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
        v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
        )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

    // do the work...
    document.querySelectorAll('#' + tableId + ' th').forEach(th => th.addEventListener('click', (() => {
        const table = th.closest('table');
        Array.from(table.querySelectorAll('tr:nth-child(n+2)'))
            .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
            .forEach(tr => table.appendChild(tr) );
    })));
}

function clearTable( tableDomNode ){
    while( tableDomNode.children.length > 2 ){ //leave the headers row
        tableDomNode.removeChild( tableDomNode.firstChild );
    }
}
