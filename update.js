
// function to update likes

function Update_like(id_name){

    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'update.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function(){
        if(this.readyState == 4 ){
            console.log(this.responseText);

            // If response is 1, its a success
            if(this.responseText == 1){
                // alert('Like done');
            }else{
                alert('Unable');
            }

        }else{
            alert('Please try again');
        }
    }

    // Items will be sent as json
    xhr.send("id_name=" + JSON.stringify({"value":id_name}));
}
