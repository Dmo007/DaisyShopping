$(document).ready(function(){
    ItemCount();
    
    $('.product_action').on('click','.addToCart', function(){
            let id = $(this).data('id');
            let name = $(this).data('name');
            let image = $(this).data('image');
            let price = $(this).data('price');
            let discount = $(this).data('discount');
            let qty = $('.qty').val();
            // console.log(name, image, price, discount,qty);
    
            let items = {
                id : id,
                name : name,
                image : image,
                price : price,
                discount : discount,
                qty : qty
            };
    
            // console.log(items);
    
            let itemString = localStorage.getItem('DaisyShopping');
            let itemArray;
            if(itemString == null) {
                itemArray = [];
            }else {
                itemArray = JSON.parse(itemString);
            }
    
            let status = false;
            $.each(itemArray, function(i,v){
                if(id == v.id){
                    status = true;
                    v.qty = Number(v.qty) + Number(qty);
                }
            })
    
            if(status == false){
                itemArray.push(items);
            }
    
            let itemData = JSON.stringify(itemArray);
            localStorage.setItem('DaisyShopping', itemData);
            ItemCount();
            
          
        });
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
    
})
        
         
    
    