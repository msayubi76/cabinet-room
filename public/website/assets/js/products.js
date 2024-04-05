
const selectedColor = $('#selectedColor')
const stockText = $('#stock-text')
const addToCart = $('#add-to-cart')
const requestModal = $('#requestModal')
const productIdIp = $('#product_id')
const backendErrorText = $('.backend-error-text')
const productPrice = $('#product-price')
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function selectColor(color) {
    selectedColor.val(color.id)
}
onChangeVariation()
function onChangeVariation(selectedVar = null, element = null) {
    let color = selectedVar
    if (selectedVar == null) {
        color = $('#color-list').find('li.active').data('id')
    }

    let variation = PRODUCT.variations.find((v) => v.id == color)
    
    if (!variation) {
        variation = {
            stock: PRODUCT.stock || 0,
            price: PRODUCT.saleprice
        }
    }
    console.log('variation', variation);

    let stockHtml = `<b>In Stock:</b> ${variation.stock}`

    addToCart.prop('disabled', false)
    addToCart.html('Add to Cart')

    productPrice.text(parseFloat(variation.price))
    if (variation.stock == 0) {
        stockHtml = `<b>Out of Stock</b>`
        addToCart.prop('disabled', true)
        addToCart.html('Out of Stock')
    }
    stockText.html(stockHtml)
    if (element) {

        $(element).closest('ul').find('.active').removeClass('active')
        $(element).addClass('active')
    }
}


function requestQuote() {
    console.log(' i m here');
    $(".add-quote").attr('disabled', 'disabled');
    $(".add-quote").html("Requesting a quote");
    // e.preventDefault();
    var user_id = $('#user_id').val();
    var product_id = $('#product_id').val();
    var email = $('#user_email').val();
    var name = $('#name').val();
    var address = $('#address').val();
    var phone = $('#phone').val();
    var discription = $('#discription').val();
    console.log('product_id', product_id);


    backendErrorText.text('')
    $.ajax({
        type: "POST",
        url: "/add-quote",
        data: {
            'user_id': user_id,
            'product_id': product_id,
            'user_email': email,
            'name': name,
            'address': address,
            'phone': phone,
            'discription': discription,
        },

        success: function (response) {
            requestModal.modal('hide')
            $(".add-quote").html("Request Quote");
            $(".add-quote").attr('disabled', false);
            swal("", response.message, "success");
        },
        error: function (error) {
            // $(form)
            $(".add-quote").html("Request Quote");
            $(".add-quote").attr('disabled', false);

            var errorMessage = error.statusText;
            var sweetMessage = error.statusText;
            if (error.status == 422) {
                errorMessage = handleValidationErrors(error)
                sweetMessage = 'Invalid Data'
            }
            swal({
                title: "Error",
                text: sweetMessage,
                icon: "error",
            });

        },
    });
}
function handleValidationErrors(error, type = 'create') {
    let errors = error.responseJSON.errors;
    var errorMessage = error.responseJSON.message
    var element = '';
    $.each(errors, function (key, item) {
        element = key.split('.')
        if (element.length > 1) {
            element = `${element[0]}_${element[1]}`
        } else {
            element = `${element}`
        }
        // dataAttr = $(element).closest('.tab').data('id')
        // $(`.step-${dataAttr}`).addClass('backend-error')

        console.log(type, $(`#${element}_text`));
        if (type == 'edit') {

            $(`#edit_${element}_text`).text(item[0])
        } else if (type == 'create') {
            $(`#${element}_text`).text(item[0])
        }

    });

    return errorMessage;
}

function showQuoteRequestModal(product) {
    backendErrorText.text('')
    productIdIp.val(product.id)
    requestModal.modal('show')
}