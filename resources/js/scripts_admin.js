let inputPrice = document.getElementById('price');

if (inputPrice){
    inputPrice.addEventListener('input', function(){
        let valuePrice = this.value.replace(/[^\d]/g,'');
        var formattedPrice = (valuePrice.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.')) + '' + valuePrice.slice(-2);

        if(formattedPrice.length > 2) {
            formattedPrice = formattedPrice.slice(0, -2) + "," + formattedPrice.slice(-2)
        }
        this.value = formattedPrice;
    })
}
