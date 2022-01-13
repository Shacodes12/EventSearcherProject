function checkout(){
    // Check if any items are in cart
    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'add.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function(){
        if(this.readyState == 4 ){
            console.log(this.responseText);

            // If response is 1, orders were placed
            if(this.responseText == 1){
                alert('Your ticket have been placed');
                clearCart();
            }else{
                alert('We are unable to book your ticket');
            }

        }else{
            alert('Unable to book. Please try again');
        }
    }

    // Items will be sent as json
    xhr.send("ticket=" + JSON.stringify(ticket));
}
