<template>
    <div id="addSubscriberForm" class="card">
        <div class="card-header">Add new subscriber to your newsletter</div>
        <form>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
            </div>
            <input id="userIdInputField" type="hidden" name="user_id">
            <button class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['userid'],
        mounted() {
            document.getElementById( "userIdInputField" ).value = this.userid;
            $("#addSubscriberForm form").submit(function(event){
                event.preventDefault();

                $.post({
                    url: '/api/subscribers/',
                    data: $("#addSubscriberForm form").serialize(),
                    success: ()=>{
                        displayAllSubscribers( this.userid );
                    },
                    error: (e)=>{
                        var message = "";
                        for( var error in e.responseJSON.errors ){
                            e.responseJSON.errors[ error ].forEach( (errorMessage)=>{
                                message += errorMessage + "\n";
                            })
                        }
                        displayError( message );
                    }
                });

            });
        }
    }
</script>
