import './bootstrap';

import Dropzone from "dropzone";

if(document.querySelector('#dropzone')) {
    Dropzone.autoDiscover = false;

    const dropzone = new Dropzone('#dropzone', {
        dictDefaultMessage: 'Sube Aqui Tu Imagen',
        acceptedFiles: '.png,.jpg,.jpeg,.gif',
        addRemoveLinks: true,
        dictRemoveFile: 'Borrar Archivo',
        maxFiles: 1,
        uploadMultiple: false,

        init: function() {
            const inputHidden = document.querySelector('input#image');

            if (inputHidden && inputHidden.value.trim()) {
                const imagenPublicada = {};
                imagenPublicada.size = 1234;
                imagenPublicada.name = inputHidden.value.trim();

                this.options.addedfile.call(this, imagenPublicada);
                this.options.thumbnail.call(this, imagenPublicada, `/storage/uploads/${imagenPublicada.name}`);

                imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
            }
        }
    });

    dropzone.on('success', (_file, response) => {
        const inputHidden = document.querySelector('input#image');
        inputHidden.value = response.imagen;
    });

    dropzone.on('removedfile', (file) => {
        const inputHidden = document.querySelector('input#image');
        inputHidden.value = '';
    });

}
