function ItemCount(){
    let itemString = localStorage.getItem('DaisyShopping');
    if(itemString){
        let itemArray = JSON.parse(itemString);
        if(itemArray != 0){
            let count = itemArray.length;
            $('#itemCount').text(count);
        }else{
            $('#itemCount').text('0');
        }
    }
}