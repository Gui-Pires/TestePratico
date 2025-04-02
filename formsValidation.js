// Validação do Fomulário
(() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
  
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
    
            form.classList.add('was-validated')
        }, false)
    })
})()

function changeLinkDelete(id) {
    console.log(id)
    const link = document.getElementById('link-delete')
    link.setAttribute('href', `delete.php?id=${id}`)
}