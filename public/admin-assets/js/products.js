const variationTableBody = $('#variationTableBody')
const productVariations = $('#product-variations')
const Err = $('.Err')

const nameIp = $('.name')
const valueIp = $('.value')
const priceIp = $('.price')
const stockIp = $('.stock')
const imagesIp = $('.images')

const availableStock = $('#available-stock')

$("#actualprice,#discount").keyup(function (e) {
    calculateDiscountPrice()
});

$("#actualprice,#discount").change(function (e) {
    calculateDiscountPrice()
});

$("#category").on('change', function () {
    getSubCategory();
});

function calculateDiscountPrice(){
    var actual = $("#actualprice").val();
    var discount = $("#discount").val();
    var divide = (discount / 100).toFixed(2);
    var mutiplication = actual * divide;
    var mainvalue = actual - mutiplication;
    $("#saleprice").val(mainvalue);

    $(".discount").val(discount);

    $('#variationTableBody tr').each(function(index, row){
        console.log('row', row);
        const price = parseFloat( $(row).find('.price').val())|| 0
        const discount =  parseFloat($(row).find('.discount').val())|| 0
        
        const discountPrice =  ((price*discount)/100).toFixed(0)|| 0
        const salePrice = price - discountPrice
        console.log('values', $(row).find('.sale_price'), price, discount, discountPrice, salePrice);
        $(row).find('.sale_price').val(salePrice)
    })
}

function calculateVariationDiscount(element){
    const row = $(element).closest('tr')
 
    const price = parseFloat( $(row).find('.price').val())|| 0
    const discount =  parseFloat($(row).find('.discount').val())|| 0
    
    const discountPrice =  ((price*discount)/100).toFixed(0) || 0
    const salePrice = price - discountPrice
    console.log('values', $(row).find('.sale_price'), price, discount, discountPrice, salePrice);
    $(row).find('.sale_price').val(salePrice)

}

function getSubCategory() {
    var id = $("#category").val();

    console.log(id);
    $.ajax({
        method: 'GET',
        url: "/admin/getSubCategory",
        data: {
            id: id
        },
        success: function (response) {
            console.log(response);
            var str = '<option selected disabled>--Select Sub Category--</option>';

            for (var i = 0; i < response.length; i++) {
                str += "<option value='" + response[i].id + "'>" + response[i].name + "</option>"
            }
            $("#subcategory").html(str);
        }
    });
}

function updateSerial() {
    count = 1;
    $(".count").each(function () {
        $(this).html(count);
        count++;
    });
}

// Auto-fill variant weights and dimensions from product data
function autoFillVariantWeights() {
    const productWeight = $('input[name="weight"]').val();
    const productLength = $('input[name="length"]').val();
    const productWidth = $('input[name="width"]').val();
    const productHeight = $('input[name="height"]').val();
    const productTcsDesc = $('input[name="tcs_product_description"]').val();
    
    if (!productWeight && !productLength && !productWidth && !productHeight) return;
    
    $('.variant-weight').each(function() {
        if (!$(this).val() && productWeight) {
            $(this).val(productWeight);
        }
    });
    
    $('.variant-length').each(function() {
        if (!$(this).val() && productLength) {
            $(this).val(productLength);
        }
    });
    
    $('.variant-width').each(function() {
        if (!$(this).val() && productWidth) {
            $(this).val(productWidth);
        }
    });
    
    $('.variant-height').each(function() {
        if (!$(this).val() && productHeight) {
            $(this).val(productHeight);
        }
    });
    
    $('.variant-tcs-desc').each(function() {
        if (!$(this).val() && productTcsDesc) {
            $(this).val(productTcsDesc);
        }
    });
}

// Auto-fill dimensions when weight is entered
function autoFillVariantDimensions(element) {
    const row = $(element).closest('tr');
    const weightInput = $(element);
    const lengthInput = row.find('.variant-length');
    const widthInput = row.find('.variant-width');
    const heightInput = row.find('.variant-height');
    
    // If dimensions are empty and weight is provided, set default dimensions
    if (weightInput.val() && !lengthInput.val() && !widthInput.val() && !heightInput.val()) {
        const weight = parseFloat(weightInput.val());
        
        // Set reasonable default dimensions based on weight
        if (weight <= 0.5) {
            lengthInput.val(15);
            widthInput.val(10);
            heightInput.val(5);
        } else if (weight <= 1) {
            lengthInput.val(20);
            widthInput.val(15);
            heightInput.val(10);
        } else if (weight <= 2) {
            lengthInput.val(25);
            widthInput.val(20);
            heightInput.val(15);
        } else {
            lengthInput.val(30);
            widthInput.val(25);
            heightInput.val(20);
        }
    }
}

function addMoreVariation(showSave = false) {
    const length = variationTableBody.find('tr').length + 1;
    let row = `<tr>
        <td class="count">${length}</td>
        <td>
            <select class="form-control name" required name="Variation[${length}][name]">
                <option value="color" selected>Color</option>
                <option value="size">Size</option>
                <option value="material">Material</option>
                <option value="style">Style</option>
            </select>
            <span class="error_name text-danger Err"></span>
        </td>
        <td>
            <input class="form-control value" type="text" name="Variation[${length}][value]" required placeholder="Value" />
            <span class="error_value text-danger Err"></span>
        </td>
        <td>
            <input class="form-control price" type="number" required name="Variation[${length}][price]" onkeyup="calculateVariationDiscount(this)" onchange="calculateVariationDiscount(this)" placeholder="Price" />
            <span class="error_price text-danger Err"></span>
        </td>
        <td>
            <input class="form-control discount" type="number" required name="Variation[${length}][discount]" onkeyup="calculateVariationDiscount(this)" onchange="calculateVariationDiscount(this)" placeholder="Discount" />
            <span class="error_discount text-danger Err"></span>
        </td>
        <td>
            <input class="form-control sale_price" type="number" required name="Variation[${length}][sale_price]" readonly placeholder="Sale Price" />
            <span class="error_sale_price text-danger Err"></span>
        </td>
        <td>
            <input class="form-control stock" type="number" required name="Variation[${length}][stock]" onkeyup="updateStock()" onchange="updateStock()" placeholder="Stock" />
            <span class="error_stock text-danger Err"></span>
        </td>
        <!-- TCS Fields for Variation -->
        <td>
            <input class="form-control variant-weight" type="number" name="Variation[${length}][weight]" placeholder="Weight" step="0.01" min="0.01" onchange="autoFillVariantDimensions(this)" />
            <span class="error_weight text-danger Err"></span>
        </td>
        <td>
            <input class="form-control variant-length" type="number" name="Variation[${length}][length]" placeholder="Length" step="0.01" min="0" />
            <span class="error_length text-danger Err"></span>
        </td>
        <td>
            <input class="form-control variant-width" type="number" name="Variation[${length}][width]" placeholder="Width" step="0.01" min="0" />
            <span class="error_width text-danger Err"></span>
        </td>
        <td>
            <input class="form-control variant-height" type="number" name="Variation[${length}][height]" placeholder="Height" step="0.01" min="0" />
            <span class="error_height text-danger Err"></span>
        </td>
        <td>
            <input class="form-control variant-tcs-desc" type="text" name="Variation[${length}][tcs_description]" placeholder="TCS Description" />
            <span class="error_tcs_description text-danger Err"></span>
        </td>
        <td>
            <input class="form-control variant-sku" type="text" name="Variation[${length}][sku]" placeholder="SKU" />
            <span class="error_sku text-danger Err"></span>
        </td>
        <td>
            <input type="file" class="images" multiple name="Variation[${length}][images][]" />
            <span class="error_images text-danger Err"></span>
        </td>
        <td>`;

    if (showSave) {
        row = row + `<button type="button" class="btn-success btn text-white save btn-sm" onclick="editVariation(this)">Save</button>`;
    }
    row = row + `<button type="button" class="btn-danger btn delete btn-sm" onclick="deleteVariation(this)">Delete</button>
        </td>
    </tr>`;
    
    variationTableBody.append(row);
    updateSerial();
    
    // Auto-fill from product data for the new row
    setTimeout(() => {
        autoFillVariantWeights();
    }, 100);
}

function deleteVariation(element, variation = null) {
    const row = $(element).closest('tr');
    if (variation == null) {
        row.remove();
        updateSerial();
        updateStock();
        return;
    }

    const deleteBtn = row.find('.delete');
    swal({
        buttons: {
            cancel: true,
            confirm: "Confirm",
        },
    });

    swal({
        title: "Are you sure?",
        text: "You will not be able to recover it.",
        type: "warning",
        cancel: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false,
        buttons: {
            cancel: true,
            confirm: "Confirm",
        },
        showLoaderOnConfirm: !0,
    }).then((result) => {
        console.log('res', result);
        if (result) {
            $.ajax({
                method: 'DELETE',
                url: `/admin/product/variation/${variation}`,
                beforeSend: function () {
                    deleteBtn.prop('disabled', true);
                },
            }).done(function (response) {
                deleteBtn.prop('disabled', false);
                if (response.status == true) {
                    swal("Message", response.message, "success");
                    row.remove();
                    updateSerial();
                    updateStock();
                } else {
                    swal("Message", response.message, "error");
                }
            }).fail(function (error) {
                console.log('fail error::', error);
                deleteBtn.prop('disabled', false);
            });
        }
    });
}

enableDisableVariations('#have_variations');

function enableDisableVariations(element) {
    console.log('enableDisableVariations: element', $(element).length > 0 && $(element).is(":checked"));
    if ($(element).length > 0 && $(element).is(":checked")) {
        productVariations.removeClass('d-none');
        $('#product-variations input').attr('required', true);
        availableStock.attr('readonly', true);
    }
    if ($(element).length > 0 && !$(element).is(":checked")) {
        productVariations.addClass('d-none');
        $('#product-variations input').attr('required', false);
        availableStock.attr('readonly', false);
    }
}

function editVariation(element, variation = '') {
    const row = $(element).closest('tr');

    const saveBtn = row.find('.save');
    const name = row.find('.name');
    const value = row.find('.value');
    const price = row.find('.price');
    const stock = row.find('.stock');
    const discount = row.find('.discount');
    const sale_price = row.find('.sale_price');
    const weight = row.find('.variant-weight');
    const length = row.find('.variant-length');
    const width = row.find('.variant-width');
    const height = row.find('.variant-height');
    const tcs_description = row.find('.variant-tcs-desc');
    const sku = row.find('.variant-sku');
    const images = row.find('.images')[0].files;

    const formData = new FormData();

    for (var i = 0; i < images.length; i++) {
        formData.append('images[]', images[i]);
    }

    formData.append('name', name.val());
    formData.append('price', price.val());
    formData.append('stock', stock.val());
    formData.append('value', value.val());
    formData.append('discount', discount.val());
    formData.append('sale_price', sale_price.val());
    // TCS fields
    formData.append('weight', weight.val());
    formData.append('length', length.val());
    formData.append('width', width.val());
    formData.append('height', height.val());
    formData.append('tcs_description', tcs_description.val());
    formData.append('sku', sku.val());
    
    formData.append('product_id', currentProduct.id);
    formData.append('_method', 'put');

    $.ajax({
        method: 'POST',
        data: formData,
        url: `/admin/product/variation/${variation}`,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('.Err').text('');
            saveBtn.prop('disabled', true);
        },
    }).done(function (response) {
        console.log('response', response);
        saveBtn.prop('disabled', false);
        if (response.status == true) {
            swal("Message", response.message, "success");
        } else {
            swal("Message", response.message, "error");
        }
    }).fail(function (error) {
        console.log('response: error', error);
        saveBtn.prop('disabled', false);
        const responseText = error.responseText ? JSON.parse(error.responseText) : {};
        swal({
            title: "Error",
            text: responseText.message ? responseText.message : error.responseJSON.message,
            type: "error",
            showCancelButton: false
        });

        $.each(error.responseJSON.errors, function (key, item) {
            row.find(".error_" + key).text(item[0]);
        });
    });
}

function updateStock(){
    let stock = 0;
    $('.stock').each(function (key, item) {
        stock = stock + parseInt($(this).val()) || 0;
    });
    availableStock.val(stock);
}

// Event listeners for product TCS fields
$(document).ready(function() {
    // Auto-fill variants when product TCS fields change
    $('input[name="weight"], input[name="length"], input[name="width"], input[name="height"], input[name="tcs_product_description"]').on('change', function() {
        autoFillVariantWeights();
    });
    
    // Initial auto-fill
    setTimeout(() => {
        autoFillVariantWeights();
    }, 500);
});