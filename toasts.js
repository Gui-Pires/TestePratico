// Toast
const toastTrigger = document.getElementsByClassName('toast-trigger')
const toastLive = document.getElementById('liveToast')

function fShowToast(text) {
    let textToast = document.getElementById('text-toast')
    textToast.innerText = text

    toastLive.classList.add('show-toast')
    setTimeout(() => {
        toastLive.classList.remove('show-toast')
    }, 5000)
}