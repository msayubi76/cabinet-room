
const productImages = $('#product-images')

function changeImages(color){
    const files = color.media
    console.log('files', files);
    let html = ''
    files.forEach(element => {
        html =  html+ `<div class="owl-dot">
                            <img src="${element.url}" width="110" height="110" alt="product-thumbnail" />
                        </div>`
    });
    productImages.html(html)

    productImages.owlCarousel()
}