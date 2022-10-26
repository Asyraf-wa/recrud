

function addToModal(formName) {
    const modal = document.getElementById('bootstrapModal');

    modal.dataset.formName = formName;
}


const ok = document.getElementById('ok');

ok.addEventListener('click', function () {
    const modal = document.getElementById('bootstrapModal');

    formName = modal.dataset.formName; // data-form-name => formName;
    href = modal.dataset.href;

    if (formName) {
        document[formName].submit();
    } else if (href) {
        window.location = href;
    }

    const bootstrapModal = bootstrap.Modal.getInstance(modal);

    bootstrapModal.hide();
})

const bootstrapModal = document.getElementById('bootstrapModal')

bootstrapModal.addEventListener('hide.bs.modal', event => {
    const bootstrapModal = document.getElementById('bootstrapModal');

    delete bootstrapModal.dataset.href;

    delete bootstrapModal.dataset.formName;
})

bootstrapModal.addEventListener('show.bs.modal', event => {
    const bootstrapModal = document.getElementById('bootstrapModal')

    const link = event.relatedTarget

    const message = link.dataset.confirmMessage;

    bootstrapModal.dataset.href = link.href;

    const confirmMessage = document.getElementById('confirmMessage');

    confirmMessage.textContent = message;
})