const shipmentCharges= $('#shipment-charges')
const totalPriceText = $('#total-price')
function selectCity(element){
    console.log(CITIES)
    const city = CITIES.find((city) => city.name == $(element).val())
    let charges = 'Free Delivery'
    
    totalPriceText.text(parseFloat(totalPrice))

    if(city && city.charges>0){
        const ch = city.charges
        charges = 'Rs '+ ch
        totalPriceText.text(parseFloat(totalPrice) + ch)
    }
    shipmentCharges.text(charges)

}