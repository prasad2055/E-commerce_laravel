$(function() {
    $('.toast').toast('show')

    $('.editor').trumbowyg({
        svgPath: $('base').attr('href')+'/node_modules/trumbowyg/dist/ui/icons.svg'
    })

    $('.delete').click(function(e) {
        e.preventDefault()

        if(confirm('Are you sure you want to delete item?')) {
            $(this).parent('form').submit()
        }
    })

    $('#pics').change(function(e) {
        const files = e.target.files

        $('#img-container').html('')

        for(let file of files) {
            const img = URL.createObjectURL(file)

            $('#img-container').append(`<div class="col-3 mt-3"><img src="${img}" class="img-fluid" ></div>`)
        }
    })

})