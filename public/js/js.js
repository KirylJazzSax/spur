$('#form-container').css('display', 'none')
$('.alert.alert-danger').css('display', 'none')

$('#button-show').on('click', function () {
    $(this).toggleClass('btn-secondary')
    $('#form-container').toggle('slow')
})

$('#btn-create').on('click', function () {

    if (!validator($('form[name=create-task]').serializeArray())) {
        $('.alert.alert-danger').show('slow')
        setTimeout(() => {
            $('.alert.alert-danger').hide('slow')
        }, 3000)
    } else {
        $('form[name=create-task]').submit()
    }
})


let validator = data => {
    if (data.length > 3) {
        let names = []
        data.forEach(element => {
            element.value === '' ? empty.push(element.name) : null
        })
        return names.length > 0 ? false : true
    }
    return false
}