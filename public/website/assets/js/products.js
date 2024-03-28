
const selectedColor = $('#selectedColor')
const stockText= $('#stock-text')
const addToCart= $('#add-to-cart')
function selectColor(color){
    selectedColor.val(color.id)
}
onChangeVariation()
function onChangeVariation(selectedVar = null){
    let color = selectedVar
    if(selectedVar == null){
        color = $('#color-list').find('li.active').data('id')
    }
    
   const variation = PRODUCT.variations.find((v) => v.id == color)
   if(variation){
    console.log('variation', variation);

    let stockHtml = `<b>In Stock:</b> ${variation.stock}`
    
    addToCart.prop('disabled', false)
    addToCart.html('Add to Cart')
    

    if(variation.stock==0){
        stockHtml = `<b>Out of Stock</b>`
        addToCart.prop('disabled', true)
        addToCart.html('Out of Stock')
    }
    stockText.html(stockHtml)
   }
}
