function setValue(id, value) {
    const input = document.getElementById(id)
    input.value = value
}

function errResponse(form, response) {
    const res = response.responseJSON
    const errors = res.errors

    for (let name of Object.keys(errors)) {
        const items = errors[name]
        items.map(function (error) {
            const html = `<small class="text-danger text-error">${error}</small><br class="text-error">`
            $('#' + form + ' .form-control[name="' + name + '"]').after(html)
        })
    }

    document.getElementById(form).addEventListener('submit', function(e) {
        e.preventDefault()
        $('.text-error').remove()
    })
}
