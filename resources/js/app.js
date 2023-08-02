import './bootstrap'
import Dropzone from 'dropzone'

Dropzone.autoDiscover = false

if (document.getElementById('dropzone')) {
  const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false,
    // Al iniciar Dropzone, comprobamos si tenemos una imagen ya subida
    init: function() {
      if (document.querySelector('[name="imagen"]').value.trim()) {
        const imagenPublicada = {
          size: 1234,
          name: document.querySelector('[name="imagen"]').value
        }

        this.options.addedfile.call(this, imagenPublicada)
        this.options.thumbnail.call(
          this,
          imagenPublicada,
          `/uploads/${imagenPublicada.name}`
        )

        imagenPublicada.previewElement.classList.add(
          'dz-success',
          'dz-complete'
        )
      }
    }
  })

  // dropzone.on('sending', (file, xhr, formData) => {
  //   // console.log('El archivo subido es:')
  //   // console.dir(file)
  // })

  dropzone.on('success', (file, response) => {
    console.info('Imagen procesada correctamente:')
    console.log(response)
    /**
     * Aquí estamos asignando al input oculto del formulario para crear posts
     * el nombre único que le hemos dado a la imagen después de procesarla
     */
    document.querySelector('[name="imagen"]').value = response.imagen
  })
  // dropzone.on('error', (file, message) => {
  //   console.error('Error subiendo el archivo:')
  //   console.error(message)
  // })

  dropzone.on('removedfile', (file) => {
    // console.log('Archivo eliminado:')
    // console.log(file)
    document.querySelector('[name="imagen"]').value = ''
  })
}
